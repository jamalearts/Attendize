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
    <style>
        .bulk-actions {
            display: none;
            margin-bottom: 10px;
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .checkbox-cell {
            width: 30px;
            text-align: center;
        }
        .select-all-container {
            margin-bottom: 10px;
        }
        .select-all-checkbox {
            margin-right: 5px;
        }
        .bulk-delete-btn {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 3px;
            transition: background-color 0.3s;
        }
        .bulk-delete-btn:hover {
            background-color: #c9302c;
        }
        .bulk-delete-btn i {
            margin-right: 5px;
        }
        .conference-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        .not-found-container {
            text-align: center;
            padding: 50px 0;
        }
        .not-found-icon {
            font-size: 5em;
            color: #ccc;
            margin-bottom: 20px;
        }
        .not-found-message {
            font-size: 2em;
            margin-top: 10px;
            color: #777;
        }

        /* Price badges styling */
        .price-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }
        .price-badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
            transition: all 0.2s ease;
        }
        .price-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 6px rgba(0,0,0,0.16);
        }
        .price-badge-category {
            font-weight: normal;
            margin-right: 5px;
            opacity: 0.9;
        }
        .price-badge-amount {
            font-weight: bold;
        }
        .price-badge-count {
            background-color: rgba(255,255,255,0.3);
            border-radius: 10px;
            padding: 2px 6px;
            margin-left: 5px;
            font-size: 10px;
        }
        .price-toggle {
            cursor: pointer;
            color: #3498db;
            margin-top: 5px;
            font-size: 12px;
            display: inline-block;
        }
        .price-toggle:hover {
            text-decoration: underline;
        }
        .price-summary {
            margin-bottom: 5px;
            font-weight: bold;
        }
        .price-range {
            background: linear-gradient(135deg, #3498db, #2980b9);
        }
    </style>
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
        {!! Form::open([
            'url' => route('showEventRegistrationConferences', ['event_id' => $event->id, 'sort_by' => $sort_by]),
            'method' => 'get',
        ]) !!}
        <div class="input-group">
            <input name='q' value="{{ $q or '' }}" placeholder="@lang('Registration.search_tickets')" type="text"
                class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="ico-search"></i></button>
            </span>
            {!! Form::hidden('sort_by', $sort_by) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Bulk Actions Area -->
            <div class="bulk-actions panel panel-default">
                <div class="panel-body">
                    <button id="bulkDeleteBtn" class="bulk-delete-btn" disabled>
                        <i class="ico-trash"></i> Delete Selected Conferences
                    </button>
                    <span id="selectedCount" class="text-muted ml-2"></span>
                </div>
            </div>

            @if ($conferences->count())
                <div class="panel">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="checkbox-cell">
                                        <label>
                                            <input type="checkbox" id="selectAll" class="select-all-checkbox">
                                        </label>
                                    </th>
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
                                    <th>Categories</th>
                                    <th>Professions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($conferences as $conference)
                                    <tr
                                        class="conference_{{ $conference->id }} {{ $conference->status == 'inactive' ? 'danger' : '' }}">
                                        <td class="checkbox-cell">
                                            <input type="checkbox" class="conference-checkbox" data-id="{{ $conference->id }}" data-name="{{ $conference->name }}">
                                        </td>
                                        <td>{{ $conference->name }}</td>
                                        <td>
                                            @if($conference->status == 'active')
                                                <span class="label label-success">Active</span>
                                            @else
                                                <span class="label label-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($conference->categories->count() > 0)
                                                @php
                                                    $minPrice = $conference->categories->min('pivot.price');
                                                    $maxPrice = $conference->categories->max('pivot.price');
                                                    $uniquePrices = $conference->categories->pluck('pivot.price')->unique()->count();
                                                @endphp

                                                <div class="price-summary">
                                                    @if($minPrice == $maxPrice)
                                                        <div class="price-badge">
                                                            <span class="price-badge-amount">${{ number_format($minPrice, 2) }}</span>
                                                            <span class="price-badge-count">{{ $conference->categories->count() }}</span>
                                                        </div>
                                                    @else
                                                        <div class="price-badge price-range">
                                                            <span class="price-badge-amount">${{ number_format($minPrice, 2) }} - ${{ number_format($maxPrice, 2) }}</span>
                                                            <span class="price-badge-count">{{ $uniquePrices }}</span>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="price-details-{{ $conference->id }}" style="display: none;">
                                                    <div class="price-badges">
                                                        @foreach($conference->categories as $category)
                                                            <div class="price-badge">
                                                                <span class="price-badge-category">{{ Str::limit($category->name, 15) }}:</span>
                                                                <span class="price-badge-amount">${{ number_format($category->pivot->price, 2) }}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <a href="javascript:void(0);" class="price-toggle"
                                                   data-conference="{{ $conference->id }}"
                                                   data-show-text="Show all prices"
                                                   data-hide-text="Hide prices">
                                                    Show all prices
                                                </a>
                                            @else
                                                <span class="text-muted">No categories</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($conference->categories->count() > 0)
                                                <span class="label label-info">{{ $conference->categories->count() }}</span>
                                                <a data-modal-id="CategoriesConference" href="javascript:void(0);"
                                                    class="loadModal"
                                                    data-href="{{ route('showEventRegistrationCategoriesConference', ['event_id' => $event->id, 'conference_id' => $conference->id]) }}">View</a>
                                            @else
                                                <span class="text-muted">None</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($conference->professions->count() > 0)
                                                <span class="label label-info">{{ $conference->professions->count() }}</span>
                                                <a data-modal-id="Professions" href="javascript:void(0);" class="loadModal"
                                                    data-href="{{ route('showEventRegistrationProfessionsConference', ['event_id' => $event->id, 'conference_id' => $conference->id]) }}">View</a>
                                            @else
                                                <span class="text-muted">None</span>
                                            @endif
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
                    <div class="not-found-container">
                        <i class="ico-folder-open not-found-icon"></i>
                        <p class="not-found-message">No conferences found.</p>
                    </div>
                @endif
            @endif
        </div>
        <div class="col-md-12">
            {!! $conferences->appends(['sort_by' => $sort_by, 'sort_order' => $sort_order, 'q' => $q])->render() !!}
        </div>
    </div>

    <!-- Bulk Delete Confirmation Modal -->
    <div class="modal fade" id="bulkDeleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm Bulk Delete</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the selected conferences?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>
                    <div id="selectedConferencesList" class="well" style="max-height: 200px; overflow-y: auto;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmBulkDelete" class="btn btn-danger">Delete Conferences</button>
                </div>
            </div>
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

            // Toggle price details
            $(document).on('click', '.price-toggle', function() {
                const conferenceId = $(this).data('conference');
                const detailsElement = $(`.price-details-${conferenceId}`);
                const showText = $(this).data('show-text');
                const hideText = $(this).data('hide-text');

                if (detailsElement.is(':visible')) {
                    detailsElement.slideUp(200);
                    $(this).text(showText);
                } else {
                    detailsElement.slideDown(200);
                    $(this).text(hideText);
                }
            });

            // Bulk delete functionality
            let selectedConferences = [];

            // Update UI based on selections
            function updateBulkActionUI() {
                if (selectedConferences.length > 0) {
                    $('.bulk-actions').show();
                    $('#bulkDeleteBtn').prop('disabled', false);
                    $('#selectedCount').text(selectedConferences.length + ' conferences selected');
                } else {
                    $('.bulk-actions').hide();
                    $('#bulkDeleteBtn').prop('disabled', true);
                    $('#selectedCount').text('');
                }
            }

            // Handle checkbox clicks
            $(document).on('change', '.conference-checkbox', function() {
                const conferenceId = $(this).data('id');
                const conferenceName = $(this).data('name');

                if ($(this).is(':checked')) {
                    // Add to selected array if not already there
                    if (!selectedConferences.some(conf => conf.id === conferenceId)) {
                        selectedConferences.push({
                            id: conferenceId,
                            name: conferenceName
                        });
                    }
                } else {
                    // Remove from selected array
                    selectedConferences = selectedConferences.filter(conf => conf.id !== conferenceId);

                    // Uncheck "select all" if any conference is unchecked
                    $('#selectAll').prop('checked', false);
                }

                updateBulkActionUI();
            });

            // Select All checkbox
            $('#selectAll').change(function() {
                const isChecked = $(this).is(':checked');

                // Check/uncheck all conference checkboxes
                $('.conference-checkbox').prop('checked', isChecked);

                // Update selected conferences array
                selectedConferences = [];
                if (isChecked) {
                    $('.conference-checkbox').each(function() {
                        selectedConferences.push({
                            id: $(this).data('id'),
                            name: $(this).data('name')
                        });
                    });
                }

                updateBulkActionUI();
            });

            // Show confirmation modal when bulk delete button is clicked
            $('#bulkDeleteBtn').click(function() {
                // Populate selected conferences list
                let listHtml = '<ul>';
                selectedConferences.forEach(conf => {
                    listHtml += `<li>${conf.name}</li>`;
                });
                listHtml += '</ul>';

                $('#selectedConferencesList').html(listHtml);
                $('#bulkDeleteModal').modal('show');
            });

            // Handle confirm bulk delete
            $('#confirmBulkDelete').click(function() {
                const conferenceIds = selectedConferences.map(conf => conf.id);

                // Show loading state
                $(this).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');
                $(this).prop('disabled', true);

                // Send AJAX request
                $.ajax({
                    url: "{{ route('postBulkDeleteConferences', ['event_id' => $event->id]) }}",
                    type: 'POST',
                    data: {
                        conference_ids: conferenceIds,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Remove deleted rows from the table
                            conferenceIds.forEach(id => {
                                $('.conference_' + id).fadeOut(function() {
                                    $(this).remove();
                                });
                            });

                            // Reset selection
                            selectedConferences = [];
                            updateBulkActionUI();
                            $('#selectAll').prop('checked', false);

                            // Show success message
                            showMessage('success', response.message);

                            // Close modal
                            $('#bulkDeleteModal').modal('hide');
                        } else {
                            showMessage('error', response.message);
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        showMessage('error', 'An error occurred while processing your request');
                    },
                    complete: function() {
                        // Reset button state
                        $('#confirmBulkDelete').html('Delete Conferences');
                        $('#confirmBulkDelete').prop('disabled', false);
                    }
                });
            });

            // Helper function to show messages
            function showMessage(type, message) {
                let alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
                let alertHtml = `
                    <div class="alert ${alertClass} alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        ${message}
                    </div>
                `;

                // Insert alert at the top of the content area
                $('.bulk-actions').after(alertHtml);

                // Auto-dismiss after 5 seconds
                setTimeout(function() {
                    $('.alert').alert('close');
                }, 5000);
            }
        });
    </script>
@stop
