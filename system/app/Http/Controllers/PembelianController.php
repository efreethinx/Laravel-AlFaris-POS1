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
use App\ProductUom;
use App\ProdukUom;
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
use Pembayaran;
use PembayaranDetail;
use Response;
use Validator;
use Excel;
use HargaBeliDetail;

class PembelianController extends Controller
{

  public function index(){

    $uoms =  Uom::All();
    $kontak = Kontak::pluck('nama_kontak','id');

    return view('modules.pembelian.index',compact('uoms','kontak'));
    }

    public function hutang(){

    $uoms =  Uom::All();
    $kontak = Kontak::pluck('nama_kontak','id');

    return view('modules.pembelian.hutang',compact('uoms','kontak'));
    }

    public function data()
    {
        //$roles = Pembelian::select(['tanggal_faktur', 'no_faktur', 'no_po', 'kontak_id', 'proyek', 'total_setelah_pajak']);
        $roles = DB::table('pembelians')
                 ->leftJoin('kontaks','pembelians.kontak_id', '=', 'kontaks.id')
                 ->select('pembelians.id','pembelians.no_faktur','pembelians.no_po', 'pembelians.tanggal_faktur', 'kontaks.nama_kontak', 'pembelians.total_setelah_pajak', 'pembelians.saldo_terutang')
                 ;
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="pembelian/detail/'.$role->id.'" title="Detail Data Pembelian"><button type="button" class="btn btn-sm btn-success"><i class="fa fa-search"></i></button></a> <a href="#" title="Print Data Pembelian"><button type="button" class="btn btn-sm btn-default"><i class="fa fa-print"></i></button></a> <a href="pembelian/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
            })
            //->editColumn('id', 'ID: {{$id}}') pembelian/edit/'.$role->id.'
            //->removeColumn('password')
            //->removeColumn('remember_token')
            ->make(true);
    }

    public function create()
    {
      date_default_timezone_set('Asia/Jakarta');
        //$date = date('ym');
        //$date = '00';

        $dataMax = DB::table('pembelians')->select(['no_faktur as ID'])
                   ->orderBy('no_faktur', 'DESC')
                   ->get();
        $dataMax2 = Str::substr($dataMax,14,5);
        $param1 = 'PJ';
        //$param  = $param1.$date.'' ; 00000000098
        $param  = $param1.'' ;
            if($dataMax2=='') {
                // Bila Data Kosong
                $ID = $param."000000001";
            }else {
                $MaksID = $dataMax2;
                $MaksID++;
                if($MaksID < 10) $ID = $param."00000000".$MaksID; // nilai kurang dari 10
                else if($MaksID < 100) $ID = $param."0000000".$MaksID; // nilai kurang dari 100
                else if($MaksID < 100) $ID = $param."000000".$MaksID; // nilai kurang dari 100
                else if($MaksID < 100) $ID = $param."00000".$MaksID; // nilai kurang dari 100
                else if($MaksID < 1000) $ID = $param."0000".$MaksID; // nilai kurang dari 1000
                else if($MaksID < 10000) $ID = $param."000".$MaksID; // nilai kurang dari 10000
                else if($MaksID < 10000) $ID = $param."00".$MaksID; // nilai kurang dari 10000
                else if($MaksID < 10000) $ID = $param."0".$MaksID; // nilai kurang dari 10000
                else $ID = $MaksID; // lebih dari 10000
            }
        //$id = $date.'.'.$ID;
        $invoice = $ID;

        //$invoice = $this->getNewInvoiceNo();

        $sql = DB::table('product_uoms')->where('produk_id',Input::get('produk_id'));

        //$product_list = Product::pluck('nama_produk','id');
        //$kontak_list = Kontak::pluck('nama_kontak','id');
        $gudang_list = Gudang::pluck('nama_gudang','id');
        $departement_list = Departement::pluck('nama_departement','id');
        $product_list = Product::all();
        $kontak_list = Kontak::all()->where('tipe','=','Supplier');
        //$product_uoms_list = ProductUom::where('produk_id', Input::get('produk_id'))->get()->pluck('uom_id','uom_id');

        $product_uoms_list = DB::table('product_uoms')->where('produk_id', Input::get('produk_id'))->pluck('uom_id','uom_id');

        $uoms_list = Uom::pluck('nama_uom','nama_uom');



      return view('modules.pembelian.add',compact('kontak_list','product_list','invoice','gudang_list','departement_list','product_uoms_list','uoms_list'));
      //return view('modules.pembelian.add');
    }

    public function insert(Request $request)
    {

      $rules = array(
      //'qty_terima' => 'required',
      'biaya_lain' => 'required',
      'uang_muka' => 'required',
      //'email' => 'required|string|email|max:255|unique:biayas',
      //'password' => 'required|string|min:6|confirmed',
      );

      $messages = [
            'required' => 'The :attribute field is required.',
            'same'     => 'The :attribute and :other must match.',
            'size'     => 'The :attribute must be exactly :size.',
            'between'  => 'The :attribute must be between :min - :max.',
            'in'       => 'The :attribute must be one of the following types: :values',
      ];

      $validator = Validator::make(Input::all(), $rules, $messages);

      if ($validator->fails()) {
            return redirect()->route('pembelian.create')->withErrors($validator)->withInput();
      } else {
        //date_default_timezone_set('Asia/Jakarta');
        $pembelian = new Pembelian;
        $pembelian->kontak_id=$request->kontak_id;
        $pembelian->no_faktur=$request->no_faktur;
        $pembelian->no_po=$request->no_po;

        $var = $request->tanggal_faktur;
        $date = str_replace('/', '-', $var);
        $value = date('Y-m-d', strtotime($date));

        $pembelian->tanggal_faktur=$value;

        $var1 = $request->tgl_jatuh_tempo;
        $date1 = str_replace('/', '-', $var1);
        $value1 = date('Y-m-d', strtotime($date1));
        $pembelian->tgl_jatuh_tempo=$value1;

        $pembelian->proyek=$request->proyek;
        $pembelian->asal_penerimaan=$request->asal_penerimaan;
        $pembelian->cara_pembelian=$request->cara_pembelian;
        $pembelian->lainnya=$request->lainnya;
        $pembelian->gudang_masuk_id=$request->gudang_masuk_id;
        $pembelian->keterangan=$request->keterangan;
        $pembelian->departement_id=$request->departement_id;

        $var = $request->tanggal_kirim;
        $date = str_replace('/', '-', $var);
        $tanggal_kirim = date('Y-m-d', strtotime($date));

        $pembelian->tanggal_kirim=$tanggal_kirim;
        $pembelian->bagian_pembelian=$request->bagian_pembelian;
        $pembelian->denda_terlambat=$request->denda_terlambat;
        $pembelian->debit_kredit=$request->debit_kredit;

        $pembelian->biaya_lain=$request->biaya_lain;

        $stt = Str::substr($request->totalpajak,4,50);
        $st3 = (int)str_replace(array(' ', ','), '', $stt);
        $pembelian->total_pajak=$st3;

        $sttt = Str::substr($request->totalsetelahpajak,4,50);
        $st4 = (int)str_replace(array(' ', ','), '', $sttt);
        $pembelian->total_setelah_pajak=$st4;
        $pembelian->uang_muka=$request->uang_muka;

        $st = Str::substr($request->saldo_terutang,4,50);
        $st2 = (int)str_replace(array(' ', ','), '', $st);
        $pembelian->saldo_terutang=$st2;
        $pembelian->is_tunai=$request->is_tunai;
        $pembelian->is_cetak=$request->is_cetak;
        $pembelian->is_void=$request->is_void;
        $pembelian->is_canceled=$request->is_canceled;
        if ($pembelian->save()){
            $id = $pembelian->id;
            foreach ($request->nama_produk as $key => $v)
            {
                date_default_timezone_set('Asia/Jakarta');
                $data = array(
                        'pembelian_id'   => $id,
                        'no_faktur'      => $request->no_faktur,
                        'kode_produk'    => $request->produk_id[$key],
                        //'akun_id'        => $request->akun_id[$key],
                        'qty_terima'     => $request->qty[$key],
                        'qty_pesan'      => $request->qty_pesan[$key],
                        'uom_id'         => $request->uom_id[$key],
                        'harga_beli'     => $request->harga[$key],
                        'diskon'         => $request->discount[$key],
                        'total'          => $request->amount[$key],
                        'pajak'          => $request->pajak[$key],
                        'proyek'         => $request->proyek2[$key],
                        'created_at'     => DB::raw('now()'),
                        'updated_at'     => DB::raw('now()')
                    );
                PembelianDetail::insert($data);

                //-- Manajemen Stok --//
                $qty = Product::select('stok')->where('id', $request->produk_id[$key])->first();

                DB::table('products')
                ->where('id', $request->produk_id[$key])
                ->update(array(
                      'stok' => $qty->stok + $request->qty[$key],
                      //'created_at' => date('y-m-d h:m:s'),
                      'updated_at' => date('y-m-d h:m:s')
                ));

            }
        }
        }
        return redirect()->route('pembelian.index');
    }


    public function edit($id)
    {
       $pembelian = DB::table('pembelians')->where('id',$id)->first();
       $pembelian_detail = DB::table('pembelian_details')->where('pembelian_id',$id)->first();
       $pembelian =
        [
          'pembelian' => $pembelian
        ];


        //return view('modules.pembelian.edit', $roleId);
        $product_list = Product::pluck('nama_produk','id');
        $product_uoms_list = Product::pluck('nama_produk','id');
        $kontak_list = Kontak::pluck('nama_kontak','id');
        $gudang_list = Gudang::pluck('nama_gudang','id');
        $departement_list = Departement::pluck('nama_departement','id');
        return view('modules.pembelian.edit',$pembelian,compact('pembelian_detail','kontak_list','product_list','invoice','gudang_list','departement_list','product_uoms_list'));

        /*
        $pembelian = DB::table('pembelians')->where('id',$id)->first();
        //$pembelian_detail = DB::table('pembelian_details')->where('pembelian_id',$id)->first();
        //$pembelian_detail = DB::table('pembelian_details')->select('id','no_faktur')->where('pembelian_id',$id)->first();
        $pembelian_detail = PembelianDetail::all()->where('pembelian_id','=>',$id);
        $pembelian =
          [
            'pembelian' => $pembelian
          ];
        return view('modules.pembelian.detail', $pembelian,compact('pembelian_detail'));
        */
    }

    public function findPrice(Request $request)
    {
        $data = Product::select('harga_jual_satuan')->where('id', $request->id)->first();
        $data2 = HargaBeliDetail::select('harga_beli_khusus AS harga_jual_satuan')->where('produk_id', $request->id)->where('kontak_id', $request->kontak_id)->first();

        if ($data2 == '') {
            $data3 = $data;
        }else{
            $data3 = $data2;
        }
        return response()->json($data);
    }

    /*
    public function Price(Request $request)
    {
        $data = Product::select('harga_jual_satuan')->where('id', $request->id)->first();
        $data2 = Harga::select('harga_jual_pelanggan AS harga_jual_satuan')->where('produk_id', $request->id)->where('kontak_id', $request->kontak_id)->first();

        if ($data2 == '') {
            $data3 = $data;
        }else{
            $data3 = $data2;
        }
        return response()->json($data3);
    }*/

    public function findUoms(Request $request)
    {
        $data = ProdukUom::where('produk_id', $request->produk_id)->pluck('uom_id','uom_id');
        return response()->json($data);
    }

    public function findKodeProduk(Request $request)
    {
        $data = Product::select('kode_produk')->where('id', $request->id)->first();
        return response()->json($data);
    }


    /*
    public function findSatuan(Request $request)
    {
        $data2  = Product::select('uom_id')->where('id', $request->id)->first();
        $data   = last(explode(',', $data2));
        return response()->json($data);
    }
    */

    public function findKontak(Request $request)
    {
        $data = Kontak::where('id', $request->id)->first();
        return response()->json($data);
    }

    public function findProduk(Request $request)
    {
        $ids = array($request->id);

        $test = Product::where('id', $ids)->where('is_active',0)->first();
        return Response::json(array('success' => true, 'products' => [
                              [
                              'id' => $test->id,
                              'kode_produk' => $test->kode_produk,
                              'nama_produk' => $test->nama_produk,
                              'harga_jual_satuan' => $test->harga_jual_satuan,
                              'stok' => $test->stok
                              ]
                        ]), 200);

         /*
        return response()->json([
                'data' => [
                              '0' => $test->id,
                              '1' => $test->kode_produk,
                              '2' => $test->nama_produk,
                              '3' => $test->harga_jual_satuan,
                              '4' => $test->stok

                        ]
                ]);
        if ($request->input('id')) {
            $entries = Product::whereIn('id', $request->input('id'))->get();

            foreach ($entries as $test) {

            return Response::json(array('success' => true, 'data' => [
                              'id' => $test->id,
                              'kode_produk' => $test->kode_produk,
                              'nama_produk' => $test->nama_produk,
                              'harga_jual_satuan' => $test->harga_jual_satuan,
                              'stok' => $test->stok
                        ]), 200);

            }
        }
        */
    }

    public function findSatuan(Request $request)
    {
        $ids = $request->id;//6;//array($request->id);


        if ($ids == "") {
            $idxx = 70;
        } else{
            $idxx = $ids;
        }

        //$test = ProdukUom::where('produk_id', $idxx)->get()->toArray();
        //$test1 = ProdukUom::where('produk_id', $idxx)->first();//->toArray();
        $test1 = Product::where('id', $idxx)->first();
        $test2 = explode(', ', $test1->uom_id);
        //$test  = implode(', ', $test2);
        $test  = $test1->uom_id;

        //return response()->json(array('uom_id'=>$test2));
        return response()->json($test2);

    }

    public function satuan($id)
    {
        $ids = $id;//$request->id;//6;//array($request->id);

        if ($ids == "") {
            $idxx = 70;
        } else{
            $idxx = $ids;
        }

        $test1 = Product::where('id', $idxx)->first();//->toArray();

        $result = explode(', ', $test1->uom_id);
        foreach($result as $key => $str) {
                //$sub = explode("-",$res);
                $test[$key] = explode(' ', $str);


        }

        $test3 = Response::json(array('data' =>
                              [$test]
                              //'kode_produk' => $test->kode_produk,
                              //'nama_produk' => $test->nama_produk,
                              //'harga_jual_satuan' => $test->harga_jual_satuan,
                              //'stok' => $test->stok
                        ), 200);

        $data = '{
                    "uom_id": $test3
                 }';


        return response()->json($test);
    }

    public function satuanx($id)
    {
        $ids = $id;//6;//array($request->id);


        if ('undefined' == $ids) {
            $idxx = 70;
        } else{
            $idxx = $ids;
        }

        //$test = ProdukUom::where('produk_id', $idxx)->get()->toArray();
        //$test1 = ProdukUom::where('produk_id', $idxx)->first();//->toArray();
        $test1 = Product::where('id', $idxx)->first();
        $test2 = explode(', ', $test1->uom_id);
        //$test  = implode(', ', $test2);
        $test  = $test1->uom_id;

        //return response()->json(array('uom_id'=>$test2));
        return response()->json($test2);

    }

      /*
    public function listsatuan()
    {
        $input   = Input::get('produk_id');
        $numbers = DB::table('product_uoms')
                 ->where('produk_id', $input)
                 ->orderBy('id', 'asc')
                 ->pluck('uom_id','uom_id');

        return Response::json($numbers);
    }
        */
    public function listsatuan(Request $request)
    {
        $input   = Input::get('kode_produk');
        $numbers = DB::table('product_uoms')
                 ->where('produk_id', $request->kode_produk)
                 ->orderBy('id', 'asc')
                 ->pluck('uom_id','uom_id');

        return Response::json($numbers);
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
        return redirect()->route('pembelians.index');
        */

        DB::table('pembelians')->where('id', '=', $id)->delete();
        DB::table('pembelian_details')->where('pembelian_id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return Redirect::to('pembelian');
    }

    public function detail($id){
        $pembelian = DB::table('pembelians')->where('id',$id)->first();
        //$pembelian_detail = DB::table('pembelian_details')->where('pembelian_id',$id)->first();
        //$pembelian_detail = DB::table('pembelian_details')->select('id','no_faktur')->where('pembelian_id',$id)->first();
        $pembelian_detail = PembelianDetail::all()->where('pembelian_id','=>',$id);
        $pembelian =
          [
            'pembelian' => $pembelian
          ];
        return view('modules.pembelian.detail', $pembelian,compact('pembelian_detail'));

    }

    public function getdataHutang21(){
        /*
        $roles = DB::table('pembelians')
                 ->join('kontaks','pembelians.kontak_id', '=', 'kontaks.id')
                 ->select('pembelians.id','pembelians.no_faktur','pembelians.no_po', 'pembelians.tanggal_faktur', 'kontaks.nama_kontak', 'kontaks.kurs', 'pembelians.proyek', 'pembelians.uang_muka', 'pembelians.biaya_lain', 'pembelians.total_setelah_pajak', 'pembelians.saldo_terutang', DB::raw('SUM(pembelians.saldo_terutang - pembelians.uang_muka + pembelians.biaya_lain) as totalhutang'))
                 ->groupBy('pembelians.kontak_id')
                 ;
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="pembelian/detail/'.$role->id.'" title="Detail Data Pembelian"><button type="button" class="btn btn-sm btn-success"><i class="fa fa-search"></i></button></a> <a href="pembelian/print/'.$role->id.'" title="Print Data Pembelian"><button type="button" class="btn btn-sm btn-default"><i class="fa fa-print"></i></button></a> <a href="pembelian/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
            })
        ->make(true);
        */
        $roles = DB::table('pembelians')
                 ->join('kontaks','pembelians.kontak_id', '=', 'kontaks.id')
                 ->select('pembelians.id','pembelians.no_faktur','pembelians.no_po', 'pembelians.tanggal_faktur', 'kontaks.nama_kontak', 'pembelians.proyek', 'pembelians.total_setelah_pajak', 'pembelians.saldo_terutang')
                 ;
        return json_encode($roles);
    }

    public function getdataHutang(){
       /* $roles = DB::table('pembelians')
                 ->join('kontaks','pembelians.kontak_id', '=', 'kontaks.id')
                 ->leftJoin('pembayarans','pembelians.kontak_id', '=', 'pembayarans.kontak_id')
                 ->select('kontaks.nama_kontak', 'kontaks.kurs', DB::raw('SUM(pembelians.saldo_terutang) as totalhutang'), DB::raw('SUM(IFNULL(pembayarans.nilai,0)) as totalbayar'), DB::raw('SUM(pembelians.saldo_terutang) - SUM(IFNULL(pembayarans.nilai,0))as saldohutang')
                   )
                 //->where('is_tunai','=',1)
                 ->groupBy('pembelians.kontak_id')
                 ;
        $roles = DB::table('views_saldo_hutang')
                 ->join('kontaks','views_saldo_hutang.kontak_id','kontaks.id')
                 ->select('kontaks.nama_kontak', 'kontaks.kurs', 'views_saldo_hutang.saldo_terutang as totalhutang', 'views_saldo_hutang.bayar as totalbayar','views_saldo_hutang.saldohutang'); */
        $roles = DB::table('pembelians')
                 ->leftJoin('pembayaran_details', 'pembelians.id', '=', 'pembayaran_details.pembelian_id')
                 ->leftJoin('pembayarans', 'pembayarans.id', '=', 'pembayaran_details.pembayaran_id')
                 ->leftJoin('kontaks','pembelians.kontak_id','=','kontaks.id')
                 ->select('kontaks.nama_kontak','kontaks.kurs','pembelians.saldo_terutang AS totalhutang', DB::raw('SUM(IFNULL(pembayarans.nilai,0)) AS totalbayar'), DB::raw('(IFNULL(pembelians.saldo_terutang,0)) - (SUM(IFNULL(pembayarans.nilai,0))) AS saldohutang')
                   )
                 ->where('pembelians.saldo_terutang','!=',0)
                 ->groupBy('kontaks.nama_kontak','kontaks.kurs','pembelians.saldo_terutang')
                 ;
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="pembelian/detail/'.$role->nama_kontak.'" title="Detail Data Pembelian"><button type="button" class="btn btn-sm btn-success"><i class="fa fa-search"></i></button></a> <a href="pembelian/print/'.$role->nama_kontak.'" title="Print Data Pembelian"><button type="button" class="btn btn-sm btn-default"><i class="fa fa-print"></i></button></a> <a href="pembelian/delete/'.$role->nama_kontak.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
            })
        ->make(true);
    }

    public function daftarhutang(){
    $uoms =  Uom::All();
    $kontak = Kontak::pluck('nama_kontak','id');
    return view('modules.pembelian.daftarhutang',compact('uoms','kontak'));
    }

    public function excelHutang() {

    // Execute the query used to retrieve the data. In this example
    // we're joining hypothetical users and payments tables, retrieving
    // the payments table's primary key, the user's first and last name,
    // the user's e-mail address, the amount paid, and the payment
    // timestamp.

    $payments = Pembelian::leftJoin('pembayaran_details', 'pembelians.id', '=', 'pembayaran_details.pembelian_id')
                 ->leftJoin('pembayarans', 'pembayarans.id', '=', 'pembayaran_details.pembayaran_id')
                 ->leftJoin('kontaks','pembelians.kontak_id','=','kontaks.id')
                 ->select('kontaks.nama_kontak','kontaks.kurs','pembelians.saldo_terutang AS totalhutang', DB::raw('SUM(IFNULL(pembayarans.nilai,0)) AS totalbayar'), DB::raw('(IFNULL(pembelians.saldo_terutang,0)) - (SUM(IFNULL(pembayarans.nilai,0))) AS saldohutang')
                   )
                 ->where('pembelians.saldo_terutang','!=',0)
                 ->groupBy('kontaks.nama_kontak','kontaks.kurs','pembelians.saldo_terutang')
                 ->get();

    /*
    $payments = Product::select('id', 'kode_produk', 'nama_produk', 'kategori_id', 'kode_alias', 'nama_alias', 'stok', 'harga_jual_satuan', 'supplier_id', 'uom_id', 'pajak_masuk', 'pajak_keluar')
                ->get();
    */


    // Initialize the array which will be passed into the Excel
    // generator.
    $paymentsArray = [];

    // Define the Excel spreadsheet headers
    $paymentsArray[] = ['nama_kontak','kurs','totalhutang','totalbayar','saldohutang'];

    // Convert each member of the returned collection into an array,
    // and append it to the payments array.
    foreach ($payments as $payment) {
             $paymentsArray[] = $payment->toArray();
    }

    // Generate and return the spreadsheet
    Excel::create('data_hutang', function($excel) use ($paymentsArray) {

        // Set the spreadsheet title, creator, and description
        $excel->setTitle('Data Hutang');
        $excel->setCreator('AlFaris')->setCompany('Aplikasi POS');
        $excel->setDescription('data_hutang file');

        // Build the spreadsheet, passing in the payments array
        $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
            $sheet->fromArray($paymentsArray, null, 'A1', false, false);
        });

    })->download('xlsx')->with('success','Data sudah diexport');
  }


  public function excel() {

    $payments = Pembelian::leftJoin('kontaks','pembelians.kontak_id', '=', 'kontaks.id')
                 ->leftJoin('pembelian_details','pembelians.id','pembelian_details.pembelian_id')
                 ->leftJoin('products','pembelian_details.kode_produk','products.id')
                 ->select('pembelians.id', 'pembelians.tanggal_faktur','pembelians.no_faktur',
                          'pembelians.no_po', DB::raw('IFNULL(kontaks.nama_kontak,"Retail")'),
                          'products.kode_produk','products.nama_produk', DB::raw('IFNULL(pembelian_details.qty_terima,0) AS qty_terima'),
                          'pembelian_details.harga_beli',
                          DB::raw('(IFNULL(pembelian_details.qty_terima,0)*pembelian_details.harga_beli) AS subtotal'),
                          DB::raw('IFNULL(pembelian_details.diskon,0) AS diskon'),
                          DB::raw('IFNULL(pembelian_details.qty_terima,0)*pembelian_details.harga_beli*IFNULL(pembelian_details.diskon,0)/100 AS total_diskon'),
                          DB::raw('(IFNULL(pembelian_details.qty_terima,0)*pembelian_details.harga_beli)-(IFNULL(pembelian_details.qty_terima,0)*pembelian_details.harga_beli*IFNULL(pembelian_details.diskon,0)/100) AS total_setelah_diskon')
                          //'penjualans.total_setelah_pajak',
                          //'penjualans.saldo_terutang'
                          )
                 ->get();

    // Initialize the array which will be passed into the Excel
    // generator.
    $paymentsArray = [];

    // Define the Excel spreadsheet headers

    $paymentsArray[] = ['id','tanggal_faktur','no_faktur','no_po','Pemasok','kode_produk','nama_produk','qty_beli', 'harga_beli', 'Subtotal', 'diskon (%)', 'total_diskon', 'total_setelah_diskon'];

    // Convert each member of the returned collection into an array,
    // and append it to the payments array.
    foreach ($payments as $payment) {
             $paymentsArray[] = $payment->toArray();
    }

    // Generate and return the spreadsheet
    Excel::create('pembelian', function($excel) use ($paymentsArray) {

        // Set the spreadsheet title, creator, and description
        $excel->setTitle('Pembelian');
        $excel->setCreator('AlFaris')->setCompany('Aplikasi POS');
        $excel->setDescription('pembelian file');

        // Build the spreadsheet, passing in the payments array
        $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
            $sheet->fromArray($paymentsArray, null, 'A1', false, false);
        });

    })->download('xlsx')->with('success','Data sudah diexport');
  }

  public function cek(){
    return view('modules.pembelian.cek');
  }

}
