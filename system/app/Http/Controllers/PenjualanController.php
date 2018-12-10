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
Use PDF;
use DataTables;
use Input;
use App\Penjualan;
use App\PenjualanDetail;
use App\HargaJual;
use App\Harga;
use Session;
use Response;
use Validator;
use Excel;
use Redirect;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use App\InfoToko;
use App\Items;

class PenjualanController extends Controller
{
    public function index(){

    $uoms =  Uom::All();
    $kontak = Kontak::pluck('nama_kontak','id');

    return view('modules.penjualan.index',compact('uoms','kontak'));
    }

    public function piutang(){

    $uoms =  Uom::All();
    $kontak = Kontak::pluck('nama_kontak','id');

    return view('modules.penjualan.piutang',compact('uoms','kontak'));
    }

    public function data()
    {
        $roles = DB::table('penjualans')
                 ->leftJoin('kontaks','penjualans.kontak_id', '=', 'kontaks.id')
                 ->select('penjualans.id','penjualans.no_faktur','penjualans.no_po', 'penjualans.tanggal_faktur', DB::raw('IFNULL(kontaks.nama_kontak,"Retail") as nama_kontak'), 'penjualans.proyek', 'penjualans.total_setelah_pajak', 'penjualans.saldo_terutang')
                 ;
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified">
                    <a href="penjualan/detail/'.$role->id.'" title="Detail Data penjualan"><button type="button" class="btn btn-sm btn-success"><i class="fa fa-search"></i></button></a>
                    <a href="penjualan/print/'.$role->id.'" title="Print Data penjualan"><button type="button" class="btn btn-sm btn-default"><i class="fa fa-print"></i></button></a>
                    <a href="penjualan/pdf/'.$role->id.'" title="Print 2 Data penjualan"><button type="button" class="btn btn-sm btn-default"><i class="fa fa-print"></i></button></a>
                    <a href="penjualan/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>
                  </div>';
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
        $date = '00'; //00000000098

        $dataMax = DB::table('penjualans')->select(['no_faktur as ID'])
                   //->where('id','<=','120')
                   ->orderBy('no_faktur', 'DESC')
                   ->get();
        $dataMax2 = Str::substr($dataMax,8,11);
        $param1 = 'PJ';
        $param  = $param1.$date.'' ;
            if($dataMax2=='') {
                // Bila Data Kosong
                //$ID = $param."0000001";
                $ID = "00000000001";
            }else {
                $MaksID = $dataMax2;
                $MaksID++;
                /*
                if($MaksID < 10) $ID = $param."000000".$MaksID; // nilai kurang dari 10
                //else if($MaksID < 100) $ID = $param."0000000".$MaksID; // nilai kurang dari 100
                //else if($MaksID < 1000) $ID = $param."000000".$MaksID; // nilai kurang dari 100
                else if($MaksID < 10000) $ID = $param."00000".$MaksID; // nilai kurang dari 100
                else if($MaksID < 100000) $ID = $param."0000".$MaksID; // nilai kurang dari 1000
                else if($MaksID < 1000000) $ID = $param."000".$MaksID; // nilai kurang dari 10000
                else if($MaksID < 10000000) $ID = $param."00".$MaksID; // nilai kurang dari 10000
                else if($MaksID < 100000000) $ID = $param."0".$MaksID; // nilai kurang dari 10000
                else $ID = $MaksID; // lebih dari 10000 */
                if($MaksID < 10) $ID = "0000000000".$MaksID; // nilai kurang dari 10
                else if($MaksID < 100) $ID = "000000000".$MaksID; // nilai kurang dari 100
                else if($MaksID < 1000) $ID = "00000000".$MaksID; // nilai kurang dari 1000
                else if($MaksID < 10000) $ID = "0000000".$MaksID; // nilai kurang dari 10000
                else if($MaksID < 100000) $ID = "000000".$MaksID; // nilai kurang dari 100000
                else if($MaksID < 1000000) $ID = "00000".$MaksID; // nilai kurang dari 1000000
                else if($MaksID < 10000000) $ID = "0000".$MaksID; // nilai kurang dari 10000000
                else if($MaksID < 100000000) $ID = "000".$MaksID; // nilai kurang dari 100000000
                else if($MaksID < 1000000000) $ID = "00".$MaksID; // nilai kurang dari 1000000000
                else if($MaksID < 10000000000) $ID = "0".$MaksID; // nilai kurang dari 10000000000
                else $ID = $MaksID; // lebih dari 10000
            }
        //$id = $date.'.'.$ID;
        $invoice = $ID;

        //$invoice = $this->getNewInvoiceNo();

        //$product_list = Product::pluck('nama_produk','id');
        //$kontak_list = Kontak::pluck('nama_kontak','id');
            $product_list = Product::all();
            $kontak_list = Kontak::all()->where('tipe','=','Customer');
        $gudang_list = Gudang::pluck('nama_gudang','id');
        $departement_list = Departement::pluck('nama_departement','id');
      $product_uoms_list = DB::table('product_uoms')->where('produk_id', Input::get('produk_id'))->pluck('uom_id','uom_id');

      //$uoms_list = Uom::pluck('nama_uom','nama_uom');
      $uoms_list = Uom::pluck('nama_uom','nama_uom');
        return view('modules.penjualan.add',compact('kontak_list','product_list','invoice','gudang_list','departement_list','uoms_list'));
        //return view('modules.penjualan.add');
    }

    public function insert(Request $request)
    {


      $rules = array(
      'qty' => 'required',
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
            return redirect()->route('penjualan.create')->withErrors($validator)->withInput();
      } else {
        //date_default_timezone_set('Asia/Jakarta');
        $penjualan = new Penjualan;
        $penjualan->jenis_penjualan=$request->jenis_penjualan;
        $penjualan->kontak_id=$request->kontak_id;
        $penjualan->no_faktur=$request->no_faktur;
        $penjualan->no_po=$request->no_po;

        $var = $request->tanggal_faktur;
        $date = str_replace('/', '-', $var);
        $value = date('Y-m-d', strtotime($date));

        $penjualan->tanggal_faktur=$value;
        $penjualan->proyek=$request->proyek;
        $penjualan->gudang_keluar_id=$request->gudang_masuk_id;
        $penjualan->keterangan=$request->keterangan;
                $penjualan->departement_id=$request->departement_id;

                $penjualan->nama_konsumen=$request->nama_konsumen;
                $penjualan->alamat_konsumen=$request->alamat_konsumen;
                $penjualan->kota_konsumen=$request->kota_konsumen;
                $penjualan->desa_konsumen=$request->desa_konsumen;
                $penjualan->provinsi_konsumen=$request->provinsi_konsumen;
                $penjualan->hp_konsumen=$request->hp_konsumen;
                $penjualan->expedisi=$request->expedisi;

        $var = $request->tanggal_kirim;
        $date = str_replace('/', '-', $var);
        $tanggal_kirim = date('Y-m-d', strtotime($date));

        $penjualan->tanggal_kirim=$tanggal_kirim;
        $penjualan->sales=$request->bagian_penjualan;
        $penjualan->term_pembayaran=$request->denda_terlambat;
        $penjualan->debit_kredit=$request->debit_kredit;
        $penjualan->biaya_lain=$request->biaya_lain;

        $stt = Str::substr($request->totalpajak,4,50);
        $st3 = (int)str_replace(array(' ', ','), '', $stt);
        $penjualan->total_pajak=$st3;

        $sttt = Str::substr($request->totalsetelahpajak,4,50);
        $st4 = (int)str_replace(array(' ', ','), '', $sttt);
        $penjualan->total_setelah_pajak=$st4;
        $penjualan->uang_muka=$request->uang_muka;

        $st = Str::substr($request->saldo_terutang,4,50);
        $st2 = (int)str_replace(array(' ', ','), '', $st);
        $penjualan->saldo_terutang=$st2;
        $penjualan->is_tunai=$request->is_tunai;
        $penjualan->is_cetak=$request->is_cetak;
        $penjualan->is_void=$request->is_void;
        $penjualan->is_canceled=$request->is_canceled;
        $penjualan->user_id = $request->user_id;
        if ($penjualan->save()){
            $id = $penjualan->id;
            foreach ($request->nama_produk as $key => $v)
            {
                date_default_timezone_set('Asia/Jakarta');
                $data = array(
                        'penjualan_id'   => $id,
                        'no_faktur'      => $request->no_faktur,
                        'produk_id'      => $request->produk_id[$key],
                        //'akun_id'        => $request->akun_id[$key],
                        'qty_terima'     => $request->qty[$key],
                        'qty_pesan'      => $request->qty_pesan[$key],
                        'uom_id'         => $request->uom_id[$key],
                        'harga_jual'     => $request->harga[$key],
                        'diskon'         => $request->discount[$key],
                        'total'          => $request->amount[$key],
                        'pajak'          => $request->pajak[$key],
                        'proyek2'        => $request->proyek2[$key],
                        'created_at'     => DB::raw('now()'),
                        'updated_at'     => DB::raw('now()')
                    );
                PenjualanDetail::insert($data);
                //-- Manajemen Stok --//
                $qty = Product::select('stok')->where('id', $request->produk_id[$key])->first();

                DB::table('products')
                ->where('id', $request->produk_id[$key])
                ->update(array(
                      'stok' => $qty->stok - $request->qty[$key],
                      //'created_at' => date('y-m-d h:m:s'),
                      'updated_at' => date('y-m-d h:m:s')
                ));
            }
        }
        }

        //return redirect()->route('penjualan.index');
        return redirect()->route('penjualan.detail',$penjualan->id);
    }

    public function findPrice2(Request $request)
    {
        $data = Product::select('harga_jual_satuan')->where('id', $request->id)->first();
        return response()->json($data);
    }

    public function findPrice(Request $request)
    {
        $data = HargaJual::select('harga_jual_satuan')->where('produk', $request->id)->where('kontak_id', $request->kontak_id)->first();
        return response()->json($data);
    }

    public function Price(Request $request)
    {
        $data = Product::select('harga_jual_satuan')->where('id', $request->id)->first();
        $data2 = Harga::select('harga_jual_pelanggan AS harga_jual_satuan')->where('produk_id', $request->id)->where('kontak_id', $request->kontak_id)->where('uom_id',$request->uom_id)->first();

        if ($data2 == '') {
            $data3 = $data;
        }else{
            $data3 = $data2;
        }
        return response()->json($data3);
    }
    public function findKodeProduk(Request $request)
    {
        $data = Product::select('kode_produk')->where('id', $request->id)->first();
        return response()->json($data);
    }

    public function findSatuan(Request $request)
    {
        $datax = Harga::select('uom_id')->where('produk_id', $request->id)->where('kontak_id', $request->kontak_id)->first();
        if (count($datax) >= 1) {
            $data = $datax;
        }else{
            $data = 'pcs';
        }
        return response()->json($datax);
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
        return redirect()->route('penjualans.index');
        */

        DB::table('penjualans')->where('id', '=', $id)->delete();
        DB::table('penjualan_details')->where('penjualan_id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return Redirect::to('penjualan');
    }

    public function detail($id){

        $pembelian = DB::table('penjualans')->where('id',$id)->first();
        $pembelian_detail = PenjualanDetail::all()->where('penjualan_id','=>',$id);
        $pembelian =
          [
            'pembelian' => $pembelian
          ];
        return view('modules.penjualan.detail', $pembelian, compact('pembelian_detail'));

    }

    public function getdataPiutang(){
        $roles = DB::table('penjualans')
                 ->leftJoin('piutang_details', 'penjualans.id', '=', 'piutang_details.penjualan_id')
                 ->leftJoin('piutangs', 'piutang_details.piutang_id', '=', 'piutangs.id')
                 ->leftJoin('kontaks','penjualans.kontak_id','=','kontaks.id')
                 ->select('kontaks.nama_kontak AS namaKontak','kontaks.kurs','penjualans.saldo_terutang AS saldoTerutang', DB::raw('SUM(IFNULL(piutangs.nilai,0)) AS diBayar'), DB::raw('(IFNULL(penjualans.saldo_terutang,0)) - (SUM(IFNULL(piutangs.nilai,0))) AS totalPiutang')
                   )
                 ->where('penjualans.saldo_terutang','!=',0)
                 ->groupBy('kontaks.nama_kontak','kontaks.kurs','penjualans.saldo_terutang')
                 ;
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="pembelian/detail/'.$role->namaKontak.'" title="Detail Data Pembelian"><button type="button" class="btn btn-sm btn-success"><i class="fa fa-search"></i></button></a> <a href="pembelian/print/'.$role->namaKontak.'" title="Print Data Pembelian"><button type="button" class="btn btn-sm btn-default"><i class="fa fa-print"></i></button></a> <a href="pembelian/delete/'.$role->namaKontak.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
            })
        ->make(true);
    }

    public function daftarpiutang(){

    $uoms =  Uom::All();
    $kontak = Kontak::pluck('nama_kontak','id');
    return view('modules.pembelian.piutang',compact('uoms','kontak'));
    }

    public function excel() {

    $payments = Penjualan::leftJoin('kontaks','penjualans.kontak_id', '=', 'kontaks.id')
                 ->leftJoin('penjualan_details','penjualans.id','penjualan_details.penjualan_id')
                 ->leftJoin('products','penjualan_details.produk_id','products.id')
                 ->select('penjualans.id', 'penjualans.tanggal_faktur','penjualans.no_faktur',
                          'penjualans.no_po', DB::raw('IFNULL(kontaks.nama_kontak,"Retail")'),
                          'kode_produk','nama_produk', DB::raw('IFNULL(penjualan_details.qty_terima,0) AS qty_terima'),
                          'penjualan_details.harga_jual',
                          DB::raw('(IFNULL(penjualan_details.qty_terima,0)*penjualan_details.harga_jual) AS subtotal'),
                          DB::raw('IFNULL(penjualan_details.diskon,0) AS diskon'),
                          DB::raw('IFNULL(penjualan_details.qty_terima,0)*penjualan_details.harga_jual*IFNULL(penjualan_details.diskon,0)/100 AS total_diskon'),
                          DB::raw('(IFNULL(penjualan_details.qty_terima,0)*penjualan_details.harga_jual)-(IFNULL(penjualan_details.qty_terima,0)*penjualan_details.harga_jual*IFNULL(penjualan_details.diskon,0)/100) AS total_setelah_diskon')
                          //'penjualans.total_setelah_pajak',
                          //'penjualans.saldo_terutang'
                          )
                 ->get();

    // Initialize the array which will be passed into the Excel
    // generator.
    $paymentsArray = [];

    // Define the Excel spreadsheet headers

    $paymentsArray[] = ['id','tanggal_faktur','no_faktur','no_po','Pelanggan','kode_produk','nama_produk','qty_jual', 'harga_jual', 'Subtotal', 'Diskon (%)', 'total_diskon', 'total_setelah_diskon'];


    // Convert each member of the returned collection into an array,
    // and append it to the payments array.
    foreach ($payments as $payment) {
             $paymentsArray[] = $payment->toArray();
    }

    // Generate and return the spreadsheet
    Excel::create('penjualan', function($excel) use ($paymentsArray) {

        // Set the spreadsheet title, creator, and description
        $excel->setTitle('Penjualan');
        $excel->setCreator('AlFaris')->setCompany('Aplikasi POS');
        $excel->setDescription('penjualan file');

        // Build the spreadsheet, passing in the payments array
        $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
            $sheet->fromArray($paymentsArray, null, 'A1', false, false);
        });

    })->download('xlsx')->with('success','Data sudah diexport');
  }

  public function faktur(Request $request, $id)
       {
            $products = Product::all();
            $penjualan = PenjualanDetail::leftJoin('penjualans','penjualan_details.penjualan_id','=','penjualans.id')
                                    ->leftJoin('kontaks','penjualans.kontak_id','kontaks.id')
                                    ->leftJoin('products','penjualan_details.produk_id','products.id')
                                    ->select(
                                            'penjualans.id',
                                            'kontaks.nama_kontak',
                                             DB::raw('IFNULL(kontaks.nama_kontak,"Retail") as nama_kontak'),
                                            'penjualans.no_faktur',
                                            'penjualans.tanggal_faktur',
                                            'penjualans.tanggal_kirim',
                                            'penjualans.uang_muka',
                                            'products.kode_produk',
                                            'products.nama_produk',
                                            'penjualan_details.qty_terima',
                                            'penjualan_details.uom_id',
                                            'penjualan_details.harga_jual',
                                            'penjualan_details.diskon',
                                            DB::raw('penjualan_details.qty_terima*penjualan_details.harga_jual as amount'),
                                            DB::raw('penjualan_details.qty_terima*penjualan_details.harga_jual*(penjualan_details.diskon/100) as tdiskon'),
                                            DB::raw('(penjualan_details.qty_terima*penjualan_details.harga_jual)-(penjualan_details.qty_terima*penjualan_details.harga_jual*(penjualan_details.diskon/100)) as ttlamount')
                                        )
                                    ->where('penjualan_details.penjualan_id',$id)
                                    ->first();

        $items = PenjualanDetail::leftJoin('products','penjualan_details.produk_id','products.id')
                                ->select(
                                    'products.kode_produk',
                                    'products.nama_produk',
                                    'penjualan_details.qty_terima',
                                    'penjualan_details.uom_id',
                                    'penjualan_details.harga_jual',
                                    'penjualan_details.diskon',
                                    'penjualan_details.pajak'
                                    )
                                ->where('penjualan_details.penjualan_id',$id)
                                ->get();
        $total = PenjualanDetail::select(
                                    DB::raw('SUM(penjualan_details.qty_terima*penjualan_details.harga_jual) AS ttl')
                                    )
                                ->where('penjualan_details.penjualan_id',$id)
                                ->first();

        $info = DB::table('info_toko')
                   ->select(
                     'nama_toko',
                     'alamat_toko',
                     'desa_toko',
                     'kecamatan_toko',
                     'kota_toko',
                     'provinsi_toko',
                     'kode_pos_toko',
                     'hp_toko'
                     )
                   ->first();

         $nett = PenjualanDetail::select(
                                    DB::raw('SUM(penjualan_details.qty_terima*penjualan_details.harga_jual) -
                                             SUM(penjualan_details.qty_terima*penjualan_details.harga_jual*(penjualan_details.diskon/100)) AS nett')
                                       )
                                ->where('penjualan_details.penjualan_id',$id)
                                //->groupBy('penjualan_details.penjualan_id')
                                ->first();

                view()->share('products',compact('penjualan','items','nett','info'));
                if($request->has('download')){
                    $pdf = PDF::loadView('htmltopdfview',compact('penjualan','items','nett'));
                    return $pdf->download('htmltopdfview',compact('penjualan','items','nett'));

            }

            return view('modules.penjualan.tagihan',compact('penjualan','items','nett','info'));

            //$pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
              //    ->loadView('modules.penjualan.tagihan', compact('penjualan','items','nett','info'));
            //return $pdf->stream();
       }

       public function struk(Request $request, $id)
       {
          try {

              $id = $request->id;
              $priter_var = DB::table('printer_tab')->first();
              //$connector = new WindowsPrintConnector("EPSON TM-U220 ReceiptE4");
              $ip = $priter_var->ip; //"192.168.1.21";
              $printer = $priter_var->printer; //"EPSON L805 Series";
              //$connector = new WindowsPrintConnector("smb://'.$ip.'/'.$printerName.'");
              //$ip = '192.168.111.11'; // IP Komputer kita atau printer lain yang masih satu jaringan
			        //$printer = 'EPSON TM-U220 Receipt'; // Nama Printer yang di sharing
		    	    $connector = new WindowsPrintConnector("smb://" . $ip . "/" . $printer);
              //$connector = new WindowsPrintConnector("epson lx-310 admin holis");
              $printer = new Printer($connector);

              /* Information for the receipt
              $items = array(
                  new Product("Example item #1", "4.00"),
                  new Product("Another thing", "3.50"),
                  new Product("Something else", "1.00"),
                  new Product("A final item", "4.45"),
              ); */

              $toko = DB::table('info_toko')
                     ->select(
                       'nama_toko',
                       'alamat_toko',
                       'desa_toko',
                       'kecamatan_toko',
                       'kota_toko',
                       'provinsi_toko',
                       'kode_pos_toko',
                       'hp_toko'
                       )
                     ->first();

              $sales = Penjualan::leftJoin('penjualan_details','penjualans.id','penjualan_details.penjualan_id')
                        ->leftJoin('users','penjualans.user_id','users.id')
                        ->select(
                             'penjualans.id',
                             'penjualans.tanggal_faktur',
                             'users.name',
                             'penjualans.uang_muka'
                        )
                        ->where('penjualans.id','=',$id)
                        ->first();

              $fatura_al = PenjualanDetail::leftJoin('products','penjualan_details.produk_id','products.id')
                                      ->select(
                                          'products.kode_produk',
                                          'products.nama_produk',
                                          'penjualan_details.qty_terima',
                                          'penjualan_details.uom_id',
                                          'penjualan_details.harga_jual',
                                          'penjualan_details.diskon',
                                          'penjualan_details.pajak'
                                          )
                                      ->where('penjualan_details.penjualan_id','=',$id)
                                      ->get();

              $subtotal1 = 0;
              $tdiskon = 0;
              foreach ($fatura_al as $key => $value) {
               $diskon_rp = ($value['qty_terima']*$value['harga_jual'])*($value['diskon']/100);
               if ($diskon_rp > 0) {
                   # code...
                    //$n = <br>;
                    $items[] = new Product(
                                    $value['nama_produk'], 
                                    $value['qty_terima'].' x ', 
                                    number_format($value['harga_jual']), 
                                    number_format($value['qty_terima']*$value['harga_jual']),
                                    'Diskon   '.number_format(-1*$diskon_rp)
                                    );
               }else{
                    $items[] = new Items(
                                    $value['nama_produk'], 
                                    $value['qty_terima'].' x ', 
                                    number_format($value['harga_jual']), 
                                    number_format($value['qty_terima']*$value['harga_jual'])
                                    );
               }               
                   $subtotal1 += $value['qty_terima']*$value['harga_jual'];
                   $tdiskon  += $diskon_rp;
              }

              if ($diskon_rp > 0) {
                  $subtotal = new Product('','','','Subtotal :',number_format($subtotal1),true);
                  $bayar = new Product('','','', 'Bayar :',number_format($sales->uang_muka),true);
                  $total = new Product('','','', 'Total :',number_format($subtotal1-$tdiskon), true);
                  $kembali = new Product('','','', 'Kembali :',number_format(($subtotal1-$tdiskon)-$sales->uang_muka),true);
                  $totaldiskon = new Product('','','', 'Diskon :',number_format($tdiskon),true);
              } else {
                  $subtotal = new Items('','','Subtotal :', number_format($subtotal1),true);
                  $bayar = new Items('','', 'Bayar :', number_format($sales->uang_muka),true);
                  $total = new Items('','', 'Total :', number_format($subtotal1-$tdiskon), true);
                  $kembali = new Items('','', 'Kembali :', number_format(($subtotal1-$tdiskon)-$sales->uang_muka),true);
                  $totaldiskon = new Items('','', 'Diskon :', number_format($tdiskon),true);
              }
              
             

              /* Date is kept the same for testing */
              $date = date('d-m-Y');
              //$date = date('d-m-Y');
              // $date = date('d m Y h:i:s');
              //$date = "Monday 6th of April 2015 02:56:25 PM";

              /* Start the printer */
              //$logo = EscposImage::load("resources/escpos-php.png", false);
              $printer = new Printer($connector);

              /* Print top logo */
              $printer -> setJustification(Printer::JUSTIFY_CENTER);
              //$printer -> graphics($logo);
              //$printer -> setTextSize(1, 8);
              /* Name of shop */
              //$printer -> selectPrintMode(Printer::MODE_SINGLE_WIDTH);
              //$printer -> setTextSize(4,1);
              $printer -> text($toko->nama_toko."\n");
              $printer -> selectPrintMode();
              $printer -> text($toko->alamat_toko."\n");
              $printer -> text($toko->hp_toko."\n");
              //$printer -> text(" \n");
              //$printer -> text("--------------------------\n");
              //$printer -> setEmphasis(true);
              //$printer -> text('Tanggal : '.$sales->tanggal_faktur."\n");
              //$printer -> setEmphasis(false);
              //$printer -> feed();
              //$printer -> text("==========================\n");
              $printer -> feed();

              $printer -> setJustification(Printer::JUSTIFY_LEFT);
              $printer -> text('Tanggal : '.$date."\n");
              $printer -> text('Kasir   : '.$sales->name."\n");
              /* Title of receipt
              $printer -> setEmphasis(true);
              $printer -> text("==========================\n");
              $printer -> text("STRUK PENJUALAN\n");
              $printer -> text("==========================\n");
              $printer -> setEmphasis(false);
              */

              /* Items */
              //$printer -> setJustification(Printer::JUSTIFY_LEFT);
              $printer -> setJustification(Printer::JUSTIFY_RIGHT);
              $printer -> setEmphasis(true);
              $printer -> text("---------------------------------\n");
              //$printer -> text(new Product('', '', ''));
              $printer -> setEmphasis(false);
              foreach ($items as $item) {
                       $printer -> text($item);
              }
              $printer -> text("=================================\n");
              //$printer -> setEmphasis(true);
              //$printer -> text($subtotal);
              //$printer -> setEmphasis(false);
              //$printer -> feed();

              /* Tax and total */
              //$printer -> text($tax);
              //$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
              $printer -> setJustification(Printer::JUSTIFY_RIGHT);
              $printer -> text($subtotal);
              $printer -> text($totaldiskon);
              $printer -> text($total);
              $printer -> text($bayar);
              $printer -> text($kembali);
              $printer -> selectPrintMode();

              /* Footer */
              $printer -> feed();
              //$printer -> setJustification(Printer::JUSTIFY_LEFT);
              $printer -> setJustification(Printer::JUSTIFY_CENTER);
              /*
              $printer -> text('Subtotal    : '.number_format($subtotal1)."\n");
              $printer -> text('Diskon      : '.number_format($tdiskon)."\n");
              $printer -> text('Total       : '.number_format($subtotal1-$tdiskon)."\n");
              $printer -> text('Bayar       : '.number_format($sales->uang_muka)."\n");
              $printer -> text('Kembali     : '.number_format(($subtotal1-$tdiskon)-$sales->uang_muka)."\n");
              */
              //$printer -> setPrintBuffer($buffer);
              //$printer -> text("Barang Kena Pajak Sudah Termasuk PPN\n");
              $printer -> text("Terima kasih atas kunjungan Anda\n");
              //$printer -> text("For trading hours, please visit example.com\n");
              //$printer -> feed();
              //$printer -> text($date . "\n");

              /* Cut the receipt and open the cash drawer */
              $printer->cut();
              $printer->pulse();
              /* Close printer */
              $printer->close();
              // echo "Sudah di Print";
              //return true;

          } catch(Exception $e) {
              echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
              //return false;
          }
            //return redirect('penjualan');
            //var_dump($fatura_al);
            return redirect()->route('penjualan.detail',$request->pembelian_id);
      }

      public function invoicePdf($id)
      {
            $orders = PenjualanDetail::leftJoin('penjualans','penjualan_details.penjualan_id','=','penjualans.id')
                                    ->leftJoin('kontaks','penjualans.kontak_id','kontaks.id')
                                    ->leftJoin('products','penjualan_details.produk_id','products.id')
                                    ->select(
                                            'penjualans.id',
                                            'kontaks.nama_kontak',
                                            'kontaks.kontak',
                                             DB::raw('IFNULL(kontaks.nama_kontak,"Retail") as nama_kontak'),
                                            'penjualans.no_faktur',
                                            'penjualans.tanggal_faktur',
                                            'penjualans.tanggal_kirim',
                                            'penjualans.uang_muka',
                                            'products.kode_produk',
                                            'products.nama_produk',
                                            'penjualan_details.qty_terima',
                                            'penjualan_details.uom_id',
                                            'penjualan_details.harga_jual',
                                            'penjualan_details.diskon',
                                            DB::raw('penjualan_details.qty_terima*penjualan_details.harga_jual as amount'),
                                            DB::raw('penjualan_details.qty_terima*penjualan_details.harga_jual*(penjualan_details.diskon/100) as tdiskon'),
                                            DB::raw('(penjualan_details.qty_terima*penjualan_details.harga_jual)-(penjualan_details.qty_terima*penjualan_details.harga_jual*(penjualan_details.diskon/100)) as ttlamount')
                                        )
                                    ->where('penjualan_details.penjualan_id',$id)
                                    ->first();
			$order = PenjualanDetail::leftJoin('products','penjualan_details.produk_id','products.id')
                                ->select(
									//'penjualan_details.penjualan_id',
                                    'products.kode_produk',
                                    'products.nama_produk',
                                    'penjualan_details.qty_terima',
                                    'penjualan_details.uom_id',
                                    'penjualan_details.harga_jual',
                                    'penjualan_details.diskon',
                                    'penjualan_details.pajak'
                                    )
                                ->where('penjualan_details.penjualan_id',$id)
                                ->get();

            $info = DB::table('info_toko')
                   ->select(
                     'nama_toko',
                     'alamat_toko',
                     'desa_toko',
                     'kecamatan_toko',
                     'kota_toko',
                     'provinsi_toko',
                     'kode_pos_toko',
                     'hp_toko'
                     )
                   ->first();

            
            $customPaper = array(0,0,590,440);
            //$dompdf->set_paper($customPaper);

            $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
					  ->setPaper($customPaper, 'potrait')
                      ->loadView('modules.penjualan.faktur', compact('order','orders','info'));
            return $pdf->stream();
            //return var_dump($order);;
      }

      public function invoicePdf2($id)
      {
            $orders = PenjualanDetail::leftJoin('penjualans','penjualan_details.penjualan_id','=','penjualans.id')
                                    ->leftJoin('kontaks','penjualans.kontak_id','kontaks.id')
                                    ->leftJoin('products','penjualan_details.produk_id','products.id')
                                    ->select(
                                            'penjualans.id',
                                            'kontaks.nama_kontak',
                                            'kontaks.kontak',
                                             DB::raw('IFNULL(kontaks.nama_kontak,"Retail") as nama_kontak'),
                                            'penjualans.no_faktur',
                                            'penjualans.tanggal_faktur',
                                            'penjualans.tanggal_kirim',
                                            'penjualans.uang_muka',
                                            'products.kode_produk',
                                            'products.nama_produk',
                                            'penjualan_details.qty_terima',
                                            'penjualan_details.uom_id',
                                            'penjualan_details.harga_jual',
                                            'penjualan_details.diskon',
                                            DB::raw('penjualan_details.qty_terima*penjualan_details.harga_jual as amount'),
                                            DB::raw('penjualan_details.qty_terima*penjualan_details.harga_jual*(penjualan_details.diskon/100) as tdiskon'),
                                            DB::raw('(penjualan_details.qty_terima*penjualan_details.harga_jual)-(penjualan_details.qty_terima*penjualan_details.harga_jual*(penjualan_details.diskon/100)) as ttlamount')
                                        )
                                    ->where('penjualan_details.penjualan_id',$id)
                                    ->first();
            $order = PenjualanDetail::leftJoin('products','penjualan_details.produk_id','products.id')
                                ->select(
                                    //'penjualan_details.penjualan_id',
                                    'products.kode_produk',
                                    'products.nama_produk',
                                    'penjualan_details.qty_terima',
                                    'penjualan_details.uom_id',
                                    'penjualan_details.harga_jual',
                                    'penjualan_details.diskon',
                                    'penjualan_details.pajak'
                                    )
                                ->where('penjualan_details.penjualan_id',$id)
                                ->get();

            $info = DB::table('info_toko')
                   ->select(
                     'nama_toko',
                     'alamat_toko',
                     'desa_toko',
                     'kecamatan_toko',
                     'kota_toko',
                     'provinsi_toko',
                     'kode_pos_toko',
                     'hp_toko'
                     )
                   ->first();

            $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
                      ->setPaper('A4', 'potrait')
                      ->loadView('modules.penjualan.faktur2', compact('order','orders','info'));
            return $pdf->stream();
            //return var_dump($order);;
      }
}
