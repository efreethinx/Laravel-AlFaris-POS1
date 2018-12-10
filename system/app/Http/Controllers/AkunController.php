<?php

namespace App\Http\Controllers;

use App\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use DB;
use DataTables;
use Validator;
use Redirect;
use Input;
use Session;
use App\SubKlasifikasi;
use App\Departement;
use Excel;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('akun_view')) {
            return abort(401);
        }
        $akun = akun::all();
        $subklasifikasi = SubKlasifikasi::get()->pluck('id', 'subklasifikasi');
        return view('akun.index', compact('akun','subklasifikasi'));
        //return view('akun.index');
    }

    public function data()
    {
        //$roles = User::select(['username', 'name', 'email', 'role', 'active', 'photo', 'password']);
        $roles = DB::table('akuns')
                 ->leftJoin('sub_klasifikasis','akuns.subklasifikasi_id', '=', 'sub_klasifikasis.id')
                 ->select('akuns.id','akuns.kode_akun','akuns.nama_akun', 'akuns.kas_bank', 'sub_klasifikasis.klasifikasi', 'sub_klasifikasis.subklasifikasi');
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="'.route('akun.edit',[$role->id]).'" title="Edit" Onclick="return ConfirmEdit();"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a> <a href="akun/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
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
        if (! Gate::allows('akun_view')) {
            return abort(401);
        }

        $subklasifikasi = Subklasifikasi::get()->pluck('subklasifikasi', 'id');
        $departement = Departement::get()->pluck('nama_departement', 'id');
        return view('akun.create',compact('subklasifikasi','departement'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('akun_view')) {
            return abort(401);
        }
        
        /*
        akun::create($request->all());

        return redirect()->route('akun.index');
        */

        $rules = array(
        //'tahunajaran' => 'required|string|max:255',
        'kode_akun' => 'required|string|max:255|unique:akuns',
        'nama_akun' => 'required|string|max:255',
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
            return Redirect::to('akun/create')->withErrors($validator)->withInput();
      } else {
      DB::table('akuns')->insert(
       array(
              'kode_akun' => Input::get('kode_akun'),
              'nama_akun' => Input::get('nama_akun'),
              'nama_alias' => Input::get('nama_alias'),
              'subklasifikasi_id' => Input::get('subklasifikasi'),
              'is_active' => Input::get('is_active'),
              'kas_bank' => Input::get('kas_bank'),
              'kurs' => Input::get('kurs'),
              'departement_id' => Input::get('departement_id'),
              'created_at' => date('y-m-d h:m:s'),
              'updated_at' => date('y-m-d h:m:s')
            )
      );

      //Session::flash('message', 'Data Berhasil Ditambahkan');
      return Redirect::to('akun')->with('success','Data Berhasil Disimpan');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function show(akun $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('akun_view')) {
            return abort(401);
        }
        $akun = akun::findOrFail($id);
        $subklasifikasi = Subklasifikasi::get()->pluck('subklasifikasi', 'id');
        $departement = Departement::get()->pluck('nama_departement', 'id');
        return view('akun.edit', compact('akun','subklasifikasi','departement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('akun_view')) {
            return abort(401);
        }
        
        /*
        $akun = akun::findOrFail($id);
        $akun->update($request->all());
        return redirect()->route('akun.index');
        */

        $rules = array(
            'kode_akun' => 'max:255',
            'nama_akun' => 'max:255',
          );

          $validator = Validator::make(Input::all(), $rules);

          if ($validator->fails()) {
                echo "string";
                return Redirect::to('akun/edit/'.$id)->withErrors($validator)->withInput();
          } else {
          DB::table('akuns')
            ->where('id', $id)
            ->update(array(
                      'kode_akun' => Input::get('kode_akun'),
                      'nama_akun' => Input::get('nama_akun'),
                      'nama_alias' => Input::get('nama_alias'),
                      'subklasifikasi_id' => Input::get('subklasifikasi_id'),
                      'is_active' => Input::get('is_active'),
                      'kas_bank' => Input::get('kas_bank'),
                      'kurs' => Input::get('kurs'),
                      'departement_id' => Input::get('departement_id'),
                      'updated_at' => date('y-m-d h:m:s')
                ));

          Session::flash('message', 'Data Berhasil Diubah');
          return Redirect::to('akun')->with('warning','Data Berhasil Diubah');
      
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('akun_view')) {
            return abort(401);
        }
        $permission = akun::findOrFail($id);
        $permission->delete();

        return redirect()->route('akun.index')->with('danger','Data Berhasil Dihapus');
    }

        /**
     * Delete all selected akun at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('akun_view')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = akun::whereIn('id', $request->input('ids'))->get();

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
    
    $payments = Akun::select('id', 'kode_akun','nama_akun','nama_alias','created_at')
                ->get();
    */
    $payments = Akun::leftJoin('sub_klasifikasis','akuns.subklasifikasi_id','sub_klasifikasis.id')
              ->leftJoin('departements','akuns.departement_id','departements.id')
              ->select(
                  'akuns.id', 'kode_akun', 'nama_akun', 'sub_klasifikasis.subklasifikasi', 'sub_klasifikasis.klasifikasi', 'nama_alias', 'kurs', 'kas_bank', 'departements.nama_departement'
                )
              ->get();

    // Initialize the array which will be passed into the Excel
    // generator.
    $paymentsArray = []; 

    // Define the Excel spreadsheet headers
    $paymentsArray[] = ['id', 'kode_akun','nama_akun','subklasifikasi','klasifikasi','nama_alias','kurs','kas_bank','nama_departement'];

    // Convert each member of the returned collection into an array,
    // and append it to the payments array.
    foreach ($payments as $payment) {
             $paymentsArray[] = $payment->toArray();
    }

    // Generate and return the spreadsheet
    Excel::create('akuns', function($excel) use ($paymentsArray) {

        // Set the spreadsheet title, creator, and description
        $excel->setTitle('Payments');
        $excel->setCreator('Laravel')->setCompany('WJ Gilmore, LLC');
        $excel->setDescription('payments file');

        // Build the spreadsheet, passing in the payments array
        $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
            $sheet->fromArray($paymentsArray, null, 'A1', false, false);
        });

    })->download('xlsx')->with('success','Data sudah diexport');
}
}
