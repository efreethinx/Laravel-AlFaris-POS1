<?php

namespace App\Http\Controllers;

use App\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use DB;
use DataTables;
use Validator;
use Redirect;
use Input;
use Session;
use Excel;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('gudang_view')) {
            return abort(401);
        }
        $gudang = Gudang::all();
        return view('gudang.index', compact('gudang'));
        //return view('gudang.index');
    }

    public function data()
    {
        //$roles = User::select(['username', 'name', 'email', 'role', 'active', 'photo', 'password']);
        $roles = DB::table('gudangs');
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="btn-group">
                  <div class="text-center btn-group btn-group-justified"><a href="'.route('gudang.edit',[$role->id]).'" title="Edit" Onclick="return ConfirmEdit();"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a> <a href="gudang/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>
                  </div></div>';
            })
            //->editColumn('id', 'ID: {{$id}}')
            //->removeColumn('password')
            //->removeColumn('remember_token')
            ->make(true);
            /*
            {!! Form::open(array(
                'style' => 'display: inline-block;',
                'method' => 'DELETE',
                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                'route' => ['gudang.destroy', $permission->id])) !!}
                {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
             {!! Form::close() !!}


             '{!! Form::open(array(
                                      "style" => "display: inline-block;",
                                      "method" => "DELETE",
                                      "onsubmit" => "return confirm("'.trans("global.app_are_you_sure").'");",
                                      "route" => ["gudang.destroy", $permission->id])) !!}
                                      {!! Form::submit(trans("global.app_delete"), array("class" => "btn btn-xs btn-danger")) !!}
                                      {!! Form::close() !!}'
            */
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('gudang_view')) {
            return abort(401);
        }
        return view('gudang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('gudang_view')) {
            return abort(401);
        }
        
        /*
        Gudang::create($request->all());

        return redirect()->route('gudang.index');
        */

        $rules = array(
        //'tahunajaran' => 'required|string|max:255',
        'kode_gudang' => 'required|string|max:255|unique:gudangs',
        'nama_gudang' => 'required|string|max:255',
        //'email' => 'required|string|email|max:255|unique:gudangs',
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
            return Redirect::to('gudang/create')->withErrors($validator)->withInput();
      } else {
      DB::table('gudangs')->insert(
       array(
              'kode_gudang' => Input::get('kode_gudang'),
              'nama_gudang' => Input::get('nama_gudang'),
              'is_container' => Input::get('is_container'),
              'is_active' => Input::get('is_active'),
              'kategori_gudang' => Input::get('kategori_gudang'),
              'dimensi_container' => Input::get('dimensi_container'),
              'alamat' => Input::get('alamat'),
              'kota' => Input::get('kota'),
              'kode_pos' => Input::get('kode_pos'),
              'negara' => Input::get('negara'),
              'keterangan' => Input::get('keterangan'),
              'created_at' => date('y-m-d h:m:s'),
              'updated_at' => date('y-m-d h:m:s')
            )
      );

      //Session::flash('message', 'Data Berhasil Ditambahkan');
      return Redirect::to('gudang');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gudang  $Gudang
     * @return \Illuminate\Http\Response
     */
    public function show(Gudang $Gudang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gudang  $Gudang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('gudang_view')) {
            return abort(401);
        }
        $gudang = Gudang::findOrFail($id);
        return view('gudang.edit', compact('gudang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gudang  $Gudang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('gudang_view')) {
            return abort(401);
        }
        
        /*
        $gudang = Gudang::findOrFail($id);
        $gudang->update($request->all());
        return redirect()->route('gudang.index');
        */

        $rules = array(
            'kode_gudang' => 'max:255',
            'nama_gudang' => 'max:255',
          );

          $validator = Validator::make(Input::all(), $rules);

          if ($validator->fails()) {
                echo "string";
                return Redirect::to('gudang/edit/'.$id)->withErrors($validator)->withInput();
          } else {
          DB::table('gudangs')
            ->where('id', $id)
            ->update(array(
                      'kode_gudang' => Input::get('kode_gudang'),
                      'nama_gudang' => Input::get('nama_gudang'),
                      'is_container' => Input::get('is_container'),
                      'is_active' => Input::get('is_active'),
                      'kategori_gudang' => Input::get('kategori_gudang'),
                      'dimensi_container' => Input::get('dimensi_container'),
                      'alamat' => Input::get('alamat'),
                      'kota' => Input::get('kota'),
                      'kode_pos' => Input::get('kode_pos'),
                      'negara' => Input::get('negara'),
                      'keterangan' => Input::get('keterangan'),
                      'created_at' => date('y-m-d h:m:s'),
                      'updated_at' => date('y-m-d h:m:s')
                ));

          Session::flash('message', 'Data Berhasil Diubah');
          return Redirect::to('gudang');
      
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gudang  $Gudang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('gudang_view')) {
            return abort(401);
        }
        /*
        $permission = Uom::findOrFail($id);
        $permission->delete();
        return redirect()->route('uoms.index');
        */

        DB::table('gudangs')->where('id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return Redirect::to('gudang');
    }

        /**
     * Delete all selected Gudang at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('gudang_view')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Gudang::whereIn('id', $request->input('ids'))->get();

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
    $payments = Gudang::select(['id', 'kode_gudang', 'nama_gudang', 'dimensi_container', 'alamat','kota','kode_pos','negara','keterangan','kategori_gudang','is_container'])
                ->get();
    /*
    $payments = Akun::leftJoin('sub_klasifikasis','akuns.subklasifikasi_id','sub_klasifikasis.id')
              ->leftJoin('departements','akuns.departement_id','departements.id')
              ->select(
                  'akuns.id', 'kode_akun', 'nama_akun', 'sub_klasifikasis.subklasifikasi', 'sub_klasifikasis.klasifikasi', 'nama_alias', 'kurs', 'kas_bank', 'departements.nama_departement'
                )
              ->get();
              */

    // Initialize the array which will be passed into the Excel
    // generator.
    $paymentsArray = []; 

    // Define the Excel spreadsheet headers
    $paymentsArray[] = ['id', 'kode_gudang', 'nama_gudang', 'dimensi_container', 'alamat','kota','kode_pos','negara','keterangan','kategori_gudang','container'];

    // Convert each member of the returned collection into an array,
    // and append it to the payments array.
    foreach ($payments as $payment) {
             $paymentsArray[] = $payment->toArray();
    }

    // Generate and return the spreadsheet
    Excel::create('data_gudang', function($excel) use ($paymentsArray) {

        // Set the spreadsheet title, creator, and description
        $excel->setTitle('Gudang');
        $excel->setCreator('ALFaris')->setCompany('Aplikasi POS');
        $excel->setDescription('gudang file');

        // Build the spreadsheet, passing in the payments array
        $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
            $sheet->fromArray($paymentsArray, null, 'A1', false, false);
        });

    })->download('xlsx');
    }


}
