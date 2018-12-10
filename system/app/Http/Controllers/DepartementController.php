<?php

namespace App\Http\Controllers;

use App\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Category;
use App\Uom;

use DB;
use DataTables;
use Session;
use Redirect;
use Validator;
use Input;
use Excel;

class DepartementController extends Controller
{
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
        if (! Gate::allows('departements_view')) {
            return abort(401);
        }
        $departements = Departement::all();
        return view('departements.index', compact('departements'));
        //return view('departements.index');
    }

    public function data()
    {
        //$roles = User::select(['username', 'name', 'email', 'role', 'active', 'photo', 'password']);
        $roles = DB::table('departements');
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="text-center btn-group btn-group-justified"><a href="'.route('departements.edit',[$role->id]).'" title="Edit" Onclick="return ConfirmEdit();"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a> <a href="departements/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
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
        if (! Gate::allows('departements_view')) {
            return abort(401);
        }
        return view('departements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('departements_view')) {
            return abort(401);
        }
        

        $rules = array(
        //'tahunajaran' => 'required|string|max:255',
        'kode_departement' => 'required|string|max:255|unique:departements',
        'nama_departement' => 'required|string|max:255',
        //'email' => 'required|string|email|max:255|unique:gudangs',
        //'password' => 'required|string|min:6|confirmed',
        );

      $messages = [
            'required' => 'The :attribute field is required.',
            'unique'   => 'data :attribute sudah ada !, silahkan ganti.',
            'same'     => 'The :attribute and :other must match.',
            'size'     => 'The :attribute must be exactly :size.',
            'between'  => 'The :attribute must be between :min - :max.',
            'in'       => 'The :attribute must be one of the following types: :values',
      ];

      $validator = Validator::make(Input::all(), $rules, $messages);

      if ($validator->fails()) {
            return Redirect::to('departements/create')->withErrors($validator)->withInput();
      } else {

        Departement::create($request->all());

        return redirect()->route('departements.index');

    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Departement  $Departement
     * @return \Illuminate\Http\Response
     */
    public function show(Departement $Departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Departement  $Departement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('departements_view')) {
            return abort(401);
        }
        $departements = Departement::findOrFail($id);

        return view('departements.edit', compact('departements'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Departement  $Departement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('departements_view')) {
            return abort(401);
        }
        
        $rules = array(
        //'tahunajaran' => 'required|string|max:255',
        'kode_departement' => 'required|string|max:255',
        'nama_departement' => 'required|string|max:255',
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
            return Redirect::to('departements/edit')->withErrors($validator)->withInput();
      } else {

        $departements = Departement::findOrFail($id);
        $departements->update($request->all());

        return redirect()->route('departements.index');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departement  $Departement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('departements_view')) {
            return abort(401);
        }
        /*
        $permission = Uom::findOrFail($id);
        $permission->delete();
        return redirect()->route('uoms.index');
        */

        DB::table('departements')->where('id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return Redirect::to('departements');
    }

        /**
     * Delete all selected Departement at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('departements_view')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Departement::whereIn('id', $request->input('ids'))->get();

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
    $payments = Departement::select(['id', 'kode_departement', 'nama_departement', 'sub_departement', 'manager','bidang','catatan'])
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
    $paymentsArray[] = ['id', 'kode_departement', 'nama_departement', 'sub_departement', 'manager','bidang','catatan'];

    // Convert each member of the returned collection into an array,
    // and append it to the payments array.
    foreach ($payments as $payment) {
             $paymentsArray[] = $payment->toArray();
    }

    // Generate and return the spreadsheet
    Excel::create('data_departemene', function($excel) use ($paymentsArray) {

        // Set the spreadsheet title, creator, and description
        $excel->setTitle('Departement');
        $excel->setCreator('ALFaris')->setCompany('Aplikasi POS');
        $excel->setDescription('departements file');

        // Build the spreadsheet, passing in the payments array
        $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
            $sheet->fromArray($paymentsArray, null, 'A1', false, false);
        });

    })->download('xlsx');
    }
    
}
