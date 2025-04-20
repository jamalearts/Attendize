{{-- resources/views/ManageEvent/EventRegistrationUsers.blade.php --}}
@extends('Shared.Layouts.Master')

@section('title')
    @parent
    {{ $event->title }} - All Registered Users
@stop

@section('top_nav')
    @include('ManageEvent.Partials.TopNav')
@stop

@section('page_title')
    <i class="ico-users mr5"></i>
    All Registered Users
    <span class="page-title-buttons">
        <a href="{{ route('showEventRegistration', ['event_id' => $event->id]) }}" class="btn btn-default btn-sm">
            <i class="ico-arrow-left"></i> Back to Registrations
        </a>
        <a href="{{ route('showEventRegistrationUsers', ['event_id' => $event->id, 'mark_as_viewed' => 1]) }}"
            class="btn btn-success btn-sm">
            <i class="ico-checkmark"></i> Mark All as Viewed
        </a>
    </span>
@stop

@section('head')
    <style>
        .search-form {
            margin-bottom: 20px;
        }

        .user-status {
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-pending {
            background-color: #f0ad4e;
            color: white;
        }

        .status-approved {
            background-color: #5cb85c;
            color: white;
        }

        .status-rejected {
            background-color: #d9534f;
            color: white;
        }

        .bulk-actions {
            margin-bottom: 15px;
        }

        .user-details {
            margin-bottom: 5px;
        }

        .user-details strong {
            display: inline-block;
            min-width: 100px;
        }

        .user-actions .dropdown-menu {
            min-width: 120px;
        }

        .user-actions .dropdown-menu a {
            padding: 5px 12px;
        }

        .user-actions .dropdown-menu i {
            margin-right: 5px;
        }

        .filter-status {
            margin-right: 10px;
        }

        .filter-status.active {
            font-weight: bold;
            text-decoration: underline;
        }

        .pagination {
            margin-top: 0;
        }

        .table-responsive {
            border: none;
        }

        .table>tbody>tr>td {
            vertical-align: middle;
        }

        .checkbox-column {
            width: 40px;
            text-align: center;
        }

        .status-column {
            width: 100px;
        }

        .actions-column {
            width: 120px;
            text-align: right;
        }

        .no-results {
            padding: 50px 0;
            text-align: center;
        }

        .no-results i {
            font-size: 48px;
            color: #ddd;
            margin-bottom: 15px;
            display: block;
        }

        .no-results h4 {
            color: #888;
            margin-bottom: 10px;
        }

        .no-results p {
            color: #999;
        }

        .new-registration {
            background-color: #fffde7;
            position: relative;
        }

        .new-registration::after {
            content: 'NEW';
            position: absolute;
            top: 0;
            right: 0;
            background-color: #ff4136;
            color: white;
            font-size: 10px;
            padding: 2px 5px;
            font-weight: bold;
        }

        .page-title-buttons {
            display: inline-block;
            margin-left: 20px;
        }
    </style>
@stop

@section('menu')
    @include('ManageEvent.Partials.Sidebar')
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="ico-filter"></i> Filter Users
                    </h3>
                </div>
                <div class="panel-body">
                    <form class="search-form" method="GET"
                        action="{{ route('showEventRegistrationUsers', ['event_id' => $event->id]) }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="search">Search</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="search" name="search"
                                            placeholder="Search by name or email" value="{{ $filters['search'] ?? '' }}">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">
                                                <i class="ico-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="registration_id">Registration Form</label>
                                    <select name="registration_id" id="registration_id" class="form-control">
                                        <option value="">All Registration Forms</option>
                                        @foreach ($registrations as $id => $name)
                                            <option value="{{ $id }}"
                                                {{ isset($filters['registration_id']) && $filters['registration_id'] == $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <div>
                                        <a href="{{ route('showEventRegistrationUsers', array_merge(request()->except(['status', 'page']), ['event_id' => $event->id])) }}"
                                            class="filter-status {{ empty($filters['status']) ? 'active' : '' }}">All</a>
                                        <a href="{{ route('showEventRegistrationUsers', array_merge(request()->except(['status', 'page']), ['event_id' => $event->id, 'status' => 'pending'])) }}"
                                            class="filter-status {{ isset($filters['status']) && $filters['status'] === 'pending' ? 'active' : '' }}">Pending</a>
                                        <a href="{{ route('showEventRegistrationUsers', array_merge(request()->except(['status', 'page']), ['event_id' => $event->id, 'status' => 'approved'])) }}"
                                            class="filter-status {{ isset($filters['status']) && $filters['status'] === 'approved' ? 'active' : '' }}">Approved</a>
                                        <a href="{{ route('showEventRegistrationUsers', array_merge(request()->except(['status', 'page']), ['event_id' => $event->id, 'status' => 'rejected'])) }}"
                                            class="filter-status {{ isset($filters['status']) && $filters['status'] === 'rejected' ? 'active' : '' }}">Rejected</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('showEventRegistrationUsers', ['event_id' => $event->id]) }}"
                                    class="btn btn-default">
                                    <i class="ico-undo"></i> Clear Filters
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="ico-search"></i> Apply Filters
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="ico-users"></i> Registered Users ({{ $users->total() }})
                    </h3>
                </div>
                <div class="panel-body">
                    @if ($users->count() > 0)
                        <form id="bulk-action-form">
                            <div class="bulk-actions">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Bulk Actions <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);" class="bulk-action" data-action="approve"><i
                                                    class="ico-checkmark"></i> Approve Selected</a></li>
                                        <li><a href="javascript:void(0);" class="bulk-action" data-action="reject"><i
                                                    class="ico-close"></i> Reject Selected</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="javascript:void(0);" class="bulk-action" data-action="delete"><i
                                                    class="ico-trash"></i> Delete Selected</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="checkbox-column">
                                                <input type="checkbox" id="select-all-checkbox">
                                            </th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Registration Form</th>
                                            <th class="status-column">Status</th>
                                            <th>Registered On</th>
                                            <th class="actions-column">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr class="{{ $user->is_new ? 'new-registration' : '' }}">
                                                <td class="checkbox-column">
                                                    <input type="checkbox" class="user-checkbox" name="user_ids[]"
                                                        value="{{ $user->id }}">
                                                </td>
                                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <a
                                                        href="{{ route('showRegistrationUsers', ['event_id' => $event->id, 'registration_id' => $user->registration_id]) }}">
                                                        {{ $user->registration->name }}
                                                    </a>
                                                </td>
                                                <td class="status-column">
                                                    <span class="user-status status-{{ $user->status }}">
                                                        {{ ucfirst($user->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                                                <td class="actions-column">
                                                    <div class="btn-group user-actions">
                                                        <button type="button"
                                                            class="btn btn-xs btn-default dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            Actions <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                            <li>
                                                                <a href="javascript:void(0);"
                                                                    data-href="{{ route('getUserDetails', ['event_id' => $event->id, 'user_id' => $user->id]) }}"
                                                                    class="loadModal view-user"
                                                                    data-user-id="{{ $user->id }}">
                                                                    <i class="ico-eye"></i> View Details
                                                                </a>
                                                            </li>
                                                            @if ($user->status !== 'approved')
                                                                <li>
                                                                    <a href="javascript:void(0);" class="update-status"
                                                                        data-user-id="{{ $user->id }}"
                                                                        data-status="approved"
                                                                        data-url="{{ route('updateUserStatus', ['event_id' => $event->id, 'user_id' => $user->id]) }}">
                                                                        <i class="ico-checkmark"></i> Approve
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if ($user->status !== 'rejected')
                                                                <li>
                                                                    <a href="javascript:void(0);" class="update-status"
                                                                        data-user-id="{{ $user->id }}"
                                                                        data-status="rejected"
                                                                        data-url="{{ route('updateUserStatus', ['event_id' => $event->id, 'user_id' => $user->id]) }}">
                                                                        <i class="ico-close"></i> Reject
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            <li class="divider"></li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="delete-user"
                                                                    data-user-id="{{ $user->id }}">
                                                                    <i class="ico-trash"></i> Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-md-12">
                                {{ $users->appends(request()->except('page'))->links() }}
                            </div>
                        </div>
                    @else
                        <div class="no-results">
                            <i class="ico-users"></i>
                            <h4>No users found</h4>
                            <p>
                                @if (!empty($filters))
                                    No users match your search criteria. <a
                                        href="{{ route('showEventRegistrationUsers', ['event_id' => $event->id]) }}">Clear
                                        filters</a>
                                @else
                                    No users have registered for this event yet.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- User Details Modal -->
    <div class="modal fade" id="user-details-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="ico-user"></i> User Details</h4>
                </div>
                <div class="modal-body">
                    <div class="user-details-content">
                        <div class="text-center">
                            <i class="ico-spinner ico-spin"></i> Loading...
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script>
        $(document).ready(function() {
            // Select all checkbox
            $('#select-all-checkbox').on('change', function() {
                $('.user-checkbox').prop('checked', $(this).prop('checked'));
            });

            // Bulk actions
            $('.bulk-action').on('click', function(e) {
                e.preventDefault();

                const action = $(this).data('action');
                const selectedUsers = $('.user-checkbox:checked');

                if (selectedUsers.length === 0) {
                    alert('Please select at least one user');
                    return;
                }

                let confirmMessage = '';

                switch (action) {
                    case 'approve':
                        confirmMessage = 'Are you sure you want to approve the selected users?';
                        break;
                    case 'reject':
                        confirmMessage = 'Are you sure you want to reject the selected users?';
                        break;
                    case 'delete':
                        confirmMessage =
                            'Are you sure you want to delete the selected users? This action cannot be undone.';
                        break;
                }

                if (confirm(confirmMessage)) {
                    const userIds = [];
                    selectedUsers.each(function() {
                        userIds.push($(this).val());
                    });

                    $.ajax({
                        url: '{{ route('bulkUpdateUsers', ['event_id' => $event->id]) }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            user_ids: userIds,
                            action: action
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                alert(response.message);
                                window.location.reload();
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            alert('An error occurred. Please try again.');
                        }
                    });
                }
            });

            // Update user status
            $('.update-status').on('click', function(e) {
                e.preventDefault();

                const url = $(this).data('url');
                const status = $(this).data('status');

                let confirmMessage = '';

                switch (status) {
                    case 'approved':
                        confirmMessage = 'Are you sure you want to approve this user?';
                        break;
                    case 'rejected':
                        confirmMessage = 'Are you sure you want to reject this user?';
                        break;
                }

                if (confirm(confirmMessage)) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: status
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                alert(response.message);
                                window.location.reload();
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText); // خليها تطبع التفاصيل
                            alert('An error occurred. Please try again.');
                        }
                    });
                }
            });

            // Delete user
            $('.delete-user').on('click', function(e) {
                e.preventDefault();

                const userId = $(this).data('user-id');

                if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                    let url =
                        '{{ route('deleteUser', ['event_id' => $event->id, 'user_id' => '__USER_ID__']) }}';
                    url = url.replace('__USER_ID__', userId);
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                alert(response.message);
                                window.location.reload();
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            alert('An error occurred. Please try again.');
                        }
                    });
                }
            });

            // View user details
            // $('.view-user').on('click', function(e) {
            //     e.preventDefault();

            //     const userId = $(this).data('user-id');
            //     const modal = $('#user-details-modal');

            //     // Show modal with loading indicator
            //     modal.modal('show');

            //     // Load user details via AJAX
            //     let url =
            //         '{{ route('getUserDetails', ['event_id' => $event->id, 'user_id' => '__USER_ID__']) }}';
            //     url = url.replace('__USER_ID__', userId);
            //     $.ajax({
            //         url: url,
            //         type: 'GET',
            //         success: function(response) {
            //             modal.find('.user-details-content').html(response);
            //         },
            //         error: function(xhr) {
            //             console.error(xhr);
            //             modal.find('.user-details-content').html(
            //                 '<div class="alert alert-danger">Failed to load user details</div>'
            //                 );
            //         }
            //     });
            // });
        });
    </script>
@stop
