@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.uoms.title')
        <small>List</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">@lang('global.uoms.title')</li>
      </ol>    
@stop

@section('content')   
<div class="row">
    <p>
        <a href="{{ route('uoms.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list') Satuan
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($uoms) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('global.uoms.fields.kode')</th>
                        <th>@lang('global.uoms.fields.nama')</th>
                        <th>@lang('global.uoms.fields.deskripsi')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($uoms) > 0)
                        @foreach ($uoms as $permission)
                            <tr data-entry-id="{{ $permission->id }}">
                                <td></td>
                                <td>{{ $permission->kode_uom }}</td>
                                <td>{{ $permission->nama_uom }}</td>
                                <td>{{ $permission->deskripsi }}</td>
                                <td>
                                    <a href="{{ route('uoms.edit',[$permission->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['uoms.destroy', $permission->id])) !!}
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
</div>    
@stop

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('uoms.mass_destroy') }}';
    </script>
@endsection

@push('javascripts')
<script>
    $(".delete").on("submit", function(){
        return confirm("Do you want to delete this item?");
    });
</script>
@endpush
