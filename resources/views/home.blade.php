@extends('layouts.app')

@section('content')
    <div class="row">
         <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added pets</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.pet.fields.tag-id')</th>
                            <th> @lang('global.pet.fields.pet-photo')</th>  
                            <th> @lang('global.pet.fields.pet-name')</th> 
                            <th> @lang('global.pet.fields.pet-breed')</th> 
                            <th> @lang('global.pet.fields.pet-color')</th> 
                            <th> @lang('global.pet.fields.pet-age')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($pets as $pet)
                            <tr>
                               
                                <td>{{ $pet->tag_id }} </td>
                                <td field-key='pet_photo'>@if($pet->pet_photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $pet->pet_photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $pet->pet_photo) }}"/></a>@endif</td>
                                <td>{{ $pet->pet_name }} </td> 
                                <td>{{ $pet->pet_breed }} </td> 
                                <td>{{ $pet->pet_color }} </td> 
                                <td>{{ $pet->pet_age }} </td> 
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
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added contentpages</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.content-pages.fields.title')</th> 
                            <th> @lang('global.content-pages.fields.page-text')</th> 
                            <th> @lang('global.content-pages.fields.excerpt')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($contentpages as $contentpage)
                            <tr>
                               
                                <td>{{ $contentpage->title }} </td> 
                                <td>{{ $contentpage->page_text }} </td> 
                                <td>{{ $contentpage->excerpt }} </td> 
                                <td>

                                    @can('content_page_view')
                                    <a href="{{ route('admin.content_pages.show',[$contentpage->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('content_page_edit')
                                    <a href="{{ route('admin.content_pages.edit',[$contentpage->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('content_page_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.content_pages.destroy', $contentpage->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added contentcategories</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.content-categories.fields.title')</th> 
                            <th> @lang('global.content-categories.fields.slug')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($contentcategories as $contentcategory)
                            <tr>
                               
                                <td>{{ $contentcategory->title }} </td> 
                                <td>{{ $contentcategory->slug }} </td> 
                                <td>

                                    @can('content_category_view')
                                    <a href="{{ route('admin.content_categories.show',[$contentcategory->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('content_category_edit')
                                    <a href="{{ route('admin.content_categories.edit',[$contentcategory->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('content_category_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.content_categories.destroy', $contentcategory->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added payments</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.payments.fields.payment-type')</th> 
                            <th> @lang('global.payments.fields.amount')</th> 
                            <th> @lang('global.payments.fields.payment-date')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($payments as $payment)
                            <tr>
                               
                                <td>{{ $payment->payment_type }} </td> 
                                <td>{{ $payment->amount }} </td> 
                                <td>{{ $payment->payment_date }} </td> 
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
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>


    </div>
@endsection

