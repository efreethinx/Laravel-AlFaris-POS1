<!DOCTYPE html>
<html lang="en">
  <head>
   @include('partials.head')
   @yield('css')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

      @include('partials.sidebar')

        <!-- top navigation -->
        @include('partials.topbar')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
         

            <!-- Breadcumb
            <section class="content-header">
               @yield('content-header')
            </section> 
             -->  

            <!-- Main content -->
            <section class="content">
              <!-- Your Page Content Here -->
              @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif
              @if ($message = Session::get('warning'))
                  <div class="alert alert-warning">
                    <p>{{ $message }}</p>
                  </div>
              @endif
              @if ($message = Session::get('danger'))
                  <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                  </div>
              @endif
              @yield('content')
            </section>
             
                     
        </div>


        <!-- /page content -->

        <!-- footer content -->
        @include('partials.footer')
        <!-- /footer content -->

      </div>
    </div>

    @stack('javascripts')

    @stack('ext_js')
    
    @include('partials.javascripts')
    
    
	
  </body>
</html>