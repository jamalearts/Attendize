<div role="dialog" class="modal fade" id="editConferenceModal" style="display: none;">
    {!! Form::open([
        'url' => route('postEditEventRegistrationConference', ['conference_id' => $conference->id]),
        'class' => 'ajax',
    ]) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-folder-plus"></i>
                    Edit Conference
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('name', 'Conference Name', ['class' => 'control-label required']) !!}
                            {!! Form::text('name', $conference->name, [
                                'class' => 'form-control',
                                'placeholder' => 'Enter conference name',
                                'required' => 'required',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('status', 'Conference Status', ['class' => 'control-label required']) !!}
                            {!! Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive'], $conference->status, [
                                'class' => 'form-control',
                                'required' => 'required',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('price', 'Conference Price', ['class' => 'control-label required']) !!}
                            {!! Form::number('price', $conference->price, [
                                'class' => 'form-control',
                                'placeholder' => 'Enter conference price',
                                'step' => '0.01',
                                'required' => 'required',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('categories', trans('Registration.categories'), [
                                'class' => 'control-label required',
                            ]) !!}
                            {!! Form::select('categories[]', $categories, $conference->categories()->pluck('categories.id')->toArray(), [
                                'class' => 'form-control select2-multi',
                                'multiple' => 'multiple',
                                'style' => 'width: 100%',
                            ]) !!}
                            <small class="help-block">@lang('Registration.select_multiple_categories')</small>
                        </div>

                        {{-- Professions Section --}}
                        <div class="form-group">
                            {!! Form::label('professions', 'Professions', ['class' => 'control-label']) !!}
                            <div class="input-group mb-3">
                                <input type="text" id="new-profession" class="form-control"
                                    placeholder="Enter profession">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="add-profession">
                                        <i class="fa fa-plus"></i> Add Profession
                                    </button>
                                </div>
                            </div>

                            {{-- Professions Card --}}
                            <div class="card mt-3">
                                <div class="card-header bg-light">
                                    <strong>Profession List</strong>
                                    <span id="profession-counter" class="badge badge-primary float-right">0</span>
                                </div>
                                <div class="card-body">
                                    <div id="professions-container" class="profession-tags-container">
                                        {{-- Professions will be populated here --}}
                                    </div>
                                </div>
                            </div>

                            {{-- Hidden inputs for form submission --}}
                            <input type="hidden" name="professions" id="professions-input" value="">
                            <input type="hidden" name="removed_professions" id="removed-professions-input"
                                value="">
                            <input type="hidden" name="edited_professions" id="edited-professions-input"
                                value="">
                        </div>

                        <div class="form-group more-options">
                            {!! Form::label('description', trans('Registration.conference_description'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('description', old('description', $conference->description), [
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
                {!! Form::button('Cancel', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']) !!}
                {!! Form::submit('Update Conference', ['class' => 'btn btn-success']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .profession-tags-container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        min-height: 50px;
    }

    #new-profession {
        border-right: 1px solid #e0e0e0;

    }

    #new-profession:focus {
        border-right: 1px solid black;
    }

    .profession-tag {
        height: fit-content;
        display: inline-flex;
        align-items: center;
        background-color: #5c6bc0;
        color: white;
        border-radius: 20px;
        padding: 6px 12px;
        font-size: 14px;
        transition: all 0.2s ease;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
        padding-right: 70px;
        /* Space for both edit and delete buttons */
    }

    .card {
        margin-top: 5px;
    }

    .profession-tag:hover {
        background-color: #3f51b5;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .profession-tag .delete-profession,
    .profession-tag .edit-profession {
        position: absolute;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        padding: 0;
        font-size: 14px;
        line-height: 1;
        border: none;
        opacity: 0.8;
        color: white;
    }

    .profession-tag .edit-profession {
        right: 35px;
        top: 50%;
        transform: translateY(-50%);
    }

    .profession-tag .delete-profession {
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
    }

    .profession-tag .delete-profession:hover,
    .profession-tag .edit-profession:hover {
        opacity: 1;
        background: rgba(255, 255, 255, 0.3);
    }

    .profession-tag .profession-text {
        margin-right: 4px;
    }

    .empty-state {
        width: 100%;
        color: #999;
        text-align: center;
        padding: 15px 0;
    }

    @keyframes tagFadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .profession-tag {
        animation: tagFadeIn 0.3s ease-out;
    }

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

    .select2-container--open {
        z-index: 9999;
    }
</style>

<script>
    $(document).ready(function() {
        const professionsContainer = $('#professions-container');
        const professionsInput = $('#professions-input');
        const removedProfessionsInput = $('#removed-professions-input');
        const editedProfessionsInput = $('#edited-professions-input');
        const newProfessionInput = $('#new-profession');
        const addProfessionButton = $('#add-profession');
        const professionCounter = $('#profession-counter');

        const existingProfessions = {!! $conference->professions->pluck('name')->toJson() !!};
        let currentProfessions = [...existingProfessions];
        let removedProfessions = [];
        let editedProfessions = {};

        function renderProfessions() {
            professionsContainer.empty();

            if (currentProfessions.length === 0) {
                professionsContainer.html(`
                <div class="empty-state">
                    <i class="fa fa-tags fa-2x mb-2"></i>
                    <p>No professions added yet</p>
                </div>
            `);
            } else {
                currentProfessions.forEach(function(profession) {
                    const professionTag = `
                    <div class="profession-tag" data-profession="${profession}">
                        <span class="profession-text">${profession}</span>
                        <button type="button" class="edit-profession" data-profession="${profession}">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" class="delete-profession" data-profession="${profession}">
                            <span>&times;</span>
                        </button>
                    </div>
                `;
                    professionsContainer.append(professionTag);
                });
            }

            professionCounter.text(currentProfessions.length);
            professionsInput.val(currentProfessions.join(','));
            removedProfessionsInput.val(removedProfessions.join(','));
            editedProfessionsInput.val(JSON.stringify(editedProfessions));
        }

        renderProfessions();

        addProfessionButton.on('click', function() {
            const newProfession = newProfessionInput.val().trim();

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

            if (newProfession === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Empty Input',
                    text: 'Please enter a profession name.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (newProfession && !currentProfessions.includes(newProfession)) {
                currentProfessions.push(newProfession);
                renderProfessions();
                newProfessionInput.val('');

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Profession added successfully'
                });
            } else if (currentProfessions.includes(newProfession)) {
                Swal.fire({
                    icon: 'info',
                    title: 'Duplicate Entry',
                    text: 'This profession is already in the list.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            }
        });

        // Replace Bootstrap modal with SweetAlert2 for editing professions
        $(document).on('click', '.edit-profession', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const originalProfession = $(this).data('profession');

            Swal.fire({
                title: 'Edit Profession',
                input: 'text',
                inputValue: originalProfession,
                inputLabel: 'Profession Name',
                showCancelButton: true,
                confirmButtonText: 'Save',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
                inputValidator: (value) => {
                    if (!value) {
                        return 'You need to enter a profession name!';
                    }

                    if (value !== originalProfession && currentProfessions.includes(
                        value)) {
                        return 'This profession name already exists!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const newName = result.value.trim();

                    const index = currentProfessions.indexOf(originalProfession);
                    if (index !== -1) {
                        currentProfessions[index] = newName;
                        editedProfessions[originalProfession] = newName;
                        renderProfessions();

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });

                        Toast.fire({
                            icon: 'success',
                            title: 'Profession updated successfully'
                        });
                    }
                }
            });
        });

        $(document).on('click', '.delete-profession', function() {
            const professionToRemove = $(this).data('profession');

            Swal.fire({
                title: 'Remove Profession',
                text: `Are you sure you want to remove "${professionToRemove}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, remove it'
            }).then((result) => {
                if (result.isConfirmed) {
                    currentProfessions = currentProfessions.filter(p => p !==
                        professionToRemove);

                    if (existingProfessions.includes(professionToRemove)) {
                        removedProfessions.push(professionToRemove);
                    }

                    renderProfessions();

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    Toast.fire({
                        icon: 'success',
                        title: 'Profession removed successfully'
                    });
                }
            });
        });

        newProfessionInput.on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                addProfessionButton.click();
            }
        });

        function initSelect2() {
            $('.select2-multi').select2({
                placeholder: "Select options",
                allowClear: true,
                width: '100%',
                dropdownParent: $('.modal.show').length ? $('.modal.show') : $('body')
            });
        }

        initSelect2();

        $(document).on('shown.bs.modal', function() {
            setTimeout(initSelect2, 100);
        });

        $(document).on('click', '.loadModal', function() {
            var modal_id = $(this).data('modal-id');
            var modal_url = $(this).data('href');

            $.ajax({
                url: modal_url,
                success: function(data) {
                    $('#' + modal_id).remove();
                    $('body').append(data);
                    $('#' + modal_id).modal('show');
                    setTimeout(initSelect2, 300);
                }
            });
        });
    });
</script>
