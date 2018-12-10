<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Pembayaran;
use App\PembayaranDetail;
use App\Pembelian;
use App\PembelianDetail;
use App\User;
use App\Product;
use App\Gudang;
use App\Akun;
use App\Uom;
use App\Kontak;
use App\Transaction;
use App\Departement;
Use Str;
use DataTables;
use Input;
use Session;
use Redirect;
use Validator;
use App\Auth;

class PembayaranController extends Controller
{
	public function index(){
	
	$uoms =  Uom::All();
    $kontak = Kontak::pluck('nama_kontak','id');
	
    return view('modules.pembayaran.index',compact('uoms','kontak'));
	}

	public function data()
    {
        //$roles = pembayaran::select(['tanggal_faktur', 'no_faktur', 'no_po', 'kontak_id', 'proyek', 'total_setelah_pajak']);
        $roles = DB::table('pembayarans')
                 ->join('pembayaran_details','pembayarans.id', '=', 'pembayaran_details.pembayaran_id')
                 ->join('kontaks','pembayarans.kontak_id', '=', 'kontaks.id')
                 ->join('akuns','pembayarans.akun_id', '=', 'akuns.id')
                 ->join('pembelians','pembayaran_details.pembelian_id', '=', 'pembelians.id')
                 ->select('pembayarans.id','pembayarans.no_reff','pembayarans.tanggal','kontaks.nama_kontak','akuns.kode_akun','akuns.nama_akun','pembayarans.nilai','pembelians.no_faktur')
                 ;
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="pembayaran/detail/'.$role->id.'" title="Detail Data pembayaran"><button type="button" class="btn btn-sm btn-success"><i class="fa fa-search"></i></button></a> <a href="pembayaran/print/'.$role->id.'" title="Print Data pembayaran"><button type="button" class="btn btn-sm btn-default"><i class="fa fa-print"></i></button></a> <a href="pembayaran/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
            })
            ->make(true);
    }

    public function create(Request $request)
    {
    	date_default_timezone_set('Asia/Jakarta');
        //$date = date('ym');
        $date = '00';

        $dataMax = DB::table('pembayarans')->select(['no_reff as ID'])
                   ->orderBy('no_reff', 'DESC')
                   ->get();
        $dataMax2 = Str::substr($dataMax,14,5);
        $param1 = 'CD';
        $param  = $param1.$date.'' ;
            if($dataMax2=='') {
                // Bila Data Kosong
                $ID = $param."0000001";
            }else {
                $MaksID = $dataMax2;
                $MaksID++;
                if($MaksID < 10) $ID = $param."000000".$MaksID; // nilai kurang dari 10
                else if($MaksID < 100) $ID = $param."00000".$MaksID; // nilai kurang dari 100
                else if($MaksID < 100) $ID = $param."0000".$MaksID; // nilai kurang dari 100
                else if($MaksID < 100) $ID = $param."000".$MaksID; // nilai kurang dari 100
                else if($MaksID < 1000) $ID = $param."00".$MaksID; // nilai kurang dari 1000
                else if($MaksID < 10000) $ID = $param."0".$MaksID; // nilai kurang dari 10000
                else $ID = $MaksID; // lebih dari 10000
            }
        //$id = $date.'.'.$ID;
        $invoice = $ID;

        //$invoice = $this->getNewInvoiceNo();

        $akun_list = Akun::pluck('nama_akun','id');
        $faktur_list = Pembelian::pluck('no_faktur','id')->where('kontak_id',$request->kontak_id);
    	$product_list = Product::pluck('nama_produk','id');
    	$kontak_list = Kontak::pluck('nama_kontak','id');
    	$gudang_list = Gudang::pluck('nama_gudang','id');
    	$departement_list = Departement::pluck('nama_departement','id');
    	return view('modules.pembayaran.add',compact('kontak_list','product_list','invoice','gudang_list','departement_list','akun_list','faktur_list'));
    	//return view('modules.pembayaran.add');
    }

    public function insert(Request $request)
    {
        
      $rules = array(
        //'tahunajaran' => 'required|string|max:255',
        'kontak_id' => 'required|string|max:255',
        'akun_id'   => 'required|string|max:255',
        'no_faktur' => 'required|max:255',        
        //'email' => 'required|string|email|max:255|unique:kontaks',
        //'password' => 'required|string|min:6|confirmed',
        );

      $messages = [
            'required' => 'Kolom :attribute tidak boleh Kosong..!!! , Silahkan diisi dahulu.',
            'same'     => 'The :attribute and :other must match.',
            'size'     => 'The :attribute must be exactly :size.',
            'between'  => 'The :attribute must be between :min - :max.',
            'in'       => 'The :attribute must be one of the following types: :values',
      ];

      $validator = Validator::make(Input::all(), $rules, $messages);

      if ($validator->fails()) {
            return Redirect::to('pembayaran/add')->withErrors($validator)->withInput();
      } else {//date_default_timezone_set('Asia/Jakarta');
        $pembayaran = new Pembayaran;
        $pembayaran->kontak_id=$request->kontak_id;
        $pembayaran->no_reff=$request->no_reff;

        $var = $request->tanggal;
        $date = str_replace('/', '-', $var);
        $value = date('Y-m-d', strtotime($date));

        $st = Str::substr($request->nilai,4,50);
        $st2 = (int)str_replace(array(' ', ','), '', $st);
        $pembayaran->nilai=$st2;
        
        $pembayaran->tanggal=$value;
        $pembayaran->proyek=$request->proyek;        
        $pembayaran->departement_id=$request->departement_id;
        $pembayaran->akun_id=$request->akun_id;
        $pembayaran->denda=$request->denda;
        $pembayaran->is_giro=$request->is_giro;
        $pembayaran->is_cetak=$request->is_cetak;
        $pembayaran->userid= $request->userid;
        //$pembayaran->is_canceled=$request->is_canceled;
        if ($pembayaran->save()){
            $id = $pembayaran->id;
            foreach ($request->no_faktur as $key => $v) 
            {
                date_default_timezone_set('Asia/Jakarta');
                $data = array(
                        'pembayaran_id'   => $id,
                        'no_reff'         => $request->no_reff,
                        'pembelian_id'    => $v,
                        //'kode_produk'   => $v,
                        'saldo'           => (int)str_replace(array(' ', ','), '', $request->saldo[$key]),
                        'diskon'          => $request->diskon[$key],
                        'jml_dibayar'     => $request->jml_dibayar[$key],
                        'created_at'      => DB::raw('now()'),
                        'updated_at'      => DB::raw('now()')
                    );
                PembayaranDetail::insert($data);
            }
        }
       
        return redirect()->route('pembayaran.index');
    }      
    }      

    public function findPrice(Request $request)
    {
        //$data = Pembelian::select(DB::raw('(saldo_terutang) as totalhutang'))->where('kontak_id', $request->kontak_id)->where('id', $request->id)->first();
        $data = DB::table('views_saldo_hutang')->select('saldohutang')
                ->where('views_saldo_hutang.kontak_id', $request->kontak_id)
                ->where('views_saldo_hutang.id', $request->id)
                ->first();
        return response()->json($data);
    }

    public function findTanggal(Request $request)
    {
        $data = Pembelian::select('tanggal_faktur')->where('id', $request->id)->first();
        return response()->json($data);
    }

    public function findKodeProduk(Request $request)
    {
        $data = Product::select('kode_produk')->where('id', $request->id)->first();
        return response()->json($data);
    } 

    public function findSatuan(Request $request)
    {
        $data = Product::select('uom_id')->where('id', $request->id)->first();
        return response()->json($data);
    }  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Uom  $uom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   /*
        if (! Gate::allows('uoms_view')) {
            return abort(401);
        }        
        
        $permission = Uom::findOrFail($id);
        $permission->delete();
        return redirect()->route('pembayarans.index');
        */

        DB::table('pembayarans')->where('id', '=', $id)->delete();
        DB::table('pembayaran_details')->where('pembayaran_id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return Redirect::to('pembayaran');
    }

    public function detail($id){
        $pembayaran = DB::table('pembayarans')->where('id',$id)->first();
        //$pembayaran_detail = DB::table('pembayaran_details')->where('pembayaran_id',$id)->first();
        //$pembayaran_detail = DB::table('pembayaran_details')->select('id','no_faktur')->where('pembayaran_id',$id)->first();
        $pembayaran_detail = pembayaranDetail::all()->where('pembayaran_id','=>',$id);
        $pembayaran =
          [
            'pembayaran' => $pembayaran
          ];
        return view('modules.pembayaran.detail', $pembayaran,compact('pembayaran_detail'));

    }
}
