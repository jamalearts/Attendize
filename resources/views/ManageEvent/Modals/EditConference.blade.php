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

                        {{-- Professions Section --}}
                        <div class="form-group">
                            {!! Form::label('professions', 'Professions', ['class' => 'control-label']) !!}
                            <div class="input-group mb-3">
                                <input type="text" id="new-profession" class="form-control"
                                    placeholder="Enter profession">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="add-profession">Add
                                        Profession</button>
                                </div>
                            </div>

                            {{-- Container for existing and new professions --}}
                            <div id="professions-container" class="mt-2">
                                {{-- Existing professions will be populated here --}}
                            </div>

                            {{-- Hidden input to store professions --}}
                            <input type="hidden" name="professions" id="professions-input" value="">
                            <input type="hidden" name="removed_professions" id="removed-professions-input"
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

<script>
    $(document).ready(function() {
        // Initialize profession management
        const professionsContainer = $('#professions-container');
        const professionsInput = $('#professions-input');
        const removedProfessionsInput = $('#removed-professions-input');
        const newProfessionInput = $('#new-profession');
        const addProfessionButton = $('#add-profession');

        // Existing professions
        const existingProfessions = {!! $conference->professions->pluck('name')->toJson() !!};
        let currentProfessions = [...existingProfessions];
        let removedProfessions = [];

        // Function to render professions
        function renderProfessions() {
            // Clear current container
            professionsContainer.empty();

            // Render current professions
            currentProfessions.forEach(function(profession) {
                const professionTag = `
                <div class="badge badge-primary mr-2 mb-2 profession-tag" data-profession="${profession}">
                    ${profession}
                    <button type="button" class="close text-white delete-profession" data-profession="${profession}">
                        <span>&times;</span>
                    </button>
                </div>
            `;
                professionsContainer.append(professionTag);
            });

            // Update hidden inputs
            professionsInput.val(currentProfessions.join(','));
            removedProfessionsInput.val(removedProfessions.join(','));
        }

        // Initial render of existing professions
        renderProfessions();

        // Add profession
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

            if (newProfession && !currentProfessions.includes(newProfession)) {
                currentProfessions.push(newProfession);
                renderProfessions();
                newProfessionInput.val('');
            }
        });

        // Delete profession
        $(document).on('click', '.delete-profession', function() {
            const professionToRemove = $(this).data('profession');

            // Remove from current professions
            currentProfessions = currentProfessions.filter(p => p !== professionToRemove);

            // If it was an existing profession, add to removed professions
            if (existingProfessions.includes(professionToRemove)) {
                removedProfessions.push(professionToRemove);
            }

            // Re-render professions
            renderProfessions();
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
