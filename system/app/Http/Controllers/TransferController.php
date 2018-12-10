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

class TransferController extends Controller
{
    public function index(){
	
	$uoms =  Uom::All();
    $kontak = Kontak::pluck('nama_kontak','id');
	
    return view('modules.transfer.index',compact('uoms','kontak'));
	}

	public function data()
    {
        //$roles = transfer::select(['tanggal_faktur', 'no_faktur', 'no_po', 'kontak_id', 'proyek', 'total_setelah_pajak']);
        $roles = DB::table('transfers')
                 ->join('gudangs','transfers.gudang_asal', '=', 'gudangs.id')
                 ->select('transfers.id','transfers.no_reff','transfers.keterangan', 'transfers.tanggal', 'gudangs.nama_gudang')
                 ; 
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="transfer/detail/'.$role->id.'" title="Detail Data transfer"><button type="button" class="btn btn-sm btn-success"><i class="fa fa-search"></i></button></a> <a href="transfer/print/'.$role->id.'" title="Print Data transfer"><button type="button" class="btn btn-sm btn-default"><i class="fa fa-print"></i></button></a> <a href="transfer/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
            })
            //->editColumn('id', 'ID: {{$id}}')
            //->removeColumn('password')
            //->removeColumn('remember_token')
            ->make(true);
    }

    public function create()
    {
    	date_default_timezone_set('Asia/Jakarta');
        //$date = date('ym');
        $date = '00';

        $dataMax = DB::table('transfers')->select(['no_reff as ID'])
                   ->orderBy('no_reff', 'DESC')
                   ->get();
        $dataMax2 = Str::substr($dataMax,14,5);
        $param1 = 'TR';
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
    	$kontak_list = Kontak::pluck('nama_kontak','id');
    	$gudang_list = Gudang::pluck('nama_gudang','id');
    	$departement_list = Departement::pluck('nama_departement','id');
    	return view('modules.transfer.add',compact('kontak_list','product_list','invoice','gudang_list','departement_list'));
    	//return view('modules.transfer.add');
    }

    public function insert(Request $request)
    {
        
        //date_default_timezone_set('Asia/Jakarta');
        $transfer = new Transfer;
        //$transfer->kontak_id=$request->kontak_id;
        $transfer->no_reff=$request->no_reff;
        //$transfer->no_po=$request->no_po;

        $var = $request->tanggal;
        $date = str_replace('/', '-', $var);
        $value = date('Y-m-d', strtotime($date));

        $transfer->tanggal=$value;
        //$transfer->proyek=$request->proyek;
        //$transfer->gudang_keluar_id=$request->gudang_masuk_id;
        //$transfer->keterangan=$request->keterangan;
        $transfer->departement_id=$request->departement_id;

        //$var = $request->tanggal_kirim;
        //$date = str_replace('/', '-', $var);
        //$tanggal_kirim = date('Y-m-d', strtotime($date));

        //transfer->tanggal_kirim=$tanggal_kirim;
        $transfer->keterangan=$request->keterangan;
        $transfer->gudang_asal=$request->gudang_asal;
        $transfer->gudang_terima=$request->gudang_terima;
        /*
        $transfer->debit_kredit=$request->debit_kredit;
        $transfer->biaya_lain=$request->biaya_lain;
        $transfer->total_pajak=$request->total_pajak;
        $transfer->total_setelah_pajak=$request->total_setelah_pajak;
        $transfer->uang_muka=$request->uang_muka;

        $st = Str::substr($request->saldo_terutang,4,50);
        $st2 = (int)str_replace(array(' ', ','), '', $st);
        $transfer->saldo_terutang=$st2;
        $transfer->is_tunai=$request->is_tunai;
        $transfer->is_cetak=$request->is_cetak;
        $transfer->is_void=$request->is_void;
        */
        $transfer->is_cetak=$request->is_cetak;
        
        if ($transfer->save()){
            $id = $transfer->id;
            foreach ($request->nama_produk as $key => $v) 
            {
                date_default_timezone_set('Asia/Jakarta');
                $data = array(
                        'transfer_id'   => $id,
                        'no_reff'      => $request->no_reff,
                        'produk_id'      => $v,
                        //'akun_id'        => $request->akun_id[$key],
                        'qty'     => $request->qty[$key],
                        //'qty_pesan'      => $request->qty_pesan[$key],
                        'uom_id'         => $request->uom_id[$key],
                        'ke_gudang'     => $request->ke_gudang[$key],
                        'jobs'         => $request->jobs[$key],
                        /*
                        'total'          => $request->amount[$key],
                        'pajak'          => $request->pajak[$key],
                        'proyek2'         => $request->proyek2[$key],
                        */
                        'created_at'     => DB::raw('now()'),
                        'updated_at'     => DB::raw('now()')
                    );
                transferDetail::insert($data);
            }
        }
       
        return redirect()->route('transfer.index');
    }      

    public function findPrice(Request $request)
    {
        $data = Product::select('harga_jual_satuan')->where('id', $request->id)->first();
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
        return redirect()->route('transfers.index');
        */

        DB::table('transfers')->where('id', '=', $id)->delete();
        DB::table('transfer_details')->where('transfer_id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return Redirect::to('transfer');
    }

    public function detail($id){

        $pembelian = DB::table('transfers')->where('id',$id)->first();
        $pembelian_detail = TransferDetail::all()->where('transfer_id','=>',$id);
        $pembelian =
          [
            'pembelian' => $pembelian
          ];
        return view('modules.transfer.detail', $pembelian, compact('pembelian_detail'));

    }       
}
