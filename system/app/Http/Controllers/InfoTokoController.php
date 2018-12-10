<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Gudang;
use App\InfoToko;
use DB;
use DataTables;
use Validator;
use Redirect;
use Input;
use Session;
use Excel;

class InfoTokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        /*
        if (! Gate::allows('gudang_view')) {
            return abort(401);
        }
        */
        $gudang = InfoToko::all();
        return view('info.toko.index', compact('gudang'));
        //return view('gudang.index');
    }

    public function data()
    {
        //$roles = User::select(['username', 'name', 'email', 'role', 'active', 'photo', 'password']);
        $roles = DB::table('info_toko');
        return DataTables::of($roles)
               ->addColumn('action', function ($role) {
                return
                  '<div class="btn-group">
                  <div class="text-center btn-group btn-group-justified"><a href="'.route('toko.edit',[$role->id]).'" title="Edit" Onclick="return ConfirmEdit();"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a> 
                       
                      
                   
                    
                  </div></div>';
            })
            //->editColumn('id', 'ID: {{$id}}') <a href="toko/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>
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
    {   /*
        if (! Gate::allows('gudang_view')) {
            return abort(401);
        }*/
        return view('info.toko.create');
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
        if (! Gate::allows('gudang_view')) {
            return abort(401);
        }*/
        
        /*
        Gudang::create($request->all());

        return redirect()->route('gudang.index');
        */

        $rules = array(
        //'tahunajaran' => 'required|string|max:255',
        //'kode_gudang' => 'required|string|max:255|unique:gudangs',
        'nama_toko' => 'required|string|max:255',
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
            return Redirect::to('info/toko/create')->withErrors($validator)->withInput();
      } else {
      DB::table('info_toko')->insert(
       array(
              'nama_toko' => Input::get('nama_toko'),
              'alamat_toko' => Input::get('alamat_toko'),
              'desa_toko' => Input::get('desa_toko'),
              'kecamatan_toko' => Input::get('kecamatan_toko'),
              'kota_toko' => Input::get('kota_toko'),
              'provinsi_toko' => Input::get('provinsi_toko'),
              'kode_pos_toko' => Input::get('kode_pos_toko'),
              'hp_toko' => Input::get('hp_toko'),
              //'kode_pos' => Input::get('kode_pos'),
              //'negara' => Input::get('negara'),
              //'keterangan' => Input::get('keterangan'),
              'created_at' => date('y-m-d h:m:s'),
              'updated_at' => date('y-m-d h:m:s')
            )
      );

      //Session::flash('message', 'Data Berhasil Ditambahkan');
      return Redirect::to('info/toko');
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
        /*
        if (! Gate::allows('gudang_view')) {
            return abort(401);
        }*/
        $gudang = InfoToko::findOrFail($id);
        return view('info.toko.edit', compact('gudang'));
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
        /*
        if (! Gate::allows('gudang_view')) {
            return abort(401);
        }*/
        
        /*
        $gudang = Gudang::findOrFail($id);
        $gudang->update($request->all());
        return redirect()->route('gudang.index');
        */

        $rules = array(
            //'kode_gudang' => 'max:255',
            'nama_toko' => 'max:255',
          );

          $validator = Validator::make(Input::all(), $rules);

          if ($validator->fails()) {
                echo "string";
                return Redirect::to('info/toko/edit/'.$id)->withErrors($validator)->withInput();
          } else {
          DB::table('info_toko')
            ->where('id', $id)
            ->update(array(
                      'nama_toko' => Input::get('nama_toko'),
                      'alamat_toko' => Input::get('alamat_toko'),
                      'desa_toko' => Input::get('desa_toko'),
                      'kecamatan_toko' => Input::get('kecamatan_toko'),
                      'kota_toko' => Input::get('kota_toko'),
                      'provinsi_toko' => Input::get('provinsi_toko'),
                      'kode_pos_toko' => Input::get('kode_pos_toko'),
                      'hp_toko' => Input::get('hp_toko'),
                      //'kode_pos' => Input::get('kode_pos'),
                      //'negara' => Input::get('negara'),
                      //'keterangan' => Input::get('keterangan'),
                      //'created_at' => date('y-m-d h:m:s'),
                      'updated_at' => date('y-m-d h:m:s')
                ));

          Session::flash('message', 'Data Berhasil Diubah');
          return Redirect::to('info/toko');
      
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
        /*
        if (! Gate::allows('gudang_view')) {
            return abort(401);
        }*/
        /*
        $permission = Uom::findOrFail($id);
        $permission->delete();
        return redirect()->route('uoms.index');
        */

        DB::table('info_toko')->where('id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return Redirect::to('info/toko');
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
            $entries = InfoToko::whereIn('id', $request->input('ids'))->get();

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
