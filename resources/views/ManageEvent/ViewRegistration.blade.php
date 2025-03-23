{{-- resources/views/ManageEvent/RegistrationDetails.blade.php --}}
@extends('Shared.Layouts.Master')

@section('title')
    @parent
    Registration Details: {{ $registration->name }}
@stop

@section('top_nav')
    @include('ManageEvent.Partials.TopNav')
@stop

@section('page_title')
    <i class="ico-file-text mr5"></i>
    Registration Details: {{ $registration->name }}
@stop

@section('head')
    <style>
        .registration-header {
            margin-bottom: 20px;
        }

        .registration-image {
            max-width: 150px;
            max-height: 150px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-active {
            background-color: #28a745;
            color: white;
        }

        .status-inactive {
            background-color: #dc3545;
            color: white;
        }

        .approval-automatic {
            background-color: #28a745;
            color: white;
        }

        .approval-manual {
            background-color: #ffc107;
            color: black;
        }

        .panel-heading {
            background-color: #f8f8f8;
            border-bottom: 1px solid #eee;
        }

        .panel-title {
            font-size: 16px;
            font-weight: 600;
        }

        .action-buttons {
            margin-bottom: 20px;
        }

        .action-buttons .btn {
            margin-right: 5px;
        }

        .table-responsive {
            border: none;
        }

        .user-status-approved {
            background-color: #28a745;
            color: white;
        }

        .user-status-pending {
            background-color: #ffc107;
            color: black;
        }

        .user-status-rejected {
            background-color: #dc3545;
            color: white;
        }

        .stats-box {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #eee;
        }

        .stats-box h4 {
            margin-top: 0;
            color: #555;
        }

        .stats-box .number {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }

        .stats-box .text-muted {
            color: #777;
            font-size: 12px;
        }
    </style>
@stop

@section('menu')
    @include('ManageEvent.Partials.Sidebar')
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="action-buttons">
                <a href="{{ route('showEventRegistration', ['event_id' => $registration->event_id]) }}" class="btn btn-default">
                    <i class="ico-arrow-left"></i> Back to Registrations
                </a>
                <a href="javascript:void(0);" data-modal-id="EditRegistration"
                   data-href="{{ route('showEditEventRegistration', ['event_id' => $registration->event_id, 'registration_id' => $registration->id]) }}"
                   class="loadModal btn btn-primary">
                    <i class="ico-edit"></i> Edit Registration
                </a>
                {{-- <a href="{{ route('showManageFormFields', ['event_id' => $registration->event_id, 'registration_id' => $registration->id]) }}" class="btn btn-success">
                    <i class="ico-list"></i> Manage Form Fields
                </a> --}}
                <a href="javascript:void(0);" data-modal-id="DeleteRegistration"
                   data-href="{{ route('showDeleteEventRegistration', ['event_id' => $registration->event_id, 'registration_id' => $registration->id]) }}"
                   class="loadModal btn btn-danger">
                    <i class="ico-trash"></i> Delete Registration
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="ico-info"></i> Basic Information
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="text-center registration-header">
                        @if($registration->image)
                            <img src="{{ asset('storage/' . $registration->image) }}" alt="{{ $registration->name }}" class="registration-image">
                        @else
                            <div style="width: 150px; height: 150px; background-color: #eee; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 10px; border-radius: 5px;">
                                <i class="ico-file-text" style="font-size: 50px; color: #aaa;"></i>
                            </div>
                        @endif
                        <h3>{{ $registration->name }}</h3>
                        <div>
                            <span class="status-badge {{ $registration->status == 'active' ? 'status-active' : 'status-inactive' }}">
                                {{ ucfirst($registration->status) }}
                            </span>
                            <span class="status-badge approval-{{ $registration->approval_status }}">
                                {{ ucfirst($registration->approval_status) }} Approval
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="stats-box">
                                <h4>Participants</h4>
                                <div class="number">{{ $registration->registrationUsers->count() }}</div>
                                <div class="text-muted">
                                    @if($registration->max_participants)
                                        of {{ $registration->max_participants }} maximum
                                    @else
                                        No limit set
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="stats-box">
                                <h4>Form Fields</h4>
                                <div class="number">{{ $registration->dynamicFormFields->count() }}</div>
                                <div class="text-muted">
                                    {{ $registration->dynamicFormFields->where('is_required', true)->count() }} required fields
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Category</th>
                                <td>{{ $registration->category->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Start Date</th>
                                <td>{{ $registration->start_date }}</td>
                            </tr>
                            <tr>
                                <th>End Date</th>
                                <td>{{ $registration->end_date }}</td>
                            </tr>
                            <tr>
                                <th>Created</th>
                                <td>{{ $registration->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $registration->updated_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="ico-list"></i> Form Fields
                    </h3>
                </div>
                <div class="panel-body">
                    @if($registration->dynamicFormFields->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Label</th>
                                        <th>Type</th>
                                        <th>Required</th>
                                        <th>Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registration->dynamicFormFields as $field)
                                        <tr>
                                            <td>{{ $field->label }}</td>
                                            <td>{{ ucfirst($field->type) }}</td>
                                            <td>
                                                @if($field->is_required)
                                                    <span class="label label-success">Yes</span>
                                                @else
                                                    <span class="label label-default">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($field->is_active)
                                                    <span class="label label-success">Yes</span>
                                                @else
                                                    <span class="label label-default">No</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="ico-info-circle"></i> No form fields found.
                        </div>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="ico-users"></i> Registered Users
                    </h3>
                </div>
                <div class="panel-body">
                    @if($registration->registrationUsers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Registered On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registration->registrationUsers as $user)
                                        <tr>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone ?? 'N/A' }}</td>
                                            <td>
                                                <span class="label user-status-{{ $user->status }}">
                                                    {{ ucfirst($user->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                                                        Actions <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            <a href="javascript:void(0);">
                                                                <i class="ico-eye"></i> View Details
                                                            </a>
                                                        </li>
                                                        @if($user->status === 'pending')
                                                            <li>
                                                                <a href="javascript:void(0);">
                                                                    <i class="ico-checkmark"></i> Approve
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);">
                                                                    <i class="ico-close"></i> Reject
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li class="divider"></li>
                                                        <li>
                                                            <a href="javascript:void(0);" class="text-danger">
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
                    @else
                        <div class="alert alert-info">
                            <i class="ico-info-circle"></i> No users registered yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script>
        $(document).ready(function() {
            // Any additional JavaScript can go here
        });
    </script>
@stop