@extends('Shared.Layouts.Master')

@section('title')
    @parent
    @lang('Registration.event_registration')
@stop

@section('top_nav')
    @include('ManageEvent.Partials.TopNav')
@stop

@section('page_title')
    <i class="ico-file-text mr5"></i>
    @lang('Registration.event_registration')
@stop

@section('menu')
    @include('ManageEvent.Partials.Sidebar')
@stop

@section('page_header')
    <div class="col-md-9">
        <!-- Toolbar -->
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group btn-group-responsive">
                <a href="{{ route('showEventRegistrationCategories', ['event_id' => $event->id]) }}" class='btn btn-success'
                    type="button"><i class="ico-folder"></i> @lang('Registration.show_categories')
                </a>
            </div>
            <div class="btn-group btn-group-responsive">
                <a href="{{ route('showEventRegistrationConferences', ['event_id' => $event->id]) }}"
                    class='btn btn-success' type="button"><i class="ico-users"></i> @lang('Registration.show_conferences_register')
                </a>
            </div>
        </div>
        <!--/ Toolbar -->
    </div>
    {{-- <div class="col-md-3">
    {!! Form::open(array('url' => route('showEventTickets', ['event_id'=>$event->id,'sort_by'=>$sort_by]), 'method' => 'get')) !!}
    <div class="input-group">
        <input name='q' value="{{$q or ''}}" placeholder="@lang("Ticket.search_tickets")" type="text" class="form-control">
    <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="ico-search"></i></button>
    </span>
        {!!Form::hidden('sort_by', $sort_by)!!}
    </div>
    {!! Form::close() !!}
</div> --}}
@stop

@section('content')


    @include('ManageOrganiser.Partials.EventCreateAndEditJS')

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="ico-file-text"></i>
                        Registration Form
                    </h3>
                </div>
                <div class="panel-body">
                    {{-- {!! Form::open(['url' => route('storeEventRegistration', ['event_id' => $event->id]), 'class' => 'ajax']) !!} --}}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('category_id', 'Category', ['class' => 'control-label required']) !!}
                                {!! Form::select('category_id', ['mm', 'ss'], null, ['class' => 'form-control']) !!}
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
                                {!! Form::label('end_date', trans('ManageEvent.end_sale_on'), [
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('approval_status', 'Approval Status', ['class' => 'control-label required']) !!}
                                {!! Form::select('approval_status', ['automatic' => 'Automatic', 'manual' => 'Manual'], 'automatic', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="ico-save"></i>
                                    Save Registration
                                </button>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('.start_date, .end_date').datetimepicker({
                format: 'MM/DD/YYYY HH:mm',
                icons: {
                    time: 'ico-clock',
                    date: 'ico-calendar',
                    up: 'ico-arrow-up',
                    down: 'ico-arrow-down',
                    previous: 'ico-arrow-left',
                    next: 'ico-arrow-right',
                }
            });
        });
    </script>
@stop
