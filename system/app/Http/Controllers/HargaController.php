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

use DB;
use DataTables;
use Validator;
use Redirect;
use Input;
use Session;
use Excel;
use Response;

class HargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $harga  = Harga::All();
        $kontak = Kontak::All();
        return view('kontak.harga.index', compact('harga','kontak')); 
    }

    public function data()
    {
        $roles = DB::table('hargajual')
                 ->leftJoin('hargajual_hdr','hargajual.harga_id','hargajual_hdr.id')
                 ->leftJoin('kontaks','hargajual.kontak_id','kontaks.id')
                 ->leftJoin('products','hargajual.produk_id','products.id')
                 ->select('hargajual.id','hargajual_hdr.id as idx','kontaks.nama_kontak','products.nama_produk','hargajual.uom_id','products.harga_jual_satuan','hargajual.harga_jual_pelanggan')
                 ;
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="'.route('hargajuals.edit',[$role->id]).'" title="Delete"><button type="button" value="'.$role->id.'" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button></a> <a href="hargajuals/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
            })
            //'.route('hargajuals.edit',[$role->id]).' <button type="button" value="'.$role->id.'" class="btn btn-warning btn-sm edit-btn" data-toggle="modal" data-target="#edit-item"><i class="fa fa-pencil"></i></button>
            ->make(true);
    }   

    public function findKontak(Request $request)
    {
        $data = Kontak::where('id', $request->id)->first();
        return response()->json($data);
    } 

    public function findProdukx(Request $request)
    {
        $data = Product::where('id', $request->id)->first();
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

    public function findSatuan(Request $request)
    {
        //if ($request->input('ids')) {
            $entries = Product::where('id', $request->id)->first();

            foreach ($entries as $entry) {
                     $uoms = $entry->uom_id;
            }
       // }
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
        $kontak_list = Kontak::all()->where('tipe','=','Customer');
        return view('kontak.harga.create', compact('uoms_list','kategori','supplier','product_list','kontak_list'));
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
      'harga_jual_pelanggan' => 'required',
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
            return redirect()->route('hargajuals.create')->withErrors($validator)->withInput();
      } else {
        //date_default_timezone_set('Asia/Jakarta');
        
        $pembelian = new HargaHeader;
        $pembelian->kontak_id=$request->kontak_id;
        
        if ($pembelian->save()){            

            $id = $pembelian->id;
            $kontak = $pembelian->kontak_id;
            foreach ($request->nama_produk as $key => $v) 
            {
                date_default_timezone_set('Asia/Jakarta');
                $data = array(
                        'harga_id'       => $id,
                        'kontak_id'      => $kontak,
                        'produk_id'      => $request->produk_id[$key],
                        'kode_produk'    => $request->kode_produk[$key],
                        'uom_id'         => $request->uom_id[$key],
                        'harga_jual_standar'          => $request->harga_jual_standar[$key],
                        'harga_jual_pelanggan'        => $request->harga_jual_pelanggan[$key],
                        'created_at'     => DB::raw('now()'),
                        'updated_at'     => DB::raw('now()')
                    );
                Harga::insert($data);
            }
        }
        }
        return redirect()->route('hargajuals.index');
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
     * @param  \App\Uom  $uom
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*
        $kontak = HargaHeader::findOrFail($id);
        $idxx = HargaHeader::where('id',$id)->first();
        $harga = Harga::where('harga_id',$id)->first();
        $value[] = $harga;

        $kontak_list2 = Kontak::where('id',$idxx->kontak_id)->first();

        $kategori = Category::pluck('nama_kategori', 'nama_kategori');
        $supplier = Kontak::pluck('nama_kontak', 'id');
        $uoms_list = Uom::pluck('nama_uom', 'nama_uom');
        $product_list = Product::all();
        $kontak_list = Kontak::all()->where('tipe','=','Customer');
        //return view('kontak.harga.edit', compact('harga','kontak','uoms_list','kategori','supplier','product_list','kontak_list'));

        $roleId = DB::table('hargajual_hdr')->where('id',$id)->first();
        $roleId =
        [
          'roleId' => $roleId
        ];
        return view('kontak.harga.edit', $roleId, compact('value','kontak_list2','harga','kontak','uoms_list','kategori','supplier','product_list','kontak_list'));
        
        //$idxx = HargaHeader::find($id);
        
        $list = Harga::leftJoin('kontaks','hargajual.kontak_id','kontaks.id')
              ->leftJoin('products','hargajual.produk_id','products.id')
              ->select('hargajual.id','nama_kontak','hargajual.uom_id','nama_produk', 'harga_jual_standar', 'harga_jual_pelanggan')
              ->find($id);

        return response()->json([
            'status' => 'success',
            'id' => $list->id,
            'kontak_id' => $list->nama_kontak,
            'produk_id' => $list->nama_produk,
            'uom_id' => $list->uom_id,
            'harga_jual_standar' => $list->harga_jual_standar,
            'harga_jual_pelanggan' => $list->harga_jual_pelanggan,
        ]);
        */

        $hargajual = Harga::findOrFail($id);
        return view('kontak.harga.edit', compact('hargajual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*
        $list = Harga::find($id);

        Validator::make($request->all(), [
            'id' => 'required',
            'harga_jual_pelanggan' => 'required'
        ])->validate();

        $list->uom_id = $request->uom_id;
        $list->harga_jual_pelanggan = $request->harga_jual_pelanggan;
        //$list->item = Purifier::clean($request->item);

        $list->save();

        
        return response()->json([
            'status' => 'success',
            'msg' => 'item has been updated'
        ]);
        */

        $rules = array(
            'uom_id' => 'max:255',
            'harga_jual_pelanggan' => 'max:255',
          );

          $validator = Validator::make(Input::all(), $rules);

          if ($validator->fails()) {
                echo "string";
                return Redirect::to('hargajuals/edit/'.$id)->withErrors($validator)->withInput();
          } else {
          DB::table('hargajual')
            ->where('id', $id)
            ->update(array(
                      'uom_id' => Input::get('uom_id'),
                      'harga_jual_pelanggan' => Input::get('harga_jual_pelanggan'),
                      'updated_at' => date('y-m-d h:m:s')
                ));

          Session::flash('message', 'Data Berhasil Diubah');
          return Redirect::to('hargajuals')->with('warning','Data Berhasil Diubah');
      
      }

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
        */        

        $idx   = DB::table('hargajual')->select('harga_id')->where('id', '=', $id)->first();
        $ids   = DB::table('hargajual_hdr')->select('id')->where('id', '=', $idx->harga_id)->first();
        $count = DB::table('hargajual')->where('harga_id',$ids->id)->count();

        if ($count == 1) {
           DB::table('hargajual')->where('id', '=', $id)->delete();
           DB::table('hargajual_hdr')->where('id', '=', $idx->harga_id)->delete();
        }else{
           DB::table('hargajual')->where('id', '=', $id)->delete();
        }
        
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return redirect()->route('hargajuals.index');
    }

    /**
     * Delete all selected Product at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('products_view')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Product::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function excel() {

    // Execute the query used to retrieve the data. In this example
    // we're joining hypothetical users and payments tables, retrieving
    // the payments table's primary key, the user's first and last name, 
    // the user's e-mail address, the amount paid, and the payment
    // timestamp.
   
    $payments = Harga::leftJoin('hargajual_hdr','hargajual.harga_id','hargajual_hdr.id')
                 ->leftJoin('kontaks','hargajual.kontak_id','kontaks.id')
                 ->leftJoin('products','hargajual.kode_produk','products.kode_produk')
                 ->select('hargajual.id','kontaks.nama_kontak','products.nama_produk','hargajual.uom_id','products.harga_jual_satuan','hargajual.harga_jual_pelanggan')
                 ->orderBy('hargajual.id')
                 ->get();    
   
    // Initialize the array which will be passed into the Excel
    // generator.
    $paymentsArray = []; 

    // Define the Excel spreadsheet headers
    $paymentsArray[] = ['id','nama_kontak','nama_produk','uom_id','harga_jual_standar','harga_jual_pelanggan'];

    // Convert each member of the returned collection into an array,
    // and append it to the payments array.
    foreach ($payments as $payment) {
             $paymentsArray[] = $payment->toArray();
    }

    // Generate and return the spreadsheet
    Excel::create('daftar_harga_jual', function($excel) use ($paymentsArray) {

        // Set the spreadsheet title, creator, and description
        $excel->setTitle('Harga Jual Pelanggan');
        $excel->setCreator('AlFaris')->setCompany('Aplikasi POS');
        $excel->setDescription('harga pelanggan file');

        // Build the spreadsheet, passing in the payments array
        $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
            $sheet->fromArray($paymentsArray, null, 'A1', false, false);
        });

    })->download('xlsx')->with('success','Data sudah diexport');
  }

}
