@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.profile.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.profile.fields.firstname')</th>
                            <td field-key='firstname'>{{ $profile->firstname }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.profile.fields.lastname')</th>
                            <td field-key='lastname'>{{ $profile->lastname }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.profile.fields.dob')</th>
                            <td field-key='dob'>{{ $profile->dob }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.profile.fields.address')</th>
                            <td field-key='address'>{{ $profile->address_address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.profile.fields.city')</th>
                            <td field-key='city'>{{ $profile->city }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.profile.fields.province')</th>
                            <td field-key='province'>{{ $profile->province }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.profile.fields.postalcode')</th>
                            <td field-key='postalcode'>{{ $profile->postalcode }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.profile.fields.phone')</th>
                            <td field-key='phone'>{{ $profile->phone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.profile.fields.auth-user-fname')</th>
                            <td field-key='auth_user_fname'>{{ $profile->auth_user_fname }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.profile.fields.auth-user-lname')</th>
                            <td field-key='auth_user_lname'>{{ $profile->auth_user_lname }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.profile.fields.auth-user-phone')</th>
                            <td field-key='auth_user_phone'>{{ $profile->auth_user_phone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.profile.fields.created-by')</th>
                            <td field-key='created_by'>{{ $profile->created_by->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.profiles.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
