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
                            {!! Form::label('price', trans('Registration.conference_price'), ['class' => 'control-label required']) !!}
                            {!! Form::number('price', old('price'), [
                                'class' => 'form-control',
                                'placeholder' => trans('Registration.price_placeholder'),
                                'step' => '0.01',
                                'required' => 'required',
                            ]) !!}
                        </div>

                        {{-- Dynamic Profession Input Section --}}
                        <div class="form-group">
                            {!! Form::label('professions', trans('Registration.professions'), ['class' => 'control-label']) !!}
                            <div class="input-group mb-3">
                                <input type="text" id="new-profession" class="form-control"
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        const professionsContainer = $('#professions-container');
        const professionsInput = $('#professions-input');
        const newProfessionInput = $('#new-profession');
        const addProfessionButton = $('#add-profession');
        let professions = [];

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
</style>
