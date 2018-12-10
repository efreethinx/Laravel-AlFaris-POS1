<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
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
use App\Penjualan;
use App\PenjualanDetail;
use App\Transfer;
use App\TransferDetail;
use Session;
use Redirect;
use App\PengeluaranKas;
use App\PengeluaranKasDetail;
use App\PenerimaanKas;
use App\PenerimaanDetailKas;
use App\TransferKas;

class TransferKasController extends Controller
{
    public function index(){
	
	$uoms =  Uom::All();
    $kontak = Kontak::pluck('nama_kontak','id');
	
    return view('modules.kas.transfer.index',compact('uoms','kontak'));
	}

	public function data()
    {
        //$roles = kas.transfer::select(['tanggal_faktur', 'no_faktur', 'no_po', 'kontak_id', 'proyek', 'total_setelah_pajak']);
        $roles = DB::table('transfer_kas')
                 //->join('kontaks','transfer_kas.kontak_id', '=', 'kontaks.id')
                 ->join('departements','transfer_kas.departement_id', '=', 'departements.id')
                 ->join('akuns AS a','transfer_kas.from_akun_id', '=', 'a.id')
                 ->join('akuns AS b','transfer_kas.to_akun_id', '=', 'b.id')
                 ->select('transfer_kas.id','transfer_kas.no_reff','transfer_kas.keterangan', 'transfer_kas.tanggal', 'departements.nama_departement','transfer_kas.from_akun_id','a.kode_akun AS from_akun','transfer_kas.to_akun_id','b.kode_akun AS to_akun','transfer_kas.nilai')
                 ;
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="transfer/detail/'.$role->id.'" title="Detail Data kas.transfer"><button type="button" class="btn btn-sm btn-success"><i class="fa fa-search"></i></button></a> <a href="transfer/print/'.$role->id.'" title="Print Data kas.transfer"><button type="button" class="btn btn-sm btn-default"><i class="fa fa-print"></i></button></a> <a href="transfer/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
            })
            ->make(true);
    }

    public function create()
    {
    	date_default_timezone_set('Asia/Jakarta');
        //$date = date('ym');
        $date = '00';

        $dataMax = DB::table('transfer_kas')->select(['no_reff as ID'])
                   ->orderBy('no_reff', 'DESC')
                   ->get();
        $dataMax2 = Str::substr($dataMax,14,5);
        $param1 = 'FT';
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

    	$product_list = Product::pluck('nama_produk','id');
    	$akun_list = Akun::pluck('kode_akun','id');
    	$kontak_list = Kontak::pluck('nama_kontak','id');
    	$gudang_list = Gudang::pluck('nama_gudang','id');
    	$departement_list = Departement::pluck('nama_departement','id');
    	return view('modules.kas.transfer.add',compact('akun_list','kontak_list','product_list','invoice','gudang_list','departement_list'));
    	//return view('modules.kas.transfer.add');
    }

    public function insert(Request $request)
    {
        
        //date_default_timezone_set('Asia/Jakarta');
        $transfer = new TransferKas;
        $transfer->from_akun_id=$request->from_akun_id;
        $transfer->to_akun_id=$request->to_akun_id;
        
        $var = $request->tanggal;
        $date = str_replace('/', '-', $var);
        $value = date('Y-m-d', strtotime($date));

        $transfer->tanggal=$value;
        $transfer->departement_id=$request->departement_id;
        $transfer->keterangan=$request->keterangan;
        $transfer->no_reff=$request->no_reff;

        //$transfer->kontak_id=$request->kontak_id;
        //$transfer->proyek=$request->proyek;
        
        //$st = Str::substr($request->nilai,4,50);
        $st = $request->nilai;
        $st2 = (int)str_replace(array(' ', ','), '', $st);
        $transfer->nilai=$st2;
        
        //$transfer->is_giro=$request->is_tunai;
        //$transfer->is_cetak=$request->is_cetak;
        //$transfer->is_void=$request->is_void;
        
        //$transfer->is_cetak=$request->is_cetak;
        $transfer->userid=$request->userid;
        $transfer->save();
        //TransferKas::insert($transfer);
        /*
        if ($transfer->save()){
            $id = $transfer->id;
            foreach ($request->nama_akun2 as $key => $v) 
            {
                date_default_timezone_set('Asia/Jakarta');
                $data = array(
                        'transfer_id'   => $id,
                        //'no_reff'      => $request->no_reff,
                        'akun_id'      => $v,
                        //'akun_id'        => $request->akun_id[$key],
                        'departement_id'     => $request->departement_id2[$key],
                        //'qty_pesan'      => $request->qty_pesan[$key],
                        'jml_keluar'         => $request->jml_keluar[$key],
                        //'ke_gudang'     => $request->ke_gudang[$key],
                        'job'         => $request->job[$key],
                        
                        'total'          => $request->amount[$key],
                        'pajak'          => $request->pajak[$key],
                        'proyek2'         => $request->proyek2[$key],
                        
                        'created_at'     => DB::raw('now()'),
                        'updated_at'     => DB::raw('now()')
                    );
                TransferKasDetail::insert($data);
            }
        } */
       
        return redirect()->route('kas.transfer.index');
    }      

    public function findNamaAkun(Request $request)
    {
        $data = Akun::select('nama_akun')->where('id', $request->id)->first();
        return response()->json($data);
    }

	public function findPrice(Request $request)
    {
        $data = Product::select('harga_jual_satuan')->where('id', $request->id)->first();
        return response()->json($data);
    }

    public function findKodeProduk(Request $request)
    {
        $data = Akun::select('kode_akun')->where('id', $request->id)->first();
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
        return redirect()->route('transfer_kas.index');
        */

        DB::table('transfer_kas')->where('id', '=', $id)->delete();
        DB::table('transfer_kas_details')->where('transfer_id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return Redirect::to('kas.transfer.index');
    }

    public function detail($id){

        $pembelian = DB::table('transfer_kas')->where('id',$id)->first();
        $pembelian_detail = transferDetail::all()->where('kas.transfer_id','=>',$id);
        $pembelian =
          [
            'pembelian' => $pembelian
          ];
        return view('modules.kas.transfer.detail', $pembelian, compact('pembelian_detail'));

    } 
}
