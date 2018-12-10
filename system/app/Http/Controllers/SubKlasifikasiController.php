<?php

namespace App\Http\Controllers;

use App\Subklasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use DB;
use Datatables;
use Validator;
use Response;
use Input;

class SubklasifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('subklasifikasi_view')) {
            return abort(401);
        }
        $subklasifikasi = subklasifikasi::all();
        return view('subklasifikasi.index', compact('subklasifikasi'));
        //return view('subklasifikasi.index');
    }

    public function data()
    {
        //$roles = User::select(['username', 'name', 'email', 'role', 'active', 'photo', 'password']);
        $roles = DB::table('subklasifikasi');
        return Datatables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="subklasifikasi/edit/'.$role->id.'" title="Edit"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a> <a href="subklasifikasi/delete/'.$role->id.'" title="Delete" onclick="confirmDeleteRole(event, '.$role->id.', '.$role->nama_subklasifikasi.');"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
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
        /*
        if (! Gate::allows('subklasifikasi_view')) {
            return abort(401);
        }
        */

        return view('subklasifikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    
    public function store(Request $request)
    {
        /*
        if (! Gate::allows('subklasifikasi_view')) {
            return abort(401);
        }
        */
        subklasifikasi::create($request->all());

        return redirect()->route('akun.create');
    }
    
    /*
    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $post = new Post();
            $post->klasifikasi = $request->title;
            $post->subklasifikasi = $request->content;
            $post->save();
            return response()->json($post);
        }
    }
    */

    /**
     * Display the specified resource.
     *
     * @param  \App\subklasifikasi  $subklasifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(subklasifikasi $subklasifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\subklasifikasi  $subklasifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('subklasifikasi_view')) {
            return abort(401);
        }
        $subklasifikasi = subklasifikasi::findOrFail($id);

        return view('subklasifikasi.edit', compact('subklasifikasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\subklasifikasi  $subklasifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('subklasifikasi_view')) {
            return abort(401);
        }
        $subklasifikasi = subklasifikasi::findOrFail($id);
        $subklasifikasi->update($request->all());

        return redirect()->route('subklasifikasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\subklasifikasi  $subklasifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('subklasifikasi_view')) {
            return abort(401);
        }
        $permission = subklasifikasi::findOrFail($id);
        $permission->delete();

        return redirect()->route('subklasifikasi.index');
    }

        /**
     * Delete all selected subklasifikasi at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('subklasifikasi_view')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = subklasifikasi::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
