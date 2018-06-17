@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.pet.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.pet.fields.tag-id')</th>
                            <td field-key='tag_id'>{{ $pet->tag_id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.pet-photo')</th>
                            <td field-key='pet_photo'>@if($pet->pet_photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $pet->pet_photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $pet->pet_photo) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.pet-name')</th>
                            <td field-key='pet_name'>{{ $pet->pet_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.pet-type')</th>
                            <td field-key='pet_type'>{{ $pet->pet_type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.pet-breed')</th>
                            <td field-key='pet_breed'>{{ $pet->pet_breed }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.pet-color')</th>
                            <td field-key='pet_color'>{{ $pet->pet_color }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.pet-age')</th>
                            <td field-key='pet_age'>{{ $pet->pet_age }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.pet-sex')</th>
                            <td field-key='pet_sex'>{{ $pet->pet_sex }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.behaviour')</th>
                            <td field-key='behaviour'>{{ $pet->behaviour }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.pet-size')</th>
                            <td field-key='pet_size'>{{ $pet->pet_size }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.distinctive-sign')</th>
                            <td field-key='distinctive_sign'>{{ $pet->distinctive_sign }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.microchip')</th>
                            <td field-key='microchip'>{{ $pet->microchip }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.microchip-file')</th>
                            <td field-key='microchip_file's> @foreach($pet->getMedia('microchip_file') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.sprayed-neutered')</th>
                            <td field-key='sprayed_neutered'>{{ $pet->sprayed_neutered }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.rabies-vacc')</th>
                            <td field-key='rabies_vacc'>{{ $pet->rabies_vacc }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.rabies-vacc-file')</th>
                            <td field-key='rabies_vacc_file's> @foreach($pet->getMedia('rabies_vacc_file') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.pet-status')</th>
                            <td field-key='pet_status'>{{ $pet->pet_status }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.pay-status')</th>
                            <td field-key='pay_status'>{{ $pet->pay_status }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.pet.fields.created-by')</th>
                            <td field-key='created_by'>{{ $pet->created_by->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.pets.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
