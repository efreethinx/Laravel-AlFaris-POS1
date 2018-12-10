<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Piutang;
use App\PiutangDetail;
use App\Pembayaran;
use App\PembayaranDetail;
use App\Pembelian;
use App\PembelianDetail;
use App\Penjualan;
use App\PenjualanDetail;
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

class PiutangController extends Controller
{
	public function index(){
	
	$uoms =  Uom::All();
    $kontak = Kontak::pluck('nama_kontak','id');
	
    return view('modules.piutang.index',compact('uoms','kontak'));
	}

	public function data()
    {
        //$roles = piutang::select(['tanggal_faktur', 'no_faktur', 'no_po', 'kontak_id', 'proyek', 'total_setelah_pajak']);
        $roles = DB::table('piutangs')
                 ->join('piutang_details','piutangs.id', '=', 'piutang_details.piutang_id')
                 ->join('kontaks','piutangs.kontak_id', '=', 'kontaks.id')
                 ->join('akuns','piutangs.akun_id', '=', 'akuns.id')
                 ->join('penjualans','piutang_details.penjualan_id', '=', 'penjualans.id')
                 ->select('piutangs.id','piutangs.no_reff','piutangs.tanggal','kontaks.nama_kontak','akuns.kode_akun','akuns.nama_akun','piutangs.nilai','penjualans.no_faktur')
                 ;
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="piutang/detail/'.$role->id.'" title="Detail Data piutang"><button type="button" class="btn btn-sm btn-success"><i class="fa fa-search"></i></button></a> <a href="piutang/print/'.$role->id.'" title="Print Data piutang"><button type="button" class="btn btn-sm btn-default"><i class="fa fa-print"></i></button></a> <a href="piutang/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
            })
            ->make(true);
    }

    public function create(Request $request)
    {
    	date_default_timezone_set('Asia/Jakarta');
        //$date = date('ym');
        $date = '00';

        $dataMax = DB::table('piutangs')->select(['no_reff as ID'])
                   ->orderBy('no_reff', 'DESC')
                   ->get();
        $dataMax2 = Str::substr($dataMax,14,5);
        $param1 = 'CR';
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
        $faktur_list = Penjualan::pluck('no_faktur','id')->where('kontak_id',$request->kontak_id);
    	$product_list = Product::pluck('nama_produk','id');
    	$kontak_list = Kontak::pluck('nama_kontak','id');
    	$gudang_list = Gudang::pluck('nama_gudang','id');
    	$departement_list = Departement::pluck('nama_departement','id');
    	return view('modules.piutang.add',compact('kontak_list','product_list','invoice','gudang_list','departement_list','akun_list','faktur_list'));
    	//return view('modules.piutang.add');
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
            return Redirect::to('piutang/add')->withErrors($validator)->withInput();
      } else {//date_default_timezone_set('Asia/Jakarta');
        $piutang = new piutang;
        $piutang->kontak_id=$request->kontak_id;
        $piutang->no_reff=$request->no_reff;

        $var = $request->tanggal;
        $date = str_replace('/', '-', $var);
        $value = date('Y-m-d', strtotime($date));

        $st = Str::substr($request->nilai,4,50);
        $st2 = (int)str_replace(array(' ', ','), '', $st);
        $piutang->nilai=$st2;
        
        $piutang->tanggal=$value;
        $piutang->proyek=$request->proyek;        
        $piutang->departement_id=$request->departement_id;
        $piutang->akun_id=$request->akun_id;
        $piutang->denda=$request->denda;
        $piutang->is_giro=$request->is_giro;
        $piutang->is_cetak=$request->is_cetak;
        $piutang->userid= $request->userid;
        //$piutang->is_canceled=$request->is_canceled;
        if ($piutang->save()){
            $id = $piutang->id;
            foreach ($request->no_faktur as $key => $v) 
            {
                date_default_timezone_set('Asia/Jakarta');
                $data = array(
                        'piutang_id'   => $id,
                        'no_reff'         => $request->no_reff,
                        'penjualan_id'       => $v,
                        //'kode_produk'     => $v,
                        'saldo'           => (int)str_replace(array(' ', ','), '', $request->saldo[$key]),
                        'diskon'          => $request->diskon[$key],
                        'jml_dibayar'     => $request->jml_dibayar[$key],
                        'created_at'      => DB::raw('now()'),
                        'updated_at'      => DB::raw('now()')
                    );
                PiutangDetail::insert($data);
            }
        }
       
        return redirect()->route('piutang.index');
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
        return redirect()->route('piutangs.index');
        */

        DB::table('piutangs')->where('id', '=', $id)->delete();
        DB::table('piutang_details')->where('piutang_id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return Redirect::to('piutang');
    }

    public function detail($id){
        $piutang = DB::table('piutangs')->where('id',$id)->first();
        //$piutang_detail = DB::table('piutang_details')->where('piutang_id',$id)->first();
        //$piutang_detail = DB::table('piutang_details')->select('id','no_faktur')->where('piutang_id',$id)->first();
        $piutang_detail = piutangDetail::all()->where('piutang_id','=>',$id);
        $piutang =
          [
            'piutang' => $piutang
          ];
        return view('modules.piutang.detail', $piutang,compact('piutang_detail'));

    }
}
