@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.roles.title')</h3>
    
    {!! Form::model($role, ['method' => 'PUT', 'route' => ['admin.roles.update', $role->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly'=>'true','style'=>'background:#eee;']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>

            <!--
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('permission', 'Permissions', ['class' => 'control-label']) !!}
                    {!! Form::select('permission[]', $permissions, old('permission'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('permission'))
                        <p class="help-block">
                            {{ $errors->first('permission') }}
                        </p>
                    @endif
                </div>
            </div>
            -->

            <!--
            <div class="form-group">
                  
                  <label class="col-sm-2 control-label">Menus </label>
                  <div class="col-sm-10">
                    <input type="checkbox" id="checkAll">
                    <label>Select all</label>
                    <div id="alertDayMessage"></div>
                  </div>                   
                  
                  
                  <label class="col-sm-2 control-label lbl-menu">&nbsp; </label>
                  
                  <div class="col-sm-5">                 
                    <table class="table table-bordered table-condensed">
                      @foreach($permissions as $value)                                              
                        <tr>
                          <td style="width: 10px">
                           
                           {!! Form::checkbox('permission[]', $permissions, old('permission'), ['class' => 'flat']) !!}
                           </td>
                           <td>{{$value}}</td>
                       </tr> 
                       @endforeach
                    </table>                    
                </div>
            </div>
            -->

                    
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('permission', 'Permissions', ['class' => 'control-label']) !!}
                      <table class="table table-bordered table-condensed">                      
                       @foreach($permissions as $permission)                       
                        <tr>
                          <td style="width: 10px">
                          <label>
                        {{Form::checkbox('permissions[]',  $permission->id, $role->permissions, ['class' => 'flat', 'readonly'=>'true','style'=>'background:#eee;',  'disabled'=>'disabled']) }}
                          </label>                            
                          </td>
                          <td>{{ Form::label($permission->name, ucfirst($permission->name)) }}</td>
                        </tr>                        
                       @endforeach                    
                      </table>                      
                  </div>
                  <!-- second block
                  <div class="col-sm-5">
                      <table class="table table-bordered table-condensed">                        
                        @foreach($permissions as $value)                      
                        <tr>
                          <td style="width: 10px">
                            <label>
                            {!! Form::checkbox('permission[]', $permissions, old('permission'), ['class' => 'flat']) !!}
                            </label>                            
                          </td>
                          <td>{{$value}}</td>
                        </tr>                          
                        @endforeach                      
                    </table>
                  </div>    -->               
            </div>
                

        </div>
    </div>

    <a href="{{route('admin.roles.index')}}" class="btn btn-primary"><i class="fa fa-chevron_back fa-fw"></i> Kembali</a>
    {!! Form::close() !!}
@stop

