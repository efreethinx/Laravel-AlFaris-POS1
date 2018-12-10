<?php

namespace App\Http\Controllers;

use App\HargaJual;
use App\Kontak;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use DB;
use DataTables;
use Validator;
use Redirect;
use Input;
use Session;
use JavaScript;

class HargaJualController extends Controller
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
        return view('hargajual.index', compact('kontak'));
        //return view('hargajual.index');
    }

    public function data($id)
    {
        //$roles = User::select(['username', 'name', 'email', 'role', 'active', 'photo', 'password']);
        $roles = DB::table('harga_juals')
                 ->join('products','harga_juals.produk', '=', 'products.id')
                 ->select('harga_juals.id','harga_juals.kontak_id','harga_juals.kode_kontak', 'harga_juals.date_add', 'products.nama_produk', 'harga_juals.harga_jual_satuan')
                 ->where([
                    ['kontak_id', '=', $id]
                  ]);
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="edit/'.$role->id.'" title="Edit" Onclick="return ConfirmEdit();"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a> <a href="delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
            })
            //->editColumn('id', 'ID: {{$id}}')
            //->removeColumn('password')
            //->removeColumn('remember_token')
            ->make(true);
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (! Gate::allows('hargajual_view')) {
            return abort(401);
        }
        
        JavaScript::put([
            'id' => $id
          ]);
        
        //$hargajual = HargaJual::findOrFail($id);
        $kontak = Kontak::findOrFail($id);
        $produk = Product::pluck('nama_produk', 'id');
        return view('hargajual.create', compact('produk','kontak'));
        
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
        //'tahunajaran' => 'required|string|max:255',
        'kontak_id' => 'required|string|max:255',
        'kode_kontak' => 'required|string|max:255',
        'date_add' => 'required|string|max:255',
        //'email' => 'required|string|email|max:255|unique:hargajuals',
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
            $idxx = $id ;
            return Redirect::to('kontak/hargajual/create/'.$idxx)->withErrors($validator)->withInput();
      } else {
      DB::table('harga_juals')->insert(
       array(
              'kontak_id' => Input::get('kontak_id'),
              'kode_kontak' => Input::get('kode_kontak'),
              'date_add' => Input::get('date_add'),
              'produk' => Input::get('produk'),
              'harga_jual_satuan' => Input::get('harga_jual'),
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
      return Redirect::to('kontak/hargajual/'.$idx);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\hargajual  $hargajual
     * @return \Illuminate\Http\Response
     */
    public function show(hargajual $hargajual)
    {
        //
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
        $kontak = Kontak::all();
        $produk = Product::pluck('nama_produk', 'id');
        
        $hargajual = DB::table('harga_juals')->where('id',$id)->first();
        $hargajual =
          [
            'hargajual' => $hargajual
          ];
        return view('hargajual.edit',$hargajual,compact('kontak','produk'));
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
            'kode_kontak' => 'max:255',
            //'nama_hargajual' => 'max:255',
          );

          $validator = Validator::make(Input::all(), $rules);

          if ($validator->fails()) {
                echo "string";
                return Redirect::to('hargajual/edit/'.$id)->withErrors($validator)->withInput();
          } else {
          DB::table('harga_juals')
            ->where('id', $id)
            ->update(array(
                      'kontak_id' => Input::get('kontak_id'),
                      'kode_kontak' => Input::get('kode_kontak'),
                      'date_add' => Input::get('date_add'),
                      'produk' => Input::get('produk'),
                      'harga_jual_satuan' => Input::get('harga_jual'),
                      'updated_at' => date('y-m-d h:m:s')
                    )
            );

          Session::flash('message', 'Data Berhasil Diubah'); 

          $idx = Input::get('kontak_id');
          return Redirect::to('kontak/hargajual/'.$idx);        
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hargajual  $hargajual
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('hargajual_view')) {
            return abort(401);
        }
        /*
        $permission = Uom::findOrFail($id);
        $permission->delete();
        return redirect()->route('uoms.index');
        */
        JavaScript::put([
            'id' => $id
          ]);

        DB::table('harga_juals')->where('id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');

        $idx = $id ;
        return Redirect::to('kontak/hargajual/'.$idx);  
    }

    /**
     * Delete all selected hargajual at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('hargajual_view')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = hargajual::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
