<?php

namespace App\Http\Controllers;

use App\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use DB;
use Datatables;

class KlasifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('klasifikasi_view')) {
            return abort(401);
        }
        $klasifikasi = Klasifikasi::all();
        return view('klasifikasi.index', compact('klasifikasi'));
        //return view('klasifikasi.index');
    }

    public function data()
    {
        //$roles = User::select(['username', 'name', 'email', 'role', 'active', 'photo', 'password']);
        $roles = DB::table('klasifikasi');
        return Datatables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="klasifikasi/edit/'.$role->id.'" title="Edit"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a> <a href="klasifikasi/delete/'.$role->id.'" title="Delete" onclick="confirmDeleteRole(event, '.$role->id.', '.$role->nama_Klasifikasi.');"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
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
        if (! Gate::allows('klasifikasi_view')) {
            return abort(401);
        }
        return view('klasifikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('klasifikasi_view')) {
            return abort(401);
        }
        Klasifikasi::create($request->all());

        return redirect()->route('klasifikasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Klasifikasi  $Klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Klasifikasi $Klasifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Klasifikasi  $Klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('klasifikasi_view')) {
            return abort(401);
        }
        $klasifikasi = Klasifikasi::findOrFail($id);

        return view('klasifikasi.edit', compact('klasifikasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Klasifikasi  $Klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('klasifikasi_view')) {
            return abort(401);
        }
        $klasifikasi = Klasifikasi::findOrFail($id);
        $klasifikasi->update($request->all());

        return redirect()->route('klasifikasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Klasifikasi  $Klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('klasifikasi_view')) {
            return abort(401);
        }
        $permission = Klasifikasi::findOrFail($id);
        $permission->delete();

        return redirect()->route('klasifikasi.index');
    }

        /**
     * Delete all selected Klasifikasi at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('klasifikasi_view')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Klasifikasi::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
