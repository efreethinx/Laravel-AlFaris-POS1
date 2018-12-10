<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Category;
use App\Uom;
use App\ProductUom;
use App\Kontak;

use DB;
use DataTables;
use Session;
use Redirect;
use Input;
use Validator;
use Excel;
use Response;

class ProductController extends Controller
{
    public $uoms = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('products_view')) {
            return abort(401);
        }
        $products = Product::all();
        $kategori = Category::all();
        $kategori_list = Category::pluck('nama_kategori','nama_kategori');
        $uoms = Uom::all();
        return view('products.index', compact('products','uoms','kategori','kategori_list'));        //return view('products.index');
    }

    public function modal(){
        return view('products._modal');
    }

    public function data(Request $request)
    {
        //$roles = Product::select(['id', 'kode_produk', 'nama_produk',  'stok', 'uom_id', 'harga_jual_satuan', DB::raw('(0 * harga_jual_satuan) as nilai_total')]);
        $uom = DB::table('product_uoms')->pluck('uom_id')->implode(' ');
        $uoms = DB::table('products')->join('product_uoms','products.id','product_uoms.produk_id')->pluck('product_uoms.uom_id')->implode(' ');
        //$uoms = DB::table('product_uoms')->where('produk_id',)

        $roles = DB::table('products')
             ->select(['id', 'name', 'kode_produk', 'nama_produk', 'kategori_id', 'is_active', 'stok', 'uom_id','harga_jual_satuan', DB::raw('(stok * harga_jual_satuan) as nilai_total')]);
        /*$roles = DB::table('products')
                 //->join('product_uoms','products.id','product_uoms.produk_id')
                 //->join('uoms','product_uoms.uom_id','uoms.id')
                 ->select(['products.id', 'products.kode_produk', 'products.nama_produk',  'products.stok', DB::raw(DB::table('product_uoms')->join('uoms','product_uoms.uom_id','uoms.id')->join('products','product_uoms.produk_id','products.id')->pluck('nama_uom')->implode(' ').' AS uom_id'), 'products.harga_jual_satuan', DB::raw('(products.stok * products.harga_jual_satuan) as nilai_total')]);  */
        return DataTables::of($roles)
               ->filter(function ($query) use ($request) {
                if ($request->has('nama_produk')) {
                    $query->where('nama_produk', 'like', "%{$request->get('nama_produk')}%");
                }

                if ($request->has('kode_produk')) {
                    $query->where('kode_produk', 'like', "%{$request->get('kode_produk')}%");
                }

                if ($request->has('kategori_id')) {
                    $query->where('kategori_id', 'like', "%{$request->get('kategori_id')}%");
                }

                if ($request->has('is_active')) {
                    $query->where('is_active', 'like', "%{$request->get('is_active')}%");
                }
                })
               ->addColumn('action', function ($role) {
                $aa = $role->id;
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="products/produkuoms/'.$aa.'" title="Input Konversi Satuan"><button type="button" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button></a> <a href="'.route('products.edit',[$role->id]).'" title="Edit" Onclick="return ConfirmEdit();"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>  <a href="products/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
              json_encode($aa);
              JavaScript::put([
                  'aa' => $role->id
              ]);
            },compact('aa'))
            //->editColumn('id', 'ID: {{$id}}')
            //->removeColumn('password')
            //->removeColumn('remember_token')
            ->make(true);
    }

    public function dataLov()
    {
        $roles = DB::table('products');

            return DataTables::of($roles)

               ->addColumn('action', function ($role) {
            /*      return
                  '<div class="text-center btn-group btn-group-justified"><a href="'.route('products.edit',[$role->id]).'" title="Edit" Onclick="return ConfirmEdit();"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>  <a href="products/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';

            })
            ->addColumn(['action', 'checkbox'], function ($role) { */
                return '<input type="checkbox" id="'.$role->id.'">';
            })
            ->removeColumn('created_at','updated_at')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('products_view')) {
            return abort(401);
        }

        $kategori = Category::pluck('nama_kategori', 'nama_kategori');
        $supplier = Kontak::where('tipe','Supplier')->pluck('nama_kontak', 'id');
        $uoms = Uom::pluck('nama_uom', 'nama_uom');
        return view('products.create', compact('uoms','kategori','supplier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('products_view')) {
            return abort(401);
        }

        //$user = User::create($request->only('username' ,'email', 'name', 'password'));

        //Product::create($request->all())->except('uom_id');

        //Product::create($request->only('id','name', 'nama_produk','kode_produk','kategori_id','kode_alias','nama_alias','harga_jual_satuan','supplier_id','pajak_masuk','pajak_keluar','is_active','is_jasa'));


      $rules = array(
      'nama_produk' => 'required|max:255|unique:products',
      'kode_produk' => 'required|max:255|unique:products',
      'harga_jual_satuan' => 'required',
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
            return redirect()->route('products.create')->withErrors($validator)->withInput();
      } else {
        $transaction = new Product;
        $transaction->name = $request->nama_produk;
        $transaction->nama_produk = $request->nama_produk;
        $transaction->kode_produk = $request->kode_produk;

        //$uoms = DB::table('uoms')->select('nama_uom')->where('id',$request->uom_id)->implode(' ');
        $transaction->uom_id = implode(', ', $request->uom_id);

        $transaction->kategori_id = $request->kategori_id;
        $transaction->kode_alias = $request->kode_alias;
        $transaction->nama_alias = $request->nama_alias;
        $transaction->stok_min = $request->stok_min;
        $transaction->harga_beli_satuan = $request->harga_beli_satuan;
        $transaction->pct_harga = $request->pct_harga;
        $transaction->harga_jual_satuan = $request->harga_jual_satuan;
        $transaction->supplier_id = $request->supplier_id;
        $transaction->pajak_masuk = $request->pajak_masuk;
        $transaction->pajak_keluar = $request->pajak_keluar;
        $transaction->is_active = $request->is_active;
        $transaction->is_jasa = $request->is_jasa;
        $transaction->save();

        }

        return redirect()->route('products.index');
        //return view('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $Product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('products_view')) {
            return abort(401);
        }
        $products = Product::findOrFail($id);
        $kategori = Category::pluck('nama_kategori', 'nama_kategori');
        $uoms = Uom::pluck('nama_uom', 'nama_uom');

        $uom_id = Product::where('id',$id)->first();
        $uoms_id = explode(', ', $uom_id->uom_id);

        // prepare
        $artist = Product::findOrFail($id);
        $tags = Uom::pluck('nama_uom', 'nama_uom');
        $selected = explode(', ', $artist->uom_id);

        $supplier = Kontak::pluck('nama_kontak', 'id');
        //return view('products.create', compact('uoms','kategori'));
        return view('products.edit', compact('selected','tags','products','uoms','kategori','supplier','uoms_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('products_view')) {
            return abort(401);
        }
        /*
        $products = Product::findOrFail($id);
        $products->update($request->all());
        */

      $rules = array(

      'nama_produk' => 'required|max:255',
      'kode_produk' => 'required|max:255',
      'harga_jual_satuan' => 'required',
      'uom_id' => 'required',
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
            return redirect()->route('products.edit',[$id])->withErrors($validator)->withInput();
      } else {
        DB::table('products')
            ->where('id', $id)
            ->update(array(
                      'name' => Input::get('nama_produk'),
                      'nama_produk' => Input::get('nama_produk'),
                      'kode_produk' => Input::get('kode_produk'),
                      'uom_id' => implode(', ', $request->uom_id),
                      'kategori_id' => Input::get('kategori_id'),
                      'kode_alias' => Input::get('kode_alias'),
                      'nama_alias' => Input::get('nama_alias'),
                      'stok_min' => Input::get('stok_min'),
                      'harga_beli_satuan' => Input::get('harga_beli_satuan'),
                      'pct_harga' => Input::get('pct_harga'),
                      'harga_jual_satuan' => Input::get('harga_jual_satuan'),
                      'supplier_id' => Input::get('supplier_id'),
                      'pajak_masuk' => Input::get('pajak_masuk'),
                      'pajak_keluar' => Input::get('pajak_keluar'),
                      'is_active' => Input::get('is_active'),
                      'is_jasa' => Input::get('is_jasa'),
                      //'created_at' => date('y-m-d h:m:s'),
                      'updated_at' => date('y-m-d h:m:s')
                ));



          Session::flash('message', 'Data Berhasil Diubah');
          //return Redirect::to('gudang');
          return redirect()->route('products.index');
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
        if (! Gate::allows('products_view')) {
            return abort(401);
        }
        */
        /*
        $permission = Uom::findOrFail($id);
        $permission->delete();
        return redirect()->route('uoms.index');
        */

        DB::table('products')->where('id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return Redirect::to('products');
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

    protected function getUomsArray()
    {
        $uoms = [];
        foreach ($this->uoms as $uom) {
            $uoms[] = [
                'uom_id'                 => Input::get('uom_id'),
                /*
                'name'                   => $uom->name,
                'unit'                   => $uom->unit,
                'price'                  => $uom->price,
                'qty'                    => $uom->qty,
                'item_discount'          => $uom->item_discount,
                'item_discount_subtotal' => $uom->item_discount_subtotal,
                'subtotal'               => $uom->subtotal,
                */
            ];
        }
        return $uoms;
    }

    public function excel() {

    // Execute the query used to retrieve the data. In this example
    // we're joining hypothetical users and payments tables, retrieving
    // the payments table's primary key, the user's first and last name,
    // the user's e-mail address, the amount paid, and the payment
    // timestamp.
    /*
    $payments = Payment::join('users', 'users.id', '=', 'payments.id')
              ->select(
                'payments.id',
                \DB::raw("concat(users.first_name, ' ', users.last_name) as `name`"),
                'users.email',
                'payments.total',
                'payments.created_at')
              ->get();
    */

    $payments = Product::select('id', 'kode_produk', 'nama_produk', 'kategori_id', 'kode_alias', 'nama_alias', 'stok', 'harga_jual_satuan', 'supplier_id', 'uom_id', 'pajak_masuk', 'pajak_keluar')
                ->get();


    // Initialize the array which will be passed into the Excel
    // generator.
    $paymentsArray = [];

    // Define the Excel spreadsheet headers
    $paymentsArray[] = ['id', 'kode_produk', 'nama_produk', 'kategori_id', 'kode_alias', 'nama_alias', 'stok', 'harga_jual_satuan', 'supplier_id', 'uom_id', 'pajak_masuk', 'pajak_keluar'];

    // Convert each member of the returned collection into an array,
    // and append it to the payments array.
    foreach ($payments as $payment) {
             $paymentsArray[] = $payment->toArray();
    }

    // Generate and return the spreadsheet
    Excel::create('produk', function($excel) use ($paymentsArray) {

        // Set the spreadsheet title, creator, and description
        $excel->setTitle('Produk');
        $excel->setCreator('AlFaris')->setCompany('Aplikasi POS');
        $excel->setDescription('produk file');

        // Build the spreadsheet, passing in the payments array
        $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
            $sheet->fromArray($paymentsArray, null, 'A1', false, false);
        });

    })->download('xlsx')->with('success','Data sudah diexport');

  }


  public function testajax() {

    //$test = Product::findorfail($id)->toarray();
    $test4 = Product::all();
    //$test = DB::table('products')->select('id','nama_produk','kode_produk','harga_jual_satuan','stok','kategori_id')
           // ->first();
            //->get();
    //return response()->json($test);
    $test3 = Product::select('id', 'kode_produk', 'nama_produk', 'kategori_id', 'kode_alias', 'nama_alias', 'stok', 'harga_jual_satuan', 'stok_min', 'supplier_id', 'uom_id', 'pajak_masuk', 'pajak_keluar')
                ->first();
    $test2 = DB::table('products')->select('id', 'kode_produk', 'name','nama_produk', 'kategori_id', 'kode_alias', 'nama_alias', 'stok', 'harga_jual_satuan', 'stok_min', 'supplier_id', 'uom_id', 'pajak_masuk', 'pajak_keluar')
                ->where('is_active','0')
                ->orderBy('nama_produk')
                ->get();

    foreach ($test2 as $key => $test) {
       # code...
       $data[] = array(

                  '0' => $test->id,
                  '1' => $test->kode_produk,
                  '2' => $test->nama_produk,
                  '3' => $test->harga_jual_satuan,
                  '4' => $test->stok,
                  '5' => $test->stok_min,
                  '6' => $test->kategori_id

                   /*   'id' => $test->id,
                      'kode_produk' => $test->kode_produk,
                      'nama_produk' => $test->nama_produk,
                      'harga_jual_satuan' => $test->harga_jual_satuan,
                      'stok' => $test->stok,
                      'stok_min' => $test->stok_min,
                      'kategori_id' => $test->kategori_id
                       */
        );
     }


     return response()->json([
               'data' =>
                    ($data)
               ]);
     /*
     return Response::json(array('success' => true, 'products' => //[
                             // [
                              $data
                            //  ]
                        //]
                        ), 200);
                        */
  }

  public function process_products_selections(Request $request)
  {
        //if ($request->input('id')) {
        //$id = $request->input('id');
        $ids = $request->id;

            $entries = Product::where('id', $ids)->get();

            foreach ($entries as $key => $test) {
              $data[] = array(
                      'id' => $test->id,
                      'kode_produk' => $test->kode_produk,
                      'nama_produk' => $test->nama_produk,
                      'harga_jual_satuan' => $test->harga_jual_satuan,
                      'stok' => $test->stok,
                      'stok_min' => $test->stok_min,
                      'kategori_id' => $test->kategori_id
                );
            //}
            return Response::json(array('success' => true, 'products' => [
                              [
                              'id' => $data->id,
                              'kode_produk' => $data->kode_produk,
                              'nama_produk' => $data->nama_produk,
                              'harga_jual_satuan' => $data->harga_jual_satuan,
                              'stok' => $data->stok,
                              'stok_min' => $test->stok_min,
                              'kategori_id' => $test->kategori_id
                              ]
                        ]), 200);
        }

  }

  public function tampil(){
    return view('products.tampil');
  }

  public function products_modal(){
    $products = Product::All()->where('is_active','0');

    return view('products.products_modal',compact('products'));

  }


  public function findProduk(Request $request)
    {
        $ids = array($request->id);
        //$ids = $request->input('products_lookup_ids');
        //$ids = '25,6';

        //$ids = explode(',', $id_list);


        //$idx = array($id_list);

        //$test = Product::whereIn('id', $ids)->where('is_active',0)->first();
        //$entries = Product::whereIn('id', explode(',',$ids))->get();
        $entries = Product::whereIn('id', $ids)->get();

        /*
        return Response::json(array('success' => true, 'products' => [
                              [
                              'id' => $test->id,
                              'kode_produk' => $test->kode_produk,
                              'nama_produk' => $test->nama_produk,
                              'harga_jual_satuan' => $test->harga_jual_satuan,
                              'stok' => $test->stok
                              ]
                        ]), 200);


        if ($request->input('products_lookup_ids')) {
            $entries = Product::whereIn('id', $request->input('products_lookup_ids'))->get();
         */
        foreach ($entries as $key => $test) {
                  $data[] = array(
                      'id' => $test->id,
                      'kode_produk' => $test->kode_produk,
                      'nama_produk' => $test->nama_produk,
                      'harga_jual_satuan' => $test->harga_jual_satuan,
                      'stok' => $test->stok,
                      'stok_min' => $test->stok_min,
                      'kategori_id' => $test->kategori_id
                    );

        }
        //}

        return Response::json(array('success' => true, 'products' => //[
                             // [
                              $data
                            //  ]
                        //]
                        ), 200);


    }



}
