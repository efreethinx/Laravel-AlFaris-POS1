<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use Input;
use App\User;
use App\Pembelian;
use remember;
use DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

      public function getIndex()
      {
        return View::make('charts');
      }

      public function getApi()
      {
        $days = Input::get('days', 30);
        $range = \Carbon\Carbon::now()->subDays($days);
        
        $stats = Pembelian::where('tanggal', '>=', $range)
          ->groupBy('date')
          ->orderBy('date', 'DESC')
          //->remember(60)
          ->get([
            DB::raw('Date(tanggal) as date'),
            //DB::raw('COUNT(*) as value')
            DB::raw('SUM(total_setelah_pajak) as value')
          ])
          ->toJSON();
        
        return $stats;
      }

      public function getApis()
      {
        $days = Input::get('days', 7);
        $range = \Carbon\Carbon::now()->subDays($days);
        
        $stats = Pembelian::where('created_at', '>=', $range)
          ->groupBy('date')
          ->orderBy('date', 'DESC')
          //->remember(60)
          ->get([
            DB::raw('Date(created_at) as date'),
            //DB::raw('COUNT(*) as value')
            DB::raw('SUM(saldo_setelah_pajak) as value')
          ])
          ->toJSON();
        
        return $stats;
      }

}
