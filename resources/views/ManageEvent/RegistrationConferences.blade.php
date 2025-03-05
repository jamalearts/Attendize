@extends('Shared.Layouts.Master')

@section('title')
    @parent
    @lang('Registration.show_conferences')
@stop

@section('top_nav')
    @include('ManageEvent.Partials.TopNav')
@stop

@section('page_title')
    <i class="ico-folder mr5"></i>
    @lang('Registration.show_conferences')
@stop

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('menu')
    @include('ManageEvent.Partials.Sidebar')
@stop

@section('page_header')
    <div class="col-md-9">
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group btn-group-responsive">
                <button data-modal-id='CreateConference'
                    data-href="{{ route('showCreateEventRegistrationConference', ['event_id' => $event->id]) }}"
                    class='loadModal btn btn-success' type="button">
                    <i class="ico-plus2"></i> @lang('Registration.create_conference')
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::open(array('url' => route('showEventRegistrationConferences', ['event_id'=>$event->id,'sort_by'=>$sort_by]), 'method' => 'get')) !!}
        <div class="input-group">
            <input name='q' value="{{$q or ''}}" placeholder="@lang("Registration.search_tickets")" type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="ico-search"></i></button>
        </span>
            {!!Form::hidden('sort_by', $sort_by)!!}
        </div>
        {!! Form::close() !!}
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($conferences->count())
                <div class="panel">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{!! Html::sortable_link(trans('Registration.name'), $sort_by, 'name', $sort_order, [
                                        'q' => $q,
                                        'page' => $conferences->currentPage(),
                                    ]) !!}</th>
                                    <th>{!! Html::sortable_link(trans('Registration.status'), $sort_by, 'status', $sort_order, [
                                        'q' => $q,
                                        'page' => $conferences->currentPage(),
                                    ]) !!}</th>
                                    <th>{!! Html::sortable_link(trans('Registration.price'), $sort_by, 'price', $sort_order, [
                                        'q' => $q,
                                        'page' => $conferences->currentPage(),
                                    ]) !!}</th>
                                    <th>Professions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($conferences as $conference)
                                    <tr
                                        class="conference_{{ $conference->id }} {{ $conference->status == 'inactive' ? 'danger' : '' }}">
                                        <td>{{ $conference->name }}</td>
                                        <td>{{ $conference->status }}</td>
                                        <td>{{ $conference->price ?? 'N/A' }}</td>
                                        <td>
                                            <a data-modal-id="ConferencesCategory" href="javascript:void(0);" class="loadModal"
                                                data-href="{{route('showEventRegistrationProfessionsConference', ['event_id'=>$event->id ,'conference_id'=>$conference->id])}}"
                                                >Show Conferences</a>
                                        </td>
                                        <td>
                                            <a data-modal-id="EditConference" href="javascript:void(0);"
                                                data-href="{{ route('showEditEventRegistrationConference', ['event_id' => $event->id, 'conference_id' => $conference->id]) }}"
                                                class="loadModal btn btn-xs btn-primary">
                                                @lang('basic.edit')
                                            </a>
                                            <a data-modal-id="DeleteConference" href="javascript:void(0);"
                                                data-href="{{ route('showDeleteEventRegistrationConference', ['event_id' => $event->id, 'conference_id' => $conference->id]) }}"
                                                class="loadModal btn btn-xs btn-danger">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                @if (!empty($q))
                    @include('Shared.Partials.NoSearchResults')
                @else
                    @include('ManageEvent.Partials.AttendeesBlankSlate')
                @endif
            @endif
        </div>
        <div class="col-md-12">
            {!! $conferences->appends(['sort_by' => $sort_by, 'sort_order' => $sort_order, 'q' => $q])->render() !!}
        </div>
    </div>
@stop

@section('foot')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#conferences').select2({
                placeholder: "Select options",
                allowClear: true
            });
        });
    </script>
@stop
