<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <style type="text/css">
        .spinner {
          width: 100px;
        }
        .spinner input {
          text-align: right;
        }

        .input-group-btn-vertical {
          position: relative;
          white-space: nowrap;
          width: 1%;
          vertical-align: middle;
          display: table-cell;
        }
        .input-group-btn-vertical > .btn {
          display: block;
          float: none;
          width: 100%;
          max-width: 100%;
          padding: 8px;
          margin-left: -1px;
          position: relative;
          border-radius: 0;
        }
        .input-group-btn-vertical > .btn:first-child {
          border-top-right-radius: 4px;
        }
        .input-group-btn-vertical > .btn:last-child {
          margin-top: -2px;
          border-bottom-right-radius: 4px;
        }
        .input-group-btn-vertical i{
          position: absolute;
          top: 0;
          left: 4px;
        }
    </style>
</head>


<body class="hold-transition skin-blue sidebar-mini">

<div id="wrapper">

@include('partials.topbar')
@include('partials.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      @yield('content-header')

    </section>  

        <!-- Main content -->
        <section class="content">
            @if(isset($siteTitle))
                <h3 class="page-title">
                    {{ $siteTitle }}
                </h3>
            @endif

            <div class="row">
                <div class="col-md-12">

                    @if (Session::has('message'))
                        <div class="note note-info">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif
                    @if ($errors->count() > 0)
                        <div class="note note-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')

                </div>
            </div>
        </section>
    </div>
</div>

{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}

@include('partials.javascripts')
</body>
</html>