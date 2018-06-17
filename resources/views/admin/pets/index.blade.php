@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.pet.title')</h3>
    @can('pet_create')
    <p>
        <a href="{{ route('admin.pets.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
        @if(!is_null(Auth::getUser()->role_id) && config('global.can_see_all_records_role_id') == Auth::getUser()->role_id)
            @if(Session::get('Pet.filter', 'all') == 'my')
                <a href="?filter=all" class="btn btn-default">Show all records</a>
            @else
                <a href="?filter=my" class="btn btn-default">Filter my records</a>
            @endif
        @endif
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.pets.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.pets.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($pets) > 0 ? 'datatable' : '' }} @can('pet_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('pet_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.pet.fields.tag-id')</th>
                        <th>@lang('global.pet.fields.pet-photo')</th>
                        <th>@lang('global.pet.fields.pet-name')</th>
                        <th>@lang('global.pet.fields.pet-type')</th>
                        <th>@lang('global.pet.fields.pet-breed')</th>
                        <th>@lang('global.pet.fields.pet-color')</th>
                        <th>@lang('global.pet.fields.pet-age')</th>
                        <th>@lang('global.pet.fields.pet-sex')</th>
                        <th>@lang('global.pet.fields.behaviour')</th>
                        <th>@lang('global.pet.fields.pet-size')</th>
                        <th>@lang('global.pet.fields.distinctive-sign')</th>
                        <th>@lang('global.pet.fields.microchip')</th>
                        <th>@lang('global.pet.fields.microchip-file')</th>
                        <th>@lang('global.pet.fields.sprayed-neutered')</th>
                        <th>@lang('global.pet.fields.rabies-vacc')</th>
                        <th>@lang('global.pet.fields.rabies-vacc-file')</th>
                        <th>@lang('global.pet.fields.pet-status')</th>
                        <th>@lang('global.pet.fields.pay-status')</th>
                        <th>@lang('global.pet.fields.created-by')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($pets) > 0)
                        @foreach ($pets as $pet)
                            <tr data-entry-id="{{ $pet->id }}">
                                @can('pet_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='tag_id'>{{ $pet->tag_id }}</td>
                                <td field-key='pet_photo'>@if($pet->pet_photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $pet->pet_photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $pet->pet_photo) }}"/></a>@endif</td>
                                <td field-key='pet_name'>{{ $pet->pet_name }}</td>
                                <td field-key='pet_type'>{{ $pet->pet_type }}</td>
                                <td field-key='pet_breed'>{{ $pet->pet_breed }}</td>
                                <td field-key='pet_color'>{{ $pet->pet_color }}</td>
                                <td field-key='pet_age'>{{ $pet->pet_age }}</td>
                                <td field-key='pet_sex'>{{ $pet->pet_sex }}</td>
                                <td field-key='behaviour'>{{ $pet->behaviour }}</td>
                                <td field-key='pet_size'>{{ $pet->pet_size }}</td>
                                <td field-key='distinctive_sign'>{{ $pet->distinctive_sign }}</td>
                                <td field-key='microchip'>{{ $pet->microchip }}</td>
                                <td field-key='microchip_file'> @foreach($pet->getMedia('microchip_file') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                                <td field-key='sprayed_neutered'>{{ $pet->sprayed_neutered }}</td>
                                <td field-key='rabies_vacc'>{{ $pet->rabies_vacc }}</td>
                                <td field-key='rabies_vacc_file'> @foreach($pet->getMedia('rabies_vacc_file') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                                <td field-key='pet_status'>{{ $pet->pet_status }}</td>
                                <td field-key='pay_status'>{{ $pet->pay_status }}</td>
                                <td field-key='created_by'>{{ $pet->created_by->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.pets.restore', $pet->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.pets.perma_del', $pet->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('pet_view')
                                    <a href="{{ route('admin.pets.show',[$pet->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('pet_edit')
                                    <a href="{{ route('admin.pets.edit',[$pet->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('pet_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.pets.destroy', $pet->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="24">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('pet_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.pets.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection