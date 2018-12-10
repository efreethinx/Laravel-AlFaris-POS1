@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.kontak.title')
        <small>List</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">@lang('global.kontak.title')</li>
      </ol>    
@stop

@section('content')   
    <p>
        <a href="{{ route('kontak.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($kontak) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th width="10%">@lang('global.kontak.fields.kode_kontak')</th>
                        <th width="35%">@lang('global.kontak.fields.nama_kontak')</th>
                        <th width="10%">@lang('global.kontak.fields.kontak')</th>
                        <th width="10%">@lang('global.kontak.fields.kelompok')</th>
                        <th width="10%">@lang('global.kontak.fields.phone1')</th>
                        <th width="10%">@lang('global.kontak.fields.kurs')</th>
                        <th  width="25%">&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($kontak) > 0)
                        @foreach ($kontak as $permission)
                            <tr data-entry-id="{{ $permission->id }}">
                                <td></td>
                                <td>{{ $permission->kode_kontak }}</td>
                                <td>{{ $permission->nama_kontak }}</td>
                                <td>{{ $permission->kontak }}</td>
                                <td>{{ $permission->tipe }}</td>
                                <td>{{ $permission->phone1 }}</td>
                                <td align="center">{{ $permission->kurs }}</td>
                                <td>
                                    <a href="{{ route('kontakdetail.edit',[$permission->id]) }}" class="btn btn-xs btn-warning">Alamat</a>
                                    <a href="{{ route('kontak.edit',[$permission->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['kontak.destroy', $permission->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('kontak.mass_destroy') }}';
    </script>
@endsection