<?php

namespace App\Http\Controllers;

use App\Uom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use DB;
use DataTables;
use Session;
use Redirect;

class UomController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('uoms_view')) {
            return abort(401);
        }
        $uoms = Uom::all();
        return view('uoms.tampil', compact('uoms'));
        //return view('uoms.index');
    }

    public function data()
    {
        //$roles = User::select(['username', 'name', 'email', 'role', 'active', 'photo', 'password']);
        $roles = DB::table('uoms');
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="'.route('uoms.edit',[$role->id]).'" title="Edit" Onclick="return ConfirmEdit();"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a> <a href="uoms/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
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
        if (! Gate::allows('uoms_view')) {
            return abort(401);
        }
        return view('uoms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('uoms_view')) {
            return abort(401);
        }
        Uom::create($request->all());

        return redirect()->route('uoms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Uom  $uom
     * @return \Illuminate\Http\Response
     */
    public function show(Uom $uom)
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
        if (! Gate::allows('uoms_view')) {
            return abort(401);
        }
        $uoms = Uom::findOrFail($id);

        return view('uoms.edit', compact('uoms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Uom  $uom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('uoms_view')) {
            return abort(401);
        }
        $uoms = Uom::findOrFail($id);
        $uoms->update($request->all());

        return redirect()->route('uoms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Uom  $uom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('uoms_view')) {
            return abort(401);
        }
        
        /*
        $permission = Uom::findOrFail($id);
        $permission->delete();
        return redirect()->route('uoms.index');
        */

        DB::table('uoms')->where('id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return Redirect::to('uoms');
    }

        /**
     * Delete all selected Uom at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('uoms_view')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Uom::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
    
}
