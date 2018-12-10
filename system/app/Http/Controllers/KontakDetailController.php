<?php

namespace App\Http\Controllers;

use App\KontakDetail;
use App\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use DB;
use Datatables;
use Validator;
use Redirect;
use Input;
use Session;

class KontakDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('kontak_view')) {
            return abort(401);
        }
        $kontak = Kontak::all();
        return view('kontak.index', compact('kontak'));
        //return view('kontak.index');
    }

    public function data()
    {
        //$roles = User::select(['username', 'name', 'email', 'role', 'active', 'photo', 'password']);
        $roles = DB::table('kontak');
        return Datatables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="kontak/edit/'.$role->id.'" title="Edit"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a> <a href="kontak/delete/'.$role->id.'" title="Delete" onclick="confirmDeleteRole(event, '.$role->id.', '.$role->nama_kontak.');"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
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
        if (! Gate::allows('kontak_view')) {
            return abort(401);
        }
        return view('kontak.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('kontak_view')) {
            return abort(401);
        }
        
        /*
        kontak::create($request->all());

        return redirect()->route('kontak.index');
        */

        $rules = array(
        //'tahunajaran' => 'required|string|max:255',
        'kode_kontak' => 'required|string|max:255',
        'nama_kontak' => 'required|string|max:255',
        //'email' => 'required|string|email|max:255|unique:kontaks',
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
            return Redirect::to('kontak/create')->withErrors($validator)->withInput();
      } else {
      DB::table('kontaks')->insert(
       array(
              'kode_kontak' => Input::get('kode_kontak'),
              'nama_kontak' => Input::get('nama_kontak'),
              'kurs' => Input::get('kurs'),
              'tipe' => Input::get('tipe'),
              'jenis' => Input::get('jenis'),
              'klasifikasi' => Input::get('klasifikasi'),
              'kontak' => Input::get('kontak'),
              'jabatan' => Input::get('jabatan'),
              'phone1' => Input::get('phone1'),
              'phone2' => Input::get('phone2'),
              'fax' => Input::get('fax'),
              'handphone' => Input::get('handphone'),
              'email' => Input::get('email'),
              'situs_web' => Input::get('situs_web'),
              'npwp' => Input::get('npwp'),
              'batas_kredit' => Input::get('batas_kredit'),
              'hari_diskon' => Input::get('hari_diskon'),
              'hari_jatuh_tempo' => Input::get('hari_jatuh_tempo'),
              'diskon_awal' => Input::get('diskon_awal'),
              'denda_terlambat' => Input::get('denda_terlambat'),
              'created_at' => date('y-m-d h:m:s'),
              'updated_at' => date('y-m-d h:m:s')

            )
      );

      //Session::flash('message', 'Data Berhasil Ditambahkan');
      return Redirect::to('kontak');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function show(kontak $kontak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*
        if (! Gate::allows('kontak_view')) {
            return abort(401);
        }
        */

        $kontak = Kontak::findOrFail($id);
        //$kontak = Kontak::all();
        $kontakdetail = KontakDetail::All()->where('kontak_id',$id)->first();
        $alamat = KontakDetail::pluck('alamat1', 'alamat1');
        return view('kontakdetail.edit', compact('kontak','kontakdetail','alamat'));



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*
        if (! Gate::allows('kontak_view')) {
            return abort(401);
        }
        */

        /*
        $kontak = kontak::findOrFail($id);
        $kontak->update($request->all());
        return redirect()->route('kontak.index');
        */

        $rules = array(
            'kode_kontak' => 'max:255',
            'nama_kontak' => 'max:255',
          );

          $validator = Validator::make(Input::all(), $rules);

          if ($validator->fails()) {
                echo "string";
                return Redirect::to('kontakdetail/edit/'.$id)->withErrors($validator)->withInput();
          } else {
          DB::table('kontak_details')
            ->where('id', $id)
            ->update(array(
                      'kontak_id' => Input::get('kontak_id'),
                      'kode_kontak' => Input::get('kode_kontak'),
                      'alamat1' => Input::get('alamat1'),
                      'alamat2' => Input::get('alamat2'),
                      'kota1' => Input::get('kota1'),
                      'kode_pos1' => Input::get('kode_pos1'),
                      'negara1' => Input::get('negara1'),
                      'alamat_pengiraman1' => Input::get('alamat_pengiraman1'),
                      'alamat_pengiraman2' => Input::get('alamat_pengiraman2'),
                      'kota2' => Input::get('kota2'),
                      'kode_pos2' => Input::get('kode_pos2'),
                      'negara2' => Input::get('negara2'),
                      'kontak2' => Input::get('kontak2'),
                      'catatan' => Input::get('catatan'),
                      'photo' => Input::get('photo'),
                      'updated_at' => date('y-m-d h:m:s')
                    ));

          Session::flash('message', 'Data Berhasil Disimpan');
          return Redirect::to('kontak');
      
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('kontak_view')) {
            return abort(401);
        }
        $permission = KontakDetail::findOrFail($id);
        $permission->delete();

        return redirect()->route('kontak.index');
    }

        /**
     * Delete all selected kontak at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('kontak_view')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = kontak::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
