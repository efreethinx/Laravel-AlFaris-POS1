@extends('layouts.app')

@section('content')
 <div class="row">      

          <!-- top tiles -->

          <div class="row tile_count">
            <!--
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Jumlah Pengguna</span>
              <div class="count">{{ Auth::user()->count() }}</div>
              <span class="count_bottom"><i class="green">4% </i> From last Week</span>
            </div>
            -->
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-box-o"></i> Total Nilai Hutang</span>
              <?php
              $pembelian = App\Pembelian::count('id');
              $pembayaran = App\Pembayaran::count('id');

		if ($pembelian >= 1 and $pembayaran >= 1) {
                $roles = DB::table('pembelians')
                     ->leftJoin('pembayaran_details', 'pembelians.id', '=', 'pembayaran_details.pembelian_id')
                     ->leftJoin('pembayarans', 'pembayarans.id', '=', 'pembayaran_details.pembayaran_id')
                     //->leftJoin('kontaks','pembelians.kontak_id','=','kontaks.id')
                     ->select(DB::raw('(IFNULL(pembelians.saldo_terutang,0)) - (SUM(IFNULL(pembayarans.nilai,0))) AS saldohutang')
                       )
                     ->where('pembelians.saldo_terutang','!=',0)
                     ->groupBy('pembelians.saldo_terutang')
                     ->first(); 
                $produk = $roles->saldohutang;
                }else{
                  $produk = 0;
                }              
              ?>
              <div class="count red">{{ number_format($produk) }}</div>
              <!--
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
              -->
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-userx"></i> Total Nilai Piutang</span>
              <?php
              $penjualan = App\Penjualan::count('id');
	      $piutang = App\Piutang::count('id');
              
              if ($penjualan >= 1 and $piutang >= 1) {
                  $roles = DB::table('penjualans')
                   ->leftJoin('piutang_details', 'penjualans.id', '=', 'piutang_details.penjualan_id')
                   ->leftJoin('piutangs', 'piutang_details.piutang_id', '=', 'piutangs.id')
                   //->leftJoin('kontaks','penjualans.kontak_id','=','kontaks.id')
                   ->select(DB::raw('(IFNULL(penjualans.saldo_terutang,0)) - (SUM(IFNULL(piutangs.nilai,0))) AS totalPiutang')
                     )
                   ->where('penjualans.saldo_terutang','!=',0)
                   ->groupBy('penjualans.saldo_terutang')
                   ->first(); 
                  $pelanggan = $roles->totalPiutang;
                }else{
                  $pelanggan = 0;
                }
                  
              ?>
              <div class="count green">{{ number_format($pelanggan) }}</div>
              <!--
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
              
              <span class="count_bottom"><i class="red">  Jumlah Faktur Pembelian :  {{ App\Pembelian::count('id') }}</i></span> -->
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
              <?php
                $faktur = DB::table('pembelians')->select(DB::raw('SUM(total_setelah_pajak) AS amount'))->first();
              ?>
              <span class="count_top"><i class="fa fa-userx"></i> Total Nilai Pembelian</span>
              <div class="count">{{ number_format($faktur->amount) }}</div><!--
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            -->
            <span class="count_bottom"><i class="red">  Jumlah Faktur Pembelian :  {{ App\Pembelian::count('id') }}</i></span>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
             <?php
              $faktur2 = DB::table('penjualans')->select(DB::raw('SUM(total_setelah_pajak) AS amount'))->first();
              ?>
              <span class="count_top"><i class="fa fa-userx"></i> Total Nilai Penjualan</span>
              <div class="count">{{ number_format($faktur2->amount) }}</div>
              <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
              --> <span class="count_bottom"><i class="blue"> Jumlah Faktur Pejualan :  {{ App\Penjualan::count('id') }}</i></span>
            </div>
            <!--
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
              <div class="count">7,325</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            -->
          </div> 
          <!-- /top tiles 

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Network Activities <small>Graph title sub-title</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="chart_plot_01" class="demo-placeholder"></div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Top Campaign Performance</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Facebook Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Twitter Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Conventional Media</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Bill boards</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>    

          --> 
          <div class="row">
                
            <div class="col-xs-12">
            
            <!--
            <p>
                <div class="btn-group">
                      <a href="{{route('pembelian.create')}}" class="btn btn-info">
                      <i class="fa fa-plus fa-fw"></i> Baru</a>
                      </div>
            </p>
            -->

            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('global.app_list') Faktur Pembelian
                </div>

                    <div class="panel-body table-responsive">             
                      
                      <div class="table-responsive">                    
                        <table id="list" class="table table-bordered table-striped table-condensed">
                          <thead>
                            <tr>
                              <th width="10%">Tanggal</th>
                              <th width="12%">No. Faktur</th>
                              <th width="12%">No. Pesanan</th>
                              <th width="30%">Nama Pemasok</th>
                              <!--
                              <th width="10%">Proyek</th> -->
                              <th class="text-right" width="13%">Nilai Pembelian</th>
                              <!--
                              <th class="text-center" width="13%">Action</th>
                              -->
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>              
                      </div>
                      <!-- end table-responsive -->
                    
                    </div>
                    <!-- /.box-body -->
                  
            </div>
            <!-- /.box -->
                
            </div>
            <!-- /.col -->
              
        </div>  

      <!-- Daftar Penjualan -->  
      <div class="row">
              
          <div class="col-xs-12">

          <div class="panel panel-default">
              <div class="panel-heading">
                  @lang('global.app_list') Penjualan Produk
              </div>

              <div class="panel-body table-responsive">             
                    
                    <div class="table-responsive">                    
                      <table id="listpenjualan" class="table table-bordered table-striped table-condensed">
                        <thead>
                          <tr>
                            <th width="10%">Tanggal</th>
                              <th width="12%">No. Faktur</th>
                              <th width="12%">No. Pesanan</th>
                              <th width="30%">Nama Konsumen</th>
                              <!--
                              <th width="10%">Proyek</th> -->
                              <th class="text-right" width="13%">Nilai Penjualan</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>              
                    </div>
                    <!-- end table-responsive -->
                  
                  </div>
                  <!-- /.box-body -->
                
                </div>
                <!-- /.box -->
              
              </div>
              <!-- /.col -->            
      </div>


