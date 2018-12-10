<?php

namespace App\Http\Controllers;

use App\Kontak;
use App\KontakDetail;
use App\Akun;
use App\Product;
use App\Category;
use App\Uom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use DB;
use DataTables;
use Validator;
use Redirect;
use Input;
use Session;
use Excel;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$id = 1;
        if (! Gate::allows('kontak_view')) {
            return abort(401);
        }
        
        $kontak = Kontak::All();
        $products = Product::all();
        $kategori = Category::all();
        $kategori_list = Category::pluck('nama_kategori','nama_kategori');
        $uoms = Uom::all();
        return view('kontak.index', compact('kontak','products','uoms','kategori','kategori_list'));
        //return view('kontak.index', compact('kontak'));
        //return view('kontak.index');
    }

    public function tampil(){
      return view('kontak.tampil');
    }

    public function data(Request $request)
    {
        
        $roles = Kontak::select(['id', 'kode_kontak', 'nama_kontak', 'kontak', 'tipe','phone1','kurs']);
            return Datatables::of($roles) 
            ->filter(function ($query) use ($request) {
                if ($request->has('nama_kontak')) {
                    $query->where('nama_kontak', 'like', "%{$request->get('nama_kontak')}%");
                }

                if ($request->has('tipe')) {
                    $query->where('tipe', 'like', "%{$request->get('tipe')}%");
                }
                
                })                                   
            ->addColumn('action', function ($role) {
              $aa = $role->id;
            return            
            '<div class="text-center btn-group btn-group-justified"><a href="'.route('kontakdetail.edit',[$role->id]).'" title="Alamat"><button type="button" class="btn btn-sm btn-success"><i class="fa fa-home"></i></button></a> <a href="'.route('kontak.edit',[$role->id]).'" title="Edit" Onclick="return ConfirmEdit();"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a> <a href="kontak/delete/'.$role->id.'" title="Delete" Onclick="return ConfirmDelete();"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></div>';
              json_encode($aa); 
              JavaScript::put([
                  'aa' => $role->id                 
              ]);
            },compact('aa'))              
            //->editColumn('id', '{{$articleId}}')
            //->removeColumn('password')
            ->make(true);
            View::composer('kontak.tampil', function($view) {
              $ajaxUrl = json_encode(array('aa' => $role->id));
              $view->with('aa', $ajaxUrl);
            });
                      
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
        'kode_kontak' => 'required|string|max:255|unique:kontaks',
        'nama_kontak' => 'required|string|max:255',
        'kurs' => 'required|string|max:255',
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

         $kontak = new Kontak;
         $kontak->kode_kontak = $request->kode_kontak;
         $kontak->nama_kontak = $request->nama_kontak;
         $kontak->kurs = $request->kurs;
         $kontak->tipe = $request->tipe;
         $kontak->jenis = $request->jenis;
         $kontak->klasifikasi = $request->klasifikasi;
         $kontak->kontak = $request->kontak;
         $kontak->jabatan = $request->jabatan;
         $kontak->phone1 = $request->phone1;
         $kontak->phone2 = $request->phone2;
         $kontak->fax = $request->fax;
         $kontak->handphone = $request->handphone;
         $kontak->email = $request->email;
         $kontak->situs_web = $request->situs_web;
         $kontak->npwp = $request->npwp;
         $kontak->batas_kredit = $request->batas_kredit;
         $kontak->hari_diskon = $request->hari_diskon;
         $kontak->hari_jatuh_tempo = $request->hari_jatuh_tempo;
         $kontak->diskon_awal = $request->diskon_awal;
         $kontak->denda_terlambat = $request->denda_terlambat;
         $kontak->created_at = date('Y-m-d h:m:s');
         $kontak->updated_at = date('Y-m-d h:m:s');
         if ($kontak->save()){
            $id = $kontak->id;
            DB::table('kontak_details')->insert(            
            array( 
                    'kontak_id' => $id,
                    'kode_kontak' => Input::get('kode_kontak')
                ));
        }

      /*  
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
            DB::table('kontak_details')->insert(            
            array( 
                    'kode_kontak' => Input::get('kode_kontak')
                ));
        */
      Session::flash('message', 'Data Berhasil Ditambahkan');
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
        if (! Gate::allows('kontak_view')) {
            return abort(401);
        }
        
        //$kontak = Kontak::FindOrFail($id);
        //return view('kontak.edit', compact('kontak'));


        $kontak = DB::table('kontaks')->where('id',$id)->first();
        $kontak =
          [
            'kontak' => $kontak
          ];
        return view('kontak.edit',$kontak);
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
        if (! Gate::allows('kontak_view')) {
            return abort(401);
        }
        
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
                return Redirect::to('kontak/edit/'.$id)->withErrors($validator)->withInput();
          } else {
          DB::table('kontaks')
            ->where('id', $id)
            ->update(array(
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
                      'updated_at' => date('y-m-d h:m:s')
                    ));

          Session::flash('message', 'Data Berhasil Diubah');
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
        /*
        $permission = Uom::findOrFail($id);
        $permission->delete();
        return redirect()->route('uoms.index');
        */

        DB::table('kontaks')->where('id', '=', $id)->delete();
        DB::table('kontak_details')->where('kontak_id', '=', $id)->delete();
        DB::table('harga_juals')->where('kontak_id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus !!!');
        return Redirect::to('kontak');
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
    $payments = Kontak::select(['id', 'kode_kontak', 'nama_kontak', 'kontak', 'tipe','phone1','kurs'])
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
    $paymentsArray[] = ['id', 'kode_kontak','nama_kontak','kontak','tipe','phone','kurs'];

    // Convert each member of the returned collection into an array,
    // and append it to the payments array.
    foreach ($payments as $payment) {
             $paymentsArray[] = $payment->toArray();
    }

    // Generate and return the spreadsheet
    Excel::create('data_kontak', function($excel) use ($paymentsArray) {

        // Set the spreadsheet title, creator, and description
        $excel->setTitle('Kontak');
        $excel->setCreator('ALFaris')->setCompany('Aplikasi POS');
        $excel->setDescription('payments file');

        // Build the spreadsheet, passing in the payments array
        $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
            $sheet->fromArray($paymentsArray, null, 'A1', false, false);
        });

    })->download('xlsx');
    }

}
