@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.payments-rates.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.payments-rates.fields.payment-type')</th>
                            <td field-key='payment_type'>{{ $payments_rate->payment_type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.payments-rates.fields.amount')</th>
                            <td field-key='amount'>{{ $payments_rate->amount }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.payments_rates.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
