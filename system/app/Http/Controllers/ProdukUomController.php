<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\HargaJual;
use App\Kontak;
use App\Product;
use App\ProdukUom;

use DB;
use DataTables;
use Validator;
use Redirect;
use Input;
use Session;
use JavaScript;

class ProdukUomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        /*
        if (! Gate::allows('hargajual_view')) {
            return abort(401);
        }
        */

        JavaScript::put([
             'id' => $id
          ]);

        $kontak = HargaJual::All()->where('kontak_id','=',$id);
        $products = ProdukUom::where('produk_id','=',$id)->first();
        return view('products.produkuom.index', compact('kontak','products'));
        //return view('hargajual.index');
    }

    public function data($id)
    {
        //$roles = User::select(['username', 'name', 'email', 'role', 'active', 'photo', 'password']);
        $roles = DB::table('produk_uoms')
                 ->join('products','produk_uoms.produk_id', '=', 'products.id')
                 ->select('produk_uoms.id', 'produk_uoms.produk_id', 'products.nama_produk', 'produk_uoms.uom_id','produk_uoms.isi_pcs',DB::raw('"pcs" as pcs'))
                 ->where([
                    ['produk_id', '=', $id]
                  ]);
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="edit/'.$role->id.'" title="Edit" Onclick="return ConfirmEdit();"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a> <a href="delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
            })
            ->make(true);
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        /*
        if (! Gate::allows('hargajual_view')) {
            return abort(401);
        }
        */
        
        JavaScript::put([
           'id' => $id
        ]);
        
        //$hargajual = HargaJual::findOrFail($id);
        $produkuom = ProdukUom::where('produk_id','=',$id)->first();
        $kontak    = Product::findOrFail($id);
        $produk = Product::where('id','=',$id)
                ->first();
        //$produk = Product::pluck('nama_produk', 'id');
        return view('products.produkuom.create', compact('produk','kontak','produkuom'));
        
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        /*
        if (! Gate::allows('hargajual_view')) {
            return abort(401);
        }
        */

        JavaScript::put([
            'id' => $id
          ]);
        
        /*
        hargajual::create($request->all());

        return redirect()->route('hargajual.index');
        */

        $rules = array(
        'kontak_id' => 'required|string|max:255',
        'nama_produk' => 'required|string|max:255',
        'isi_pcs' => 'required',
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
            $idxx = $id ;
            return Redirect::to('products/produkuoms/create/'.$idxx)->withErrors($validator)->withInput();
      } else {
      DB::table('produk_uoms')->insert(
       array(
              'produk_id' => Input::get('kontak_id'),
              'uom_id' => Input::get('uom_id'),
              'isi_pcs' => Input::get('isi_pcs'),
              'created_at' => date('y-m-d h:m:s'),
              'updated_at' => date('y-m-d h:m:s')

            )

      );

      /*
      DB::table('hargajual_details')->insert(
            array(
                    'kode_hargajual' => Input::get('kode_hargajual')
                ));
      */
      Session::flash('message', 'Data Berhasil Ditambahkan');

      $idx = $id ;
      return Redirect::to('products/produkuoms/'.$idx);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\hargajual  $hargajual
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*
        if (! Gate::allows('hargajual_view')) {
            return abort(401);
        }
        */
        
        //$hargajual = HargaJual::findOrFail($id);
        //return view('hargajual.edit', compact('hargajual'));

        //$kontak = Kontak::findOrFail($id);
        //$produk = Product::pluck('nama_produk', 'id');
        //$hargajual = HargaJual::findOrFail($id);
        //return view('hargajual.edit', compact('hargajual','kontak','produk'));
        
        //$kontak = Kontak::findOrFail($id);
        JavaScript::put([
           'id' => $id
        ]);
        
        //$hargajual = HargaJual::findOrFail($id);
        $produkuom = ProdukUom::where('id','=',$id)->first();
        //$kontak    = Product::findOrFail($id);
        $produk = DB::table('produk_uoms')->select('uom_id')->where('id',$id)->first();
        
        $produks = Product::where('id',$produkuom->produk_id)->first();

        //$kontak = Kontak::all();
        //$produk = Product::pluck('nama_produk', 'id');
        
        $hargajual = DB::table('produk_uoms')->where('id',$id)->first();
        $hargajual =
          [
            'hargajual' => $hargajual
          ];        
        return view('products.produkuom.edit', $hargajual, compact('produk','produks','kontak','produkuom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\hargajual  $hargajual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        /*
        if (! Gate::allows('hargajual_view')) {
            return abort(401);
        }
        */

        JavaScript::put([
            'id' => $id
          ]);
        
        /*
        $hargajual = hargajual::findOrFail($id);
        $hargajual->update($request->all());
        return redirect()->route('hargajual.index');
        */

        $rules = array(
            'produk_id' => 'max:255',
            //'nama_hargajual' => 'max:255',
          );

          $validator = Validator::make(Input::all(), $rules);

          if ($validator->fails()) {
                echo "string";
                return Redirect::to('products/produkuoms/'.$idx)->withErrors($validator)->withInput();
          } else {
          DB::table('produk_uoms')
            ->where('id', $id)
            ->update(array(
                      'produk_id' => Input::get('produk_id'),
                      'uom_id' => Input::get('uom_id'),
                      'isi_pcs' => Input::get('isi_pcs'),
                      //'created_at' => date('y-m-d h:m:s'),
                      'updated_at' => date('y-m-d h:m:s')
                    )
            );

          Session::flash('message', 'Data Berhasil Diubah'); 

          $idx = Input::get('produk_id') ;
          return Redirect::to('products/produkuoms/'.$idx);      
      }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hargajual  $hargajual
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {/*
        if (! Gate::allows('hargajual_view')) {
            return abort(401);
        }
        
        $permission = Uom::findOrFail($id);
        $permission->delete();
        return redirect()->route('uoms.index');
        */
        JavaScript::put([
            'id' => $id
          ]);

        //$idx =  DB::table('produk_uoms')->select('produk_id')->where('id', '=', $id)->first() ;
        
        DB::table('produk_uoms')->where('id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return Redirect::back();
        //return Redirect::to('products/produkuoms/'.$idx);  
    }

}