<!-- bar chart
              <div class="row">
              
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Bar Charts <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="line-example" style="width:100%; height:280px;"></div>
                  </div>
                </div>
              </div>
           bar charts



              <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills ranges">
                    <li><a href="#" data-range='7'>7 Days</a></li>
                    <li><a href="#" data-range='30'>30 Days</a></li>
                    <li><a href="#" data-range='60'>60 Days</a></li>
                    <li><a href="#" data-range='90'>90 Days</a></li>
                  </ul>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12"> 
                  <div id="stats-container" style="height: 250px;"></div>
                </div>
              </div>
            </div>
 -->

                     
</div>       
@stop

@push('javascripts')
    <!-- morris.js -->
    <script src="{{asset('/bower_components/gentelella/vendors/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('/bower_components/gentelella/vendors/morris.js/morris.min.js')}}"></script>

    <!-- DataTables -->
    <script src="{{asset('/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>    
    <script src="{{asset('/bower_components/sweetalert/docs/assets/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('/js/dashboard.js')}}"></script>

    <!-- Page Scripts -->
    <script type="text/javascript">
    $(document).ready(function(){
        datatables.init();
        datatablesPenjualan.init();
    });
    </script>

    <script type="text/javascript">
      var jason_data = [{day:1,pageviews:687928},{day:2,pageviews:688331},{day:3,pageviews:603741},{day:4,pageviews:542002},{day:5,pageviews:657730},{day:6,pageviews:804183},{day:7,pageviews:776029},{day:8,pageviews:654589}];

      Morris.Line({
        element: 'line-example',
        data: jason_data,
        xkey: 'day',
        ykeys: ['pageviews'],
        labels: ['PageViews']
      });
    </script>

    <!--
    <script>
    $(function() {
      // Create a function that will handle AJAX requests
      function requestData(days, chart){
        $.ajax({
          type: "GET",
          url: "{{url('admin/home/charts/api')}}", // This is the URL to the API
          data: { days: days }
        })
        .done(function( data ) {
          // When the response to the AJAX request comes back render the chart with new data
          chart.setData(JSON.parse(data));
        })
        .fail(function() {
          // If there is no communication between the server, show an error
          alert( "error occured" );
        });
      }
      var chart = Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'stats-container',
        // Set initial data (ideally you would provide an array of default data)
        data: [0,0],
        xkey: 'date',
        ykeys: ['value'],
        labels: ['Users']
      });
      // Request initial data for the past 7 days:
      requestData(7, chart);
      $('ul.ranges a').click(function(e){
        e.preventDefault();
        // Get the number of days from the data attribute
        var el = $(this);
        days = el.attr('data-range');
        // Request the data and render the chart using our handy function
        requestData(days, chart);
        // Make things pretty to show which button/tab the user clicked
        el.parent().addClass('active');
        el.parent().siblings().removeClass('active');
      })
    });
    </script>
    -->
@endpush

