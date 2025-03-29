<div role="dialog" class="modal fade" style="display: none;">
    {!! Form::open([
        'url' => route('postCreateEventRegistrationConference', ['event_id' => $event->id]),
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
                            {!! Form::label('name', trans('Registration.conference_name'), ['class' => 'control-label required']) !!}
                            {!! Form::text('name', old('name'), [
                                'class' => 'form-control',
                                'placeholder' => trans('Registration.conference_name_placeholder'),
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('status', trans('Registration.conference_status'), ['class' => 'control-label required']) !!}
                            {!! Form::select(
                                'status',
                                ['active' => trans('Registration.active'), 'inactive' => trans('Registration.inactive')],
                                old('status'),
                                ['class' => 'form-control', 'required' => 'required'],
                            ) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('categories', trans('Registration.categories'), ['class' => 'control-label required']) !!}
                            {!! Form::select(
                                'categories[]',
                                $categories,
                                old('categories'),
                                ['class' => 'form-control select2-multi', 'id' => 'categories-select', 'multiple' => 'multiple', 'style' => 'width: 100%'],
                            ) !!}
                            <small class="help-block">@lang('Registration.select_multiple_categories')</small>
                        </div>

                        <!-- Dynamic Price Fields Container -->
                        <div id="category-prices-container" class="mb-3">
                            <!-- Price fields will be dynamically added here -->
                            <div class="alert alert-info">
                                Please select categories to set prices for each category.
                            </div>
                        </div>

                        {{-- Dynamic Profession Input Section --}}
                        <div class="form-group">
                            {!! Form::label('professions', trans('Registration.professions'), ['class' => 'control-label']) !!}
                            <div class="input-group mb-3">
                                <input type="text" id="new-profession" class="form-control" style="border: 1px solid lightgray"
                                    placeholder="Enter profession">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="add-profession">Add
                                        Profession</button>
                                </div>
                            </div>

                            {{-- Container for added professions --}}
                            <div id="professions-container" class="mt-2">
                                {{-- Dynamically added professions will appear here --}}
                            </div>

                            {{-- Hidden input to store all professions --}}
                            <input type="hidden" name="professions" id="professions-input" value="">
                        </div>

                        <div class="form-group more-options">
                            {!! Form::label('description', trans('Registration.conference_description'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('description', old('description'), [
                                'class' => 'form-control',
                                'rows' => 3,
                                'placeholder' => trans('Registration.description_placeholder'),
                            ]) !!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <a href="javascript:void(0);" class="show-more-options">
                            @lang('ManageEvent.more_options')
                        </a>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                {!! Form::button(trans('basic.cancel'), ['class' => 'btn modal-close btn-danger', 'data-dismiss' => 'modal']) !!}
                {!! Form::submit(trans('Registration.create_conference'), ['class' => 'btn btn-success']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

{{-- Import sweetalert2 and Add Dynamic input for Add profession --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        const professionsContainer = $('#professions-container');
        const professionsInput = $('#professions-input');
        const newProfessionInput = $('#new-profession');
        const addProfessionButton = $('#add-profession');
        const categoriesSelect = $('#categories-select');
        const categoryPricesContainer = $('#category-prices-container');
        let professions = [];

        // Handle category selection changes
        categoriesSelect.on('change', function() {
            updateCategoryPriceFields();
        });

        // Function to update price fields based on selected categories
        function updateCategoryPriceFields() {
            const selectedCategories = categoriesSelect.val();
            categoryPricesContainer.empty();

            if (!selectedCategories || selectedCategories.length === 0) {
                categoryPricesContainer.html(`
                    <div class="alert alert-info">
                        Please select categories to set prices for each category.
                    </div>
                `);
                return;
            }

            // Add a price field for each selected category
            selectedCategories.forEach(categoryId => {
                const categoryName = categoriesSelect.find(`option[value="${categoryId}"]`).text();

                const priceField = `
                    <div class="form-group category-price-field">
                        <label class="control-label required">Price for ${categoryName}</label>
                        <div class="input-group">
                            <input type="number"
                                name="category_prices[${categoryId}]"
                                class="form-control"
                                style="border: 1px solid lightgray"
                                placeholder="0.00"
                                step="0.01"
                                min="0"
                                required>
                        </div>
                    </div>
                `;

                categoryPricesContainer.append(priceField);
            });
        }

        // Initialize price fields on page load
        updateCategoryPriceFields();

        // Profession handling code
        addProfessionButton.on('click', function() {
            const newProfession = newProfessionInput.val().trim();

            // Validate if the input contains a comma
            if (newProfession.includes(',')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Input!',
                    text: 'Professions cannot contain a comma (","). Please enter a valid profession.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (newProfession && !professions.includes(newProfession)) {
                // Add profession to array
                professions.push(newProfession);

                // Create profession tag with delete button
                const professionTag = `
                <div class="badge badge-primary mr-2 mb-2 profession-tag">
                    ${newProfession}
                    <button type="button" class="close text-white delete-profession" data-profession="${newProfession}">
                        <span>&times;</span>
                    </button>
                </div>
            `;

                // Append to container
                professionsContainer.append(professionTag);

                // Update hidden input
                professionsInput.val(professions.join(','));

                // Clear input
                newProfessionInput.val('');
            }
        });

        // Delete profession
        $(document).on('click', '.delete-profession', function() {
            const professionToRemove = $(this).data('profession');

            // Remove from array
            professions = professions.filter(p => p !== professionToRemove);

            // Remove from UI
            $(this).closest('.profession-tag').remove();

            // Update hidden input
            professionsInput.val(professions.join(','));
        });

        // Allow adding profession by pressing Enter
        newProfessionInput.on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                addProfessionButton.click();
            }
        });
    });
</script>

<style>
    /* Profession */
    .profession-tag {
        display: inline-flex;
        align-items: center;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .profession-tag .close {
        margin-left: 5px;
        opacity: 1;
    }

    /* Category price fields */
    .category-price-field {
        background-color: #f9f9f9;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        border-left: 3px solid #007bff;
    }

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
