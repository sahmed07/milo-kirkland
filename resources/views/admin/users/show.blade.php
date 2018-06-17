@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.role')</th>
                            <td field-key='role'>
                                @foreach ($user->role as $singleRole)
                                    <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#user_actions" aria-controls="user_actions" role="tab" data-toggle="tab">User actions</a></li>
<li role="presentation" class=""><a href="#internal_notifications" aria-controls="internal_notifications" role="tab" data-toggle="tab">Notifications</a></li>
<li role="presentation" class=""><a href="#payments" aria-controls="payments" role="tab" data-toggle="tab">Payments</a></li>
<li role="presentation" class=""><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
<li role="presentation" class=""><a href="#pet" aria-controls="pet" role="tab" data-toggle="tab">Pet</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="user_actions">
<table class="table table-bordered table-striped {{ count($user_actions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.user-actions.created_at')</th>
                        <th>@lang('global.user-actions.fields.user')</th>
                        <th>@lang('global.user-actions.fields.action')</th>
                        <th>@lang('global.user-actions.fields.action-model')</th>
                        <th>@lang('global.user-actions.fields.action-id')</th>
                        
        </tr>
    </thead>

    <tbody>
        @if (count($user_actions) > 0)
            @foreach ($user_actions as $user_action)
                <tr data-entry-id="{{ $user_action->id }}">
                    <td>{{ $user_action->created_at or '' }}</td>
                                <td field-key='user'>{{ $user_action->user->name or '' }}</td>
                                <td field-key='action'>{{ $user_action->action }}</td>
                                <td field-key='action_model'>{{ $user_action->action_model }}</td>
                                <td field-key='action_id'>{{ $user_action->action_id }}</td>
                                
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
<div role="tabpanel" class="tab-pane " id="internal_notifications">
<table class="table table-bordered table-striped {{ count($internal_notifications) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.internal-notifications.fields.text')</th>
                        <th>@lang('global.internal-notifications.fields.link')</th>
                        <th>@lang('global.internal-notifications.fields.users')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($internal_notifications) > 0)
            @foreach ($internal_notifications as $internal_notification)
                <tr data-entry-id="{{ $internal_notification->id }}">
                    <td field-key='text'>{{ $internal_notification->text }}</td>
                                <td field-key='link'>{{ $internal_notification->link }}</td>
                                <td field-key='users'>
                                    @foreach ($internal_notification->users as $singleUsers)
                                        <span class="label label-info label-many">{{ $singleUsers->name }}</span>
                                    @endforeach
                                </td>
                                                                <td>
                                    @can('internal_notification_view')
                                    <a href="{{ route('admin.internal_notifications.show',[$internal_notification->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('internal_notification_edit')
                                    <a href="{{ route('admin.internal_notifications.edit',[$internal_notification->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('internal_notification_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.internal_notifications.destroy', $internal_notification->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="payments">
<table class="table table-bordered table-striped {{ count($payments) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.payments.fields.payment-type')</th>
                        <th>@lang('global.payments.fields.amount')</th>
                        <th>@lang('global.payments.fields.payment-date')</th>
                        <th>@lang('global.payments.fields.created-by')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($payments) > 0)
            @foreach ($payments as $payment)
                <tr data-entry-id="{{ $payment->id }}">
                    <td field-key='payment_type'>{{ $payment->payment_type }}</td>
                                <td field-key='amount'>{{ $payment->amount }}</td>
                                <td field-key='payment_date'>{{ $payment->payment_date }}</td>
                                <td field-key='created_by'>{{ $payment->created_by->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payments.restore', $payment->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payments.perma_del', $payment->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('payment_view')
                                    <a href="{{ route('admin.payments.show',[$payment->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('payment_edit')
                                    <a href="{{ route('admin.payments.edit',[$payment->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('payment_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payments.destroy', $payment->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="profile">
<table class="table table-bordered table-striped {{ count($profiles) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.profile.fields.firstname')</th>
                        <th>@lang('global.profile.fields.lastname')</th>
                        <th>@lang('global.profile.fields.dob')</th>
                        <th>@lang('global.profile.fields.address')</th>
                        <th>@lang('global.profile.fields.city')</th>
                        <th>@lang('global.profile.fields.province')</th>
                        <th>@lang('global.profile.fields.postalcode')</th>
                        <th>@lang('global.profile.fields.phone')</th>
                        <th>@lang('global.profile.fields.auth-user-fname')</th>
                        <th>@lang('global.profile.fields.auth-user-lname')</th>
                        <th>@lang('global.profile.fields.auth-user-phone')</th>
                        <th>@lang('global.profile.fields.created-by')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($profiles) > 0)
            @foreach ($profiles as $profile)
                <tr data-entry-id="{{ $profile->id }}">
                    <td field-key='firstname'>{{ $profile->firstname }}</td>
                                <td field-key='lastname'>{{ $profile->lastname }}</td>
                                <td field-key='dob'>{{ $profile->dob }}</td>
                                <td field-key='address'>{{ $profile->address_address }}</td>
                                <td field-key='city'>{{ $profile->city }}</td>
                                <td field-key='province'>{{ $profile->province }}</td>
                                <td field-key='postalcode'>{{ $profile->postalcode }}</td>
                                <td field-key='phone'>{{ $profile->phone }}</td>
                                <td field-key='auth_user_fname'>{{ $profile->auth_user_fname }}</td>
                                <td field-key='auth_user_lname'>{{ $profile->auth_user_lname }}</td>
                                <td field-key='auth_user_phone'>{{ $profile->auth_user_phone }}</td>
                                <td field-key='created_by'>{{ $profile->created_by->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.profiles.restore', $profile->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.profiles.perma_del', $profile->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('profile_view')
                                    <a href="{{ route('admin.profiles.show',[$profile->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('profile_edit')
                                    <a href="{{ route('admin.profiles.edit',[$profile->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('profile_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.profiles.destroy', $profile->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="17">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="pet">
<table class="table table-bordered table-striped {{ count($pets) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
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
                        <th>@lang('global.pet.fields.sprayed-neutered')</th>
                        <th>@lang('global.pet.fields.rabies-vacc')</th>
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
                                <td field-key='microchip_file'>@if($pet->microchip_file)<a href="{{ asset(env('UPLOAD_PATH').'/' . $pet->microchip_file) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='sprayed_neutered'>{{ $pet->sprayed_neutered }}</td>
                                <td field-key='rabies_vacc'>{{ $pet->rabies_vacc }}</td>
                                <td field-key='rabies_vacc_file'>@if($pet->rabies_vacc_file)<a href="{{ asset(env('UPLOAD_PATH').'/' . $pet->rabies_vacc_file) }}" target="_blank">Download file</a>@endif</td>
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
