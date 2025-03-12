<div role="dialog" class="modal fade" style="display: none;">
    {!! Form::open([
        'url' => route('postCreateEventRegistration', ['event_id' => $event->id]),
        'class' => 'ajax',
    ]) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-folder-plus"></i>
                    @lang('Registration.create_conference')
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            {!! Form::label('name', 'Registration Name', ['class' => 'control-label required']) !!}
                            {!! Form::text('name', old('name'), [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Registration Name',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('image', 'Image', ['class' => 'control-label ']) !!}
                            {!! Form::styledFile('image') !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('categories', trans('Registration.categories'), ['class' => 'control-label required']) !!}
                            {!! Form::select('categories[]', $categories, old('categories'), [
                                'class' => 'form-control select2-multi',
                                'multiple' => 'multiple',
                                'style' => 'width: 100%',
                            ]) !!}
                            <small class="help-block">@lang('Registration.select_multiple_categories')</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('start_date', trans('Event.event_start_date'), ['class' => 'required control-label']) !!}
                                    {!! Form::text('start_date', $event->getFormattedDate('start_date'), [
                                        'class' => 'form-control start hasDatepicker ',
                                        'data-field' => 'datetime',
                                        'data-startend' => 'start',
                                        'data-startendelem' => '.end',
                                        'readonly' => '',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('end_date', trans('Event.event_end_date'), [
                                        'class' => ' control-label ',
                                    ]) !!}
                                    {!! Form::text('end_date', old('end_date', $event->getFormattedDate('end_date')), [
                                        'class' => 'form-control end hasDatepicker ',
                                        'data-field' => 'datetime',
                                        'data-startend' => 'end',
                                        'data-startendelem' => '.start',
                                        'readonly' => '',
                                    ]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('approval_status', 'Approval Status', ['class' => 'control-label required']) !!}
                                    {!! Form::select('approval_status', ['automatic' => 'Automatic', 'manual' => 'Manual'], 'automatic', [
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('status', 'Status', ['class' => 'control-label required']) !!}
                                    {!! Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive'], 'active', [
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                {!! Form::button(trans('basic.cancel'), ['class' => 'btn modal-close btn-danger', 'data-dismiss' => 'modal']) !!}
                {!! Form::submit('Create Register', ['class' => 'btn btn-success']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

{{-- Import select2 and Initialize Select2 --}}
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2 for static elements
        initSelect2();

        // Initialize Select2 when modal is shown
        $(document).on('shown.bs.modal', function() {
            setTimeout(initSelect2, 100);
        });

        function initSelect2() {
            $('.select2-multi').select2({
                placeholder: "Select options",
                allowClear: true,
                width: '100%',
                dropdownParent: $('.modal.show').length ? $('.modal.show') : $('body')
            });
        }

        // Form submission with validation
        $('form.ajax').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Get form fields
            let name = $('input[name="name"]').val().trim();
            let categories = $('select[name="categories[]"]').val();
            let startDate = $('input[name="start_date"]').val().trim();
            let approvalStatus = $('select[name="approval_status"]').val();
            let status = $('select[name="status"]').val();

            let errorMessage = "";

            if (name === "") {
                errorMessage += "Registration Name is required.<br>";
            }
            if (!categories || categories.length === 0) {
                errorMessage += "Please select at least one category.<br>";
            }
            if (startDate === "") {
                errorMessage += "Start Date is required.<br>";
            }
            if (!approvalStatus) {
                errorMessage += "Approval Status is required.<br>";
            }
            if (!status) {
                errorMessage += "Status is required.<br>";
            }

            if (errorMessage !== "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: errorMessage,
                });
                return false; // Stop form submission
            }

            // Submit form via AJAX if validation passes
            this.submit();
        });
    });
</script>
