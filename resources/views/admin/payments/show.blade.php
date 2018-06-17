@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.payments.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.payments.fields.payment-type')</th>
                            <td field-key='payment_type'>{{ $payment->payment_type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.payments.fields.amount')</th>
                            <td field-key='amount'>{{ $payment->amount }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.payments.fields.payment-date')</th>
                            <td field-key='payment_date'>{{ $payment->payment_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.payments.fields.created-by')</th>
                            <td field-key='created_by'>{{ $payment->created_by->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.payments.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
