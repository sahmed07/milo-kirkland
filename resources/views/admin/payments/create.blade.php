@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.payments.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.payments.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('payment_type', trans('global.payments.fields.payment-type').'', ['class' => 'control-label']) !!}
                 
                    <select id="payment_list" name="payment_list">
                    <option selected>Select a payment...</option>
                    @foreach ($payments as $payment)
                        <option value="{{ $payment->id }}" data-price="{{ $payment->amount }}">{{ $payment->payment_type }}</option>
                    @endforeach
                    </select>

                    <p class="help-block"></p>
                    @if($errors->has('payment_type'))
                        <p class="help-block">
                            {{ $errors->first('payment_type') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('amount', trans('global.payments.fields.amount').'', ['class' => 'control-label']) !!}                            
                    {!! Form::text('amount', old('amount'), ['class' => 'form-control', 'placeholder' => '', 'name' => "amount_list", 'id' => "amount_list", 'disabled']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('amount'))
                        <p class="help-block">
                            {{ $errors->first('amount') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('payment_date', trans('global.payments.fields.payment-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('payment_date', old('payment_date'), ['class' => 'form-control date', 'placeholder' => '', 'id' => 'datetimepicker']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('payment_date'))
                        <p class="help-block">
                            {{ $errors->first('payment_date') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_pay'), ['class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#paymentsModal']) !!}
    {!! Form::close() !!}

    <div class="modal fade" id="paymentsModal" tabindex="-1" role="dialog" aria-labelledby="paymentsModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                        <h4 class="modal-title" id="favoritesModalLabel">Make a Payment</h4>
                </div>
                <div class="modal-body">
                    <p>Please confirm you would like to add 
                        <b><span id="fav-title">The Sun Also Rises</span></b> 
                       to your favorites list.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <span class="pull-right">
                        <button type="button" class="btn btn-primary">Submit</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

@stop

@section('javascript')
    @parent
    
    <script>
            //select amount of payment_type
            $('#payment_list').on('change',function(){
                var price = $(this).children('option:selected').data('price');
                $('#amount_list').val(price);
            });
            
            //disabled past date for payment date
            $(function (){
                var curr_date = new Date();
                $('#datetimepicker').datetimepicker(
                {
                    defaultDate: curr_date,
                    minDate: curr_date,
                    format : 'YYYY-MM-DD',                          
                });
                });

    </script>
    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop