@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.gudang.title')
        <small>List</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">@lang('global.gudang.title')</li>
      </ol>    
@stop

@section('content')   
    <p>
        <a href="{{ route('gudang.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($gudang) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th width="10%">@lang('global.gudang.fields.kode_gudang')</th>
                        <th width="50%">@lang('global.gudang.fields.nama_gudang')</th>
                        <th width="10%">@lang('global.gudang.fields.is_container')</th>
                        <th width="10%">@lang('global.gudang.fields.is_active')</th>
                        <th width="10%">@lang('global.gudang.fields.utama')</th>
                        <th  width="20%">&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($gudang) > 0)
                        @foreach ($gudang as $permission)
                            <tr data-entry-id="{{ $permission->id }}">
                                <td></td>
                                <td>{{ $permission->kode_gudang }}</td>
                                <td>{{ $permission->nama_gudang }}</td>
                                <td>{{ $permission->is_container }}</td>
                                <td>{{ $permission->is_active }}</td>
                                <td>{{ $permission->utama }}</td>
                                <td>
                                    <a href="{{ route('gudang.edit',[$permission->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['gudang.destroy', $permission->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('gudang.mass_destroy') }}';
    </script>
@endsection