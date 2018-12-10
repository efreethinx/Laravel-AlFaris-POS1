@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
<!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('uploads/avatar')}}/{{Auth::user()->photo}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>
            
            @can('masters_manage')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span class="title">@lang('global.master-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    @can('uoms_view')
                    <li class="{{ $request->segment(2) == 'uoms' ? 'active active-sub' : '' }}">
                        <a href="{{ route('uoms.index') }}">
                            <i class="fa fa-briefcases"></i>
                            <span class="title">
                                Data Satuan
                            </span>
                        </a>
                    </li>
                    @endcan

                    @can('categorys_view')
                    <li class="{{ $request->segment(2) == 'categorys' ? 'active active-sub' : '' }}">
                        <a href="{{ route('categorys.index') }}">
                            <i class="fa fa-briefcases"></i>
                            <span class="title">
                                Data Kategori
                            </span>
                        </a>
                    </li>
                    @endcan

                    @can('products_view')
                    <li class="{{ $request->segment(2) == 'products' ? 'active active-sub' : '' }}">
                        <a href="{{ route('products.index') }}">
                            <i class="fa fa-userx"></i>
                            <span class="title">
                                @lang('global.products.title')
                            </span>
                        </a>
                    </li>
                    @endcan
                    
                     @can('kontak_view')
                    <li class="{{ $request->segment(2) == 'kontak' ? 'active active-sub' : '' }}">
                        <a href="{{ route('kontak.index') }}">
                            <i class="fa fa-userx"></i>
                            <span class="title">
                                @lang('global.kontak.title')
                            </span>
                        </a>
                    </li>
                    @endcan
                    
                    @can('akun_view')
                    <li class="{{ $request->segment(2) == 'akun' ? 'active active-sub' : '' }}">
                        <a href="{{ route('akun.index') }}">
                            <i class="fa fa-userx"></i>
                            <span class="title">
                                @lang('global.akun.title')
                            </span>
                        </a>
                    </li>
                    @endcan
                    
                    @can('departements_view')
                    <li class="{{ $request->segment(2) == 'departements' ? 'active active-sub' : '' }}">
                        <a href="{{ route('departements.index') }}">
                            <i class="fa fa-userx"></i>
                            <span class="title">
                                @lang('global.departements.title')
                            </span>
                        </a>
                    </li>
                    @endcan
                    
                    @can('gudang_view')
                    <li class="{{ $request->segment(2) == 'gudang' ? 'active active-sub' : '' }}">
                        <a href="{{ route('gudang.index') }}">
                            <i class="fa fa-userx"></i>
                            <span class="title">
                                @lang('global.gudang.title')
                            </span>
                        </a>
                    </li>
                    @endcan
                    
                </ul>
            </li>
            @endcan

            @can('users_manage')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.permissions.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.roles.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.users.title')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Change password</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}
