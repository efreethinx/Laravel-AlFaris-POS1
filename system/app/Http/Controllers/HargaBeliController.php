<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Kontak;
use App\KontakDetail;
use App\Akun;
use App\Product;
use App\Harga;
use App\Category;
use App\Uom;
use App\HargaHeader;
use App\HargaBeli;
use App\HargaBeliDetail;

use DB;
use DataTables;
use Validator;
use Redirect;
use Input;
use Session;
use Excel;
use Response;
use Purifier;

class HargaBeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $harga  = HargaBeli::All();
        $hargadetail  = HargaBeliDetail::All();
        $kontak = Kontak::All();
        return view('kontak.hargabeli.index', compact('harga','kontak','hargadetail')); 
    }

    public function data()
    {
        $roles = DB::table('hargabeli')
                 ->leftJoin('hargabeli_detail','hargabeli.id','hargabeli_detail.hargabeli_id')
                 ->leftJoin('kontaks','hargabeli.kontak_id','kontaks.id')
                 ->leftJoin('products','hargabeli_detail.produk_id','products.id')
                 ->select('hargabeli_detail.id','hargabeli.id as idx','kontaks.nama_kontak','products.nama_produk','hargabeli_detail.uom_id', 'hargabeli_detail.harga_beli_khusus')
                 ;
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="'.route('hargabeli.edit',[$role->id]).'" title="Delete"><button type="button" value="'.$role->id.'" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button></a> <a href="hargajuals/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
            })
            //'.route('hargajuals.edit',[$role->id]).'
            ->make(true);
    } 

    public function findKontak(Request $request)
    {
        $data = Kontak::where('id', $request->id)->first();
        return response()->json($data);
    } 

    public function findProduk(Request $request)
    {   
        $ids = array($request->id);
        
        $test = Product::where('id', $ids)->first();
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Category::pluck('nama_kategori', 'nama_kategori');
        $supplier = Kontak::pluck('nama_kontak', 'id');
        $uoms_list = Uom::pluck('nama_uom', 'nama_uom');
        $product_list = Product::all();
        $kontak_list = Kontak::all()->where('tipe','=','Supplier');
        return view('kontak.hargabeli.create', compact('uoms_list','kategori','supplier','product_list','kontak_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
      //'qty_terima' => 'required',
      'kontak_id' => 'required',
      'harga_beli_khusus' => 'required',
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
            return redirect()->route('hargabeli.create')->withErrors($validator)->withInput();
      } else {
        //date_default_timezone_set('Asia/Jakarta');
        
        $pembelian = new HargaBeli;
        $pembelian->kontak_id=$request->kontak_id;
        
        if ($pembelian->save()){            

            $id = $pembelian->id;
            $kontak = $pembelian->kontak_id;
            foreach ($request->nama_produk as $key => $v) 
            {
                date_default_timezone_set('Asia/Jakarta');
                $data = array(
                        'hargabeli_id'       => $id,
                        'kontak_id'      => $kontak,
                        'produk_id'      => $request->produk_id[$key],
                        'kode_produk'    => $request->kode_produk[$key],
                        'uom_id'         => $request->uom_id[$key],
                        //'harga_jual_standar'          => $request->harga_jual_standar[$key],
                        'harga_beli_khusus'        => $request->harga_beli_khusus[$key],
                        'created_at'     => DB::raw('now()'),
                        'updated_at'     => DB::raw('now()')
                    );
                HargaBeliDetail::insert($data);
            }
        }
        }
        return redirect()->route('hargabeli.index')->with('success','Export Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*
        $list = HargaBeliDetail::leftJoin('kontaks','hargabeli_detail.kontak_id','kontaks.id')
              ->leftJoin('products','hargabeli_detail.produk_id','products.id')
              ->select('hargabeli_detail.id','nama_kontak','hargabeli_detail.uom_id','nama_produk', 'harga_beli_khusus')
              ->find($id);

        return response()->json([
            'status' => 'success',
            'id' => $list->id,
            'kontak_id' => $list->nama_kontak,
            'produk_id' => $list->nama_produk,
            'uom_id' => $list->uom_id,
            'harga_beli_khusus' => $list->harga_beli_khusus,
        ]);
        */

        $hargabeli = HargaBeliDetail::findOrFail($id);
        return view('kontak.hargabeli.edit', compact('hargabeli'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   /*
        $list = HargaBeliDetail::find($id);

        Validator::make($request->except('id','kontak_id','produk_id'), [
            'uom_id' => 'required|max:255',
            'harga_beli_khusus' => 'required'
        ])->validate();

        $list->uom_id = $request->uom_id;
        $list->harga_beli_khusus = $request->harga_beli_khusus;
        $list->save();

        
        return response()->json([
            'status' => 'success',
            'msg' => 'Data Produk sudah berhasil diubah'
        ]);
        
        return redirect()->route('hargabeli.index')->with('success','Data berhasil diubah.');
        

        $uoms = HargaBeliDetail::findOrFail($id);

        $uoms->update($request->all());

        return redirect()->route('hargabeli.index');
        */

        $rules = array(
            //'kode_akun' => 'max:255',
            'harga_beli_khusus' => 'max:255',
          );

          $validator = Validator::make(Input::all(), $rules);

          if ($validator->fails()) {
                echo "string";
                return Redirect::to('hargabeli/edit/'.$id)->withErrors($validator)->withInput();
          } else {
          DB::table('hargabeli_detail')
            ->where('id', $id)
            ->update(array(
                      'uom_id' => Input::get('uom_id'),
                      'harga_beli_khusus' => Input::get('harga_beli_khusus'),
                      'updated_at' => date('y-m-d h:m:s')
                ));

          Session::flash('message', 'Data Berhasil Diubah');
          return Redirect::to('hargabeli')->with('warning','Data Berhasil Diubah');
      
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function excel() {

    // Execute the query used to retrieve the data. In this example
    // we're joining hypothetical users and payments tables, retrieving
    // the payments table's primary key, the user's first and last name, 
    // the user's e-mail address, the amount paid, and the payment
    // timestamp.
   
    $payments = HargaBeli::leftJoin('hargabeli_detail','hargabeli.id','hargabeli_detail.hargabeli_id')
                 ->leftJoin('kontaks','hargabeli.kontak_id','kontaks.id')
                 ->leftJoin('products','hargabeli_detail.produk_id','products.id')
                 ->select('hargabeli_detail.id','hargabeli.id as idx','kontaks.nama_kontak','products.nama_produk','hargabeli_detail.uom_id', 'hargabeli_detail.harga_beli_khusus')
                 ->orderBy('hargabeli_detail.id')
                 ->get();    
   
    // Initialize the array which will be passed into the Excel
    // generator.
    $paymentsArray = []; 

    // Define the Excel spreadsheet headers
    $paymentsArray[] = ['id','hargabeli_id','nama_kontak','nama_produk','uom_id','harga_beli'];

    // Convert each member of the returned collection into an array,
    // and append it to the payments array.
    foreach ($payments as $payment) {
             $paymentsArray[] = $payment->toArray();
    }

    // Generate and return the spreadsheet
    Excel::create('daftar_harga_beli', function($excel) use ($paymentsArray) {

        // Set the spreadsheet title, creator, and description
        $excel->setTitle('Daftar Harga Beli');
        $excel->setCreator('AlFaris')->setCompany('Aplikasi POS');
        $excel->setDescription('harga beli file');

        // Build the spreadsheet, passing in the payments array
        $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
            $sheet->fromArray($paymentsArray, null, 'A1', false, false);
        });

    })->download('xlsx')->with('success','Export Success');
  }





}
