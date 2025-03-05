<div role="dialog" class="modal fade " style="display: none;">
    {!! Form::open([
        'url' => route('postDeleteEventRegistrationConference', [
            'event_id' => $conference->event->id,
            'conference_id' => $conference->id,
        ]),
        'class' => 'ajax',
    ]) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">
                    <i class="ico-cancel"></i>
                    Delete , {{ $conference->name }}
                </h3>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    You are sure from delete this conference ?
                </div>
            </div> <!-- /end modal body-->
            <div class="modal-footer">
                {!! Form::button(trans('basic.cancel'), ['class' => 'btn modal-close btn-danger', 'data-dismiss' => 'modal']) !!}
                {!! Form::submit('Yes , Delete it', ['class' => 'btn btn-success']) !!}
            </div>
        </div><!-- /end modal content-->
        {!! Form::close() !!}
    </div>
</div>
