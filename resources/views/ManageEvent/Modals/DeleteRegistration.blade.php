<div class="modal fade" role="dialog" style="display: none;" id="DeleteRegistration">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">
                    <i class="ico-trash"></i>
                    Delete Registration: {{ $registration->name }}
                </h3>
            </div>
            {!! Form::open([
                'url' => route('postDeleteRegistration', ['event_id' => $event_id, 'registration_id' => $registration->id]),
                'class' => 'ajax',
            ]) !!}

            @method('DELETE')

            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="ico-warning"></i>
                    <strong>Warning!</strong> This action cannot be undone. This will permanently delete the
                    registration and all associated data.
                </div>

                <p>Are you sure you want to delete this registration?</p>

                <div class="well">
                    <div><strong>Name:</strong> {{ $registration->name }}</div>
                    <div><strong>Category:</strong> {{ $registration->category->name ?? 'N/A' }}</div>
                    <div><strong>Status:</strong> {{ ucfirst($registration->status) }}</div>
                    <div><strong>Registered Users:</strong> {{ $registration->registrationUsers()->count() }}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">
                    <i class="ico-trash"></i> Delete Registration
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
