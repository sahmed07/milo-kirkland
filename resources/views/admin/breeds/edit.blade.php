@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.breed.title')</h3>
    
    {!! Form::model($breed, ['method' => 'PUT', 'route' => ['admin.breeds.update', $breed->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('breed_title', trans('global.breed.fields.breed-title').'', ['class' => 'control-label']) !!}
                    {!! Form::text('breed_title', old('breed_title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('breed_title'))
                        <p class="help-block">
                            {{ $errors->first('breed_title') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

