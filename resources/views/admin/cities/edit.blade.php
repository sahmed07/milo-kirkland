@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.city.title')</h3>
    
    {!! Form::model($city, ['method' => 'PUT', 'route' => ['admin.cities.update', $city->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('city_name', trans('global.city.fields.city-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('city_name', old('city_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('city_name'))
                        <p class="help-block">
                            {{ $errors->first('city_name') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

