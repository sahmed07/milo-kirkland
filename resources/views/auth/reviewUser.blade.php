@extends('layouts.auth')

@section('content')
    <h3 class="page-title">@lang('global.pet.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['auth.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pet_photo', trans('global.pet.fields.pet-photo').'', ['class' => 'control-label']) !!}
                    {!! Form::file('pet_photo', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('pet_photo_max_size', 3) !!}
                    {!! Form::hidden('pet_photo_max_width', 1500) !!}
                    {!! Form::hidden('pet_photo_max_height', 1500) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pet_photo'))
                        <p class="help-block">
                            {{ $errors->first('pet_photo') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pet_name', trans('global.pet.fields.pet-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('pet_name', old('pet_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pet_name'))
                        <p class="help-block">
                            {{ $errors->first('pet_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pet_type', trans('global.pet.fields.pet-type').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pet_type'))
                        <p class="help-block">
                            {{ $errors->first('pet_type') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('pet_type', 'dog', false, []) !!}
                            Dog
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('pet_type', 'cat', false, []) !!}
                            Cat
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pet_breed', trans('global.pet.fields.pet-breed').'', ['class' => 'control-label']) !!}
                    {!! Form::select('pet_breed', $breed, old('breed'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pet_breed'))
                        <p class="help-block">
                            {{ $errors->first('pet_breed') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pet_color', trans('global.pet.fields.pet-color').'', ['class' => 'control-label']) !!}
                    {!! Form::text('pet_color', old('pet_color'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pet_color'))
                        <p class="help-block">
                            {{ $errors->first('pet_color') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pet_age', trans('global.pet.fields.pet-age').'', ['class' => 'control-label']) !!}
                    {!! Form::text('pet_age', old('pet_age'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pet_age'))
                        <p class="help-block">
                            {{ $errors->first('pet_age') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pet_sex', trans('global.pet.fields.pet-sex').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pet_sex'))
                        <p class="help-block">
                            {{ $errors->first('pet_sex') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('pet_sex', 'male', false, []) !!}
                            Male
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('pet_sex', 'female', false, []) !!}
                            Female
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('behaviour', trans('global.pet.fields.behaviour').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('behaviour'))
                        <p class="help-block">
                            {{ $errors->first('behaviour') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('behaviour', 'docile', false, []) !!}
                            Docile
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('behaviour', 'aggressive', false, []) !!}
                            Aggressive
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pet_size', trans('global.pet.fields.pet-size').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pet_size'))
                        <p class="help-block">
                            {{ $errors->first('pet_size') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('pet_size', 'small', false, []) !!}
                            Small
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('pet_size', 'medium', false, []) !!}
                            Medium
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('pet_size', 'large', false, []) !!}
                            Large
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('distinctive_sign', trans('global.pet.fields.distinctive-sign').'', ['class' => 'control-label']) !!}
                    {!! Form::text('distinctive_sign', old('distinctive_sign'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('distinctive_sign'))
                        <p class="help-block">
                            {{ $errors->first('distinctive_sign') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('microchip', trans('global.pet.fields.microchip').'', ['class' => 'control-label']) !!}
                    {!! Form::select('microchip', $enum_microchip, 'No', ['class' => 'form-control select2'], ['id'=>'microchip']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('microchip'))
                        <p class="help-block">
                            {{ $errors->first('microchip') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div id="microchip_file">
                <div class="col-xs-12 form-group">
                    {!! Form::label('microchip_file', trans('global.pet.fields.microchip-file').'', ['class' => 'control-label']) !!}
                    {!! Form::file('microchip_file[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'microchip_file',
                        'data-filekey' => 'microchip_file',
                        ]) !!}
                    <p class="help-block"></p>
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('microchip_file'))
                        <p class="help-block">
                            {{ $errors->first('microchip_file') }}
                        </p>
                    @endif
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('sprayed_neutered', trans('global.pet.fields.sprayed-neutered').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('sprayed_neutered'))
                        <p class="help-block">
                            {{ $errors->first('sprayed_neutered') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('sprayed_neutered', 'yes', false, []) !!}
                            Yes
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('sprayed_neutered', 'no', false, []) !!}
                            No
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('rabies_vacc', trans('global.pet.fields.rabies-vacc').'', ['class' => 'control-label']) !!}
                    {!! Form::select('rabies_vacc', $enum_rabies_vacc, 'No', ['class' => 'form-control select2'], ['id'=>'rabies_vacc']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('rabies_vacc'))
                        <p class="help-block">
                            {{ $errors->first('rabies_vacc') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div id="rabies_vacc_file">
                <div class="col-xs-12 form-group">
                    {!! Form::label('rabies_vacc_file', trans('global.pet.fields.rabies-vacc-file').'', ['class' => 'control-label']) !!}
                    {!! Form::file('rabies_vacc_file[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'rabies_vacc_file',
                        'data-filekey' => 'rabies_vacc_file',
                        ]) !!}
                    <p class="help-block"></p>
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('rabies_vacc_file'))
                        <p class="help-block">
                            {{ $errors->first('rabies_vacc_file') }}
                        </p>
                    @endif
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pet_status', trans('global.pet.fields.pet-status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('pet_status', $enum_pet_status, old('pet_status'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pet_status'))
                        <p class="help-block">
                            {{ $errors->first('pet_status') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pay_status', trans('global.pet.fields.pay-status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('pay_status', $enum_pay_status, old('pay_status'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pay_status'))
                        <p class="help-block">
                            {{ $errors->first('pay_status') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
 <!--   {!! Form::submit(trans('global.app_register'), ['class' => 'btn btn-danger']) !!}  -->
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <!--show / hide microchip_file-->
    <script>
    $(function() {
        $('#microchip_file').hide(); 
        $('#microchip').change(function(){
            if($('#microchip').val() == 'Yes') {
                $('#microchip_file').show(); 
            } else {
                $('#microchip_file').hide(); 
            } 
        });
    });    
    </script> <!--end of microchip file-->

    <!--show / hide rabies_vacc_file-->
    <script>
    $(function() {
        $('#rabies_vacc_file').hide(); 
        $('#rabies_vacc').change(function(){
            if($('#rabies_vacc').val() == 'Yes') {
                $('#rabies_vacc_file').show(); 
            } else {
                $('#rabies_vacc_file').hide(); 
            } 
        });
    });    
    </script> <!--end of microchip file-->


    <script src="{{ asset('adminlte/plugins/fileUpload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/fileUpload/js/jquery.fileupload.js') }}"></script>
    <script>
        $(function () {
            $('.file-upload').each(function () {
                var $this = $(this);
                var $parent = $(this).parent();

                $(this).fileupload({
                    dataType: 'json',
                    formData: {
                        model_name: 'Pet',
                        bucket: $this.data('bucket'),
                        file_key: $this.data('filekey'),
                        _token: '{{ csrf_token() }}'
                    },
                    add: function (e, data) {
                        data.submit();
                    },
                    done: function (e, data) {
                        $.each(data.result.files, function (index, file) {
                            var $line = $($('<p/>', {class: "form-group"}).html(file.name + ' (' + file.size + ' bytes)').appendTo($parent.find('.files-list')));
                            $line.append('<a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>');
                            $line.append('<input type="hidden" name="' + $this.data('bucket') + '_id[]" value="' + file.id + '"/>');
                            if ($parent.find('.' + $this.data('bucket') + '-ids').val() != '') {
                                $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + ',');
                            }
                            $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + file.id);
                        });
                        $parent.find('.progress-bar').hide().css(
                            'width',
                            '0%'
                        );
                    }
                }).on('fileuploadprogressall', function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $parent.find('.progress-bar').show().css(
                        'width',
                        progress + '%'
                    );
                });
            });
            $(document).on('click', '.remove-file', function () {
                var $parent = $(this).parent();
                $parent.remove();
                return false;
            });
        });
    </script>
@stop