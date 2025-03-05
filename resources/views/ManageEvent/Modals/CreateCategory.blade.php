<div role="dialog" class="modal fade" style="display: none;">
    {!! Form::open(['url' => route('postCreateEventRegistrationCategory', ['event_id' => $event->id]), 'class' => 'ajax']) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-folder-plus"></i>
                    @lang('Registration.create_category')
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('name', trans('Registration.category_name') , ['class' => 'control-label required']) !!}
                            {!! Form::text('name', old('name'), [
                                'class' => 'form-control',
                                'placeholder' => trans('Registration.category_name_placeholder'),
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('conferences', trans('Registration.category_conferences'), ['class' => 'control-label required']) !!}
                            {!! Form::select(
                                'conferences[]',
                                $conferences,
                                old('conferences'),
                                ['class' => 'form-control select2-multi', 'multiple' => 'multiple', 'style' => 'width: 100%'],
                            ) !!}
                            <small   class="help-block">@lang('Registration.select_multiple_conference')</small>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('max_participants', trans('Registration.max_participants'), [
                                        'class' => 'control-label',
                                    ]) !!}
                                    {!! Form::text('max_participants', old('max_participants'), [
                                        'class' => 'form-control',
                                        'placeholder' => trans('Registration.max_participants_placeholder'),
                                    ]) !!}

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('status', trans('Registration.category_status'), ['class' => 'control-label required']) !!}
                                    {!! Form::select(
                                        'status',
                                        ['active' => trans('Registration.active'), 'inactive' => trans('Registration.inactive')],
                                        old('status'),
                                        ['class' => 'form-control' , 'required'],
                                    ) !!}
                                </div>
                            </div>

                        </div>

                        <div class="form-group more-options">
                            {!! Form::label('description', trans('Registration.category_description'), ['class' => 'control-label']) !!}
                            {!! Form::text('description', old('description'), [
                                'class' => 'form-control',
                            ]) !!}
                        </div>

                        <div class="row more-options">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('start_date', trans('Registration.start_date'), ['class' => ' control-label']) !!}
                                    {!! Form::text('start_date', old('start_date'), [
                                        'class' => 'form-control start hasDatepicker ',
                                        'data-field' => 'datetime',
                                        'data-startend' => 'start',
                                        'data-startendelem' => '.end',
                                        'readonly' => '',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    {!! Form::label('end_date', trans('Registration.end_date'), [
                                        'class' => ' control-label ',
                                    ]) !!}
                                    {!! Form::text('end_date', old('end_date'), [
                                        'class' => 'form-control end hasDatepicker ',
                                        'data-field' => 'datetime',
                                        'data-startend' => 'end',
                                        'data-startendelem' => '.start',
                                        'readonly' => '',
                                    ]) !!}
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="col-md-12">
                        <a href="javascript:void(0);" class="show-more-options">
                            @lang('ManageEvent.more_options')
                        </a>
                    </div>

                </div>

            </div> <!-- /end modal body-->
            <div class="modal-footer">
                {!! Form::button(trans('basic.cancel'), ['class' => 'btn modal-close btn-danger', 'data-dismiss' => 'modal']) !!}
                {!! Form::submit(trans('Registration.create_category'), ['class' => 'btn btn-success']) !!}
            </div>
        </div><!-- /end modal content-->
        {!! Form::close() !!}
    </div>
</div>

<style>
    /* Fix for Select2 width issues */
    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--multiple {
        width: 100% !important;
        min-height: 34px;
        border-color: #ccc;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        width: 100%;
    }

    /* Fix for modal z-index issues with Select2 dropdowns */
    .select2-container--open {
        z-index: 9999;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2 for static elements
        initSelect2();

        // Initialize Select2 when modal is shown
        $(document).on('shown.bs.modal', function() {
            setTimeout(initSelect2, 100);
        });

        // Function to initialize Select2
        function initSelect2() {
            $('.select2-multi').select2({
                placeholder: "Select options",
                allowClear: true,
                width: '100%',
                dropdownParent: $('.modal.show').length ? $('.modal.show') : $('body')
            });
        }

        // Handle loadModal events
        $(document).on('click', '.loadModal', function() {
            var modal_id = $(this).data('modal-id');
            var modal_url = $(this).data('href');

            $.ajax({
                url: modal_url,
                success: function(data) {
                    $('#' + modal_id).remove();
                    $('body').append(data);
                    $('#' + modal_id).modal('show');

                    // Initialize Select2 after modal content is loaded
                    setTimeout(initSelect2, 300);
                }
            });
        });
    });
</script>
