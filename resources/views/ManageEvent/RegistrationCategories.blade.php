@extends('Shared.Layouts.Master')

@section('title')
    @parent
    @lang("Registration.show_categories")
@stop

@section('top_nav')
    @include('ManageEvent.Partials.TopNav')
@stop

@section('page_title')
    <i class="ico-folder mr5"></i>
    @lang("Registration.show_categories")
@stop

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('menu')
    @include('ManageEvent.Partials.Sidebar')
@stop

@section('page_header')
<div class="col-md-9">
    <!-- Toolbar -->
    <div class="btn-toolbar" role="toolbar">
        <div class="btn-group btn-group-responsive">
            <button data-modal-id='CreateCategory'
                    data-href="{{route('showCreateEventRegistrationCategory' , array('event_id'=>$event->id))}}"
                    class='loadModal btn btn-success' type="button"><i class="ico-plus2"></i> @lang("Registration.create_category")
            </button>
        </div>
    </div>
    <!--/ Toolbar -->
</div>
<div class="col-md-3">
    {!! Form::open(array('url' => route('showEventRegistrationCategories', ['event_id'=>$event->id,'sort_by'=>$sort_by]), 'method' => 'get')) !!}
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
<!--Start Attendees table-->
<div class="row">
    <div class="col-md-12">
        @if($categories->count())
        <div class="panel">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                               {!!Html::sortable_link(trans("Registration.name"), $sort_by, 'name', $sort_order, ['q' => $q , 'page' => $categories->currentPage()])!!}
                            </th>
                            <th>
                               {!!Html::sortable_link(trans("Registration.max_participants"), $sort_by, 'max_participants', $sort_order, ['q' => $q , 'page' => $categories->currentPage()])!!}
                            </th>
                            <th>
                               {!!Html::sortable_link(trans("Registration.status"), $sort_by, 'status', $sort_order, ['q' => $q , 'page' => $categories->currentPage()])!!}
                            </th>
                            <th>
                               {!!Html::sortable_link(trans("Registration.start_date"), $sort_by, 'start_date', $sort_order, ['q' => $q , 'page' => $categories->currentPage()])!!}
                            </th>
                            <th>
                                {!!Html::sortable_link(trans("Registration.end_date"), $sort_by, 'end_date', $sort_order, ['q' => $q , 'page' => $categories->currentPage()])!!}
                             </th>
                            <th>conferences</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr class="category_{{$category->id}} {{$category->status == "inactive" ? 'danger' : ''}}">
                            <td>{{{$category->name}}}</td>
                            <td>
                                {{{$category->max_participants ?? 'N/A'}}}
                            </td>
                            <td>
                                {{{$category->status}}}
                            </td>
                            <td>
                                {{{$category->start_date ?? 'N/A'}}}
                            </td><td>
                                {{{$category->end_date ?? 'N/A'}}}
                            </td>
                            <td>
                                <a data-modal-id="ConferencesCategory" href="javascript:void(0);" class="loadModal"
                                    data-href="{{route('showEventRegistrationConferencesCategory', ['event_id'=>$event->id ,'category_id'=>$category->id])}}"
                                    >Show Conferences</a>
                            </td>
                            <td class="text-center">
                                <a
                                    data-modal-id="EditCategory"
                                    href="javascript:void(0);"
                                    data-href="{{route('showEditEventRegistrationCategory', ['event_id'=>$event->id, 'category_id'=>$category->id])}}"
                                    class="loadModal btn btn-xs btn-primary"
                                    > @lang("basic.edit")</a>

                                <a
                                    data-modal-id="CancelAttendee"
                                    href="javascript:void(0);"
                                    data-href="{{route('showDeleteEventRegistrationCategory', ['event_id'=>$event->id, 'category_id'=>$category->id])}}"
                                    class="loadModal btn btn-xs btn-danger"
                                    > Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else

        @if(!empty($q))
        @include('Shared.Partials.NoSearchResults')
        @else
        @include('ManageEvent.Partials.AttendeesBlankSlate')
        @endif

        @endif
    </div>
    <div class="col-md-12">
        {!!$categories->appends(['sort_by' => $sort_by, 'sort_order' => $sort_order, 'q' => $q])->render()!!}
    </div>
</div>    <!--/End attendees table-->
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
