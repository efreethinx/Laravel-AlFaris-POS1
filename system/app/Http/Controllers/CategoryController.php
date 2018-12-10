<?php

namespace App\Http\Controllers;

use App\Category;
use App\Akun;
use App\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use DB;
use DataTables;
use Session;
use Redirect;
use Input;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('categorys_view')) {
            return abort(401);
        }
        $categorys = Category::all();
        return view('categorys.index', compact('categorys'));
        //return view('categorys.index');
    }

    public function data()
    {
        //$roles = User::select(['username', 'name', 'email', 'role', 'active', 'photo', 'password']);
        $roles = DB::table('categories');
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="'.route('categorys.edit',[$role->id]).'" title="Edit" Onclick="return ConfirmEdit();"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a> <a href="categorys/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
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
    public function create()
    {
        if (! Gate::allows('categorys_view')) {
            return abort(401);
        }


        //return view('categorys.create');

        $akun = Akun::pluck('nama_akun', 'kode_akun');
        $akun_list = Akun::pluck('kode_akun','id');
        $departement = Departement::pluck('nama_departement', 'kode_departement');

        return view('categorys.create', compact('akun','departement','akun_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('categorys_view')) {
            return abort(401);
        }
        
        $rules = array(
        'kode_kategori' => 'required|string|max:255|unique:categories',
        'nama_kategori' => 'required|string|max:255|unique:categories',
        //'email' => 'required|string|email|max:255|unique:akuns',
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
            return Redirect::to('categorys/create')->withErrors($validator)->withInput();
      } else {Category::create($request->all());

        return redirect()->route('categorys.index');
     }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $Category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('categorys_view')) {
            return abort(401);
        }
        $categorys = Category::findOrFail($id);

        //return view('categorys.edit', compact('categorys'));

        $akun = Akun::pluck('nama_akun', 'kode_akun');
        $departement = Departement::pluck('nama_departement', 'kode_departement');

        return view('categorys.edit', compact('categorys','akun','departement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('categorys_view')) {
            return abort(401);
        }
        
	$rules = array(
        'kode_kategori' => 'required|string|max:255',
        'nama_kategori' => 'required|string|max:255',
        //'email' => 'required|string|email|max:255|unique:akuns',
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
            return Redirect::to('categorys/create')->withErrors($validator)->withInput();
      } else {
	$categorys = Category::findOrFail($id);
        $categorys->update($request->all());

        return redirect()->route('categorys.index');
	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('categorys_view')) {
            return abort(401);
        }
        
        /*
        $permission = Uom::findOrFail($id);
        $permission->delete();
        return redirect()->route('uoms.index');
        */

        DB::table('categories')->where('id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return Redirect::to('categorys');
    }

        /**
     * Delete all selected Category at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('categorys_view')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Category::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function findNamaAkun(Request $request)
    {
        $data = Akun::select('nama_akun')->where('id', $request->id)->first();
        return response()->json($data);
    }

}
