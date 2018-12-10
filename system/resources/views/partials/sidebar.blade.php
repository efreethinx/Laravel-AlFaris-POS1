        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ url('/') }}" class="site_title"><i class="fa fa-home"></i> <span>ALFARIS POS</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('images/avatar') }}/{{ Auth::user()->photo }}" alt="{{ Auth::user()->name }}" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3><i class="fa fa-dashboard"></i>Menu Utama</h3>
                <ul class="nav side-menu">

                  @can('homes_menu')
                  <li><a><i class="fa fa-th"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Dashboard</a></li>
                      <li><a href="index2.html">Dashboard2</a></li>
                      <li><a href="index3.html">Dashboard3</a></li>
                    </ul>
                  </li>
                  @endcan

                  @can('masters_manage')
                  <li><a><i class="fa fa-th"></i> Master <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      @can('uoms_view')
                      <li><a href="{{ url('uoms') }}"> Data Satuan</a></li>
                      @endcan                      
                      <li><a href="{{ url('categorys') }}"> Data Kategori</a></li>                      
                      <li><a href="{{ url('products') }}"> Data Produk</a></li>                      
                      <li><a href="{{ url('kontak') }}"> Data Kontak</a></li>                      
                      <li><a href="{{ url('akun') }}"> Data Akun</a></li>                      
                      <li><a href="{{ url('departements') }}"> Data Departemen</a></li>                      
                      <li><a href="{{ url('gudang') }}"> Data Gudang</a></li>
                      <li><a href="{{ url('hargajuals') }}"> Setup Harga Jual Pelanggan</a></li>                      
                      <li><a href="{{ url('hargabeli') }}"> Harga Beli / HNA</a></li>
                    </ul>
                  </li>
                  @endcan

                  @can('transactions_menu')
                  <li><a><i class="fa fa-desktop"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <!--
                      <li><a href="{{ route('pembelian.index') }}"> Pembelian</a></li>
                      -->
                      <li><a>Manajemen Pembelian<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="{{ route('pembelian.index') }}">Faktur Pembelian / Penerimaan</a>
                            </li>
                            <li><a href="{{ route('pembelian.hutang') }}">Daftar Hutang</a>
                            </li>
                            <li><a href="{{ route('pembayaran.index') }}">Pembayaran Hutang</a>
                            </li>
                          </ul>
                      </li>
                      <li><a>Manajemen Penjualan<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="{{ route('penjualan.index') }}"> Faktur / Transaksi Penjualan</a>
                            </li>
                            <li class="sub_menu"><a href="{{ route('penjualan.piutang') }}"> Daftar Piutang</a>
                            </li>
                            <li class="sub_menu"><a href="{{ route('piutang.index') }}"> Pembayaran Piutang</a>
                            </li>
                            </li>
                            @can('stockopname')
                            <li class="sub_menu"><a href="{{ route('#') }}"> Stock Opname</a>
                            @endcan
                            </li>
                            </li>
                          </ul>
                      </li>
                      <li><a>Manajemen Inventori<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="{{ route('transfer.index') }}"> Transfer Gudang</a>
                            </li>
                            <li class="sub_menu"><a href="{{ route('penyesuaian.index') }}"> Penyesuaian Stok</a>
                            </li>
                            </li>
                            @can('stockopname')
                            <li class="sub_menu"><a href="{{ route('#') }}"> Stock Opname</a>
                            @endcan
                            </li>
                            </li>
                          </ul>
                      </li>               
                      <li><a>Manajemen Kas - Bank<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <li class="sub_menu"><a href="{{ route('kas.pengeluaran.index') }}"> Pengeluaran Kas</a>
                              </li>
                              <li class="sub_menu"><a href="{{ route('kas.penerimaan.index') }}"> Penerimaan Kas</a>
                              </li>
                              </li>
                              <li class="sub_menu"><a href="{{ route('kas.transfer.index') }}"> Transfer Kas</a>
                              </li>
                              </li>
                            </ul>
                        </li>               
                    </ul>
                  </li>
                  @endcan

                  @can('reports_menu')
                  <li><a><i class="fa fa-bar-chart-o"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Tables</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                  </li>
                  @endcan

                  @can('users_manage')
                  <li><a><i class="fa fa-gear"></i> Sistem Konfigurasi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    @can('manage_permission')
                      <li><a href="{{ url('admin/permissions') }}"> Permission</a></li>
                    @endcan
                      <li><a href="{{ url('admin/roles') }}"> Roles</a></li>
                      <li><a href="{{ url('admin/users') }}"> Data Pengguna - Users</a></li>
                      <li><a href="{{ url('info/toko') }}"> Setting Toko</a></li>
                    </ul>
                  </li>
                  @endcan



                  @can('layouts_menu')
                  <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li>
                  @endcan
                </ul>
              </div>

              @can('main_manage')
              <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div>
              @endcan

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>