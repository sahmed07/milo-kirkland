@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.profile.title')</h3>
    @can('profile_create')
    <p>
        <a href="{{ route('admin.profiles.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
        @if(!is_null(Auth::getUser()->role_id) && config('global.can_see_all_records_role_id') == Auth::getUser()->role_id)
            @if(Session::get('Profile.filter', 'all') == 'my')
                <a href="?filter=all" class="btn btn-default">Show all records</a>
            @else
                <a href="?filter=my" class="btn btn-default">Filter my records</a>
            @endif
        @endif
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.profiles.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.profiles.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($profiles) > 0 ? 'datatable' : '' }} @can('profile_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('profile_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('profile_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
    </div>
@stop

@section('javascript') 
    <script>
        @can('profile_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.profiles.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection