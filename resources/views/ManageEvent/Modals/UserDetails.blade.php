{{-- resources/views/ManageEvent/Partials/UserDetailsModal.blade.php --}}
<div class="user-profile">
    <div class="row">
        <div class="col-md-12 text-center">
            <div style="font-size: 60px; color: #ccc; margin-bottom: 10px;">
                <i class="ico-user"></i>
            </div>
            <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
            <p class="text-muted">
                Registered on {{ $user->created_at->format('M d, Y H:i') }}
            </p>
            <span class="user-status status-{{ $user->status }}">
                {{ ucfirst($user->status) }}
            </span>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <h4><i class="ico-info"></i> Basic Information</h4>

            <div class="user-details">
                <strong>Email:</strong> {{ $user->email }}
            </div>

            <div class="user-details">
                <strong>Phone:</strong> {{ $user->phone ?? 'Not provided' }}
            </div>

            <div class="user-details">
                <strong>Registration:</strong> {{ $user->registration->name }}
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <h4><i class="ico-list"></i> Form Responses</h4>

            @if($user->formResponses->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Response</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->formResponses as $response)
                                <tr>
                                    <td>{{ $response->field->label }}</td>
                                    <td>
                                        @if($response->field->type == 'file')
                                            @if($response->value)
                                                <a href="{{ asset('storage/' . $response->value) }}" target="_blank">View File</a>
                                            @else
                                                No file uploaded
                                            @endif
                                        @elseif($response->field->type == 'checkbox' || $response->field->type == 'radio')
                                            {{ $response->value ?? 'No selection' }}
                                        @else
                                            {{ $response->value ?? 'No response' }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="ico-info-circle"></i> No form responses found.
                </div>
            @endif
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="btn-group btn-group-justified">
                @if($user->status !== 'approved')
                    <a href="javascript:void(0);" class="btn btn-success update-status-modal" data-user-id="{{ $user->id }}" data-status="approved">
                        <i class="ico-checkmark"></i> Approve
                    </a>
                @endif

                @if($user->status !== 'rejected')
                    <a href="javascript:void(0);" class="btn btn-warning update-status-modal" data-user-id="{{ $user->id }}" data-status="rejected">
                        <i class="ico-close"></i> Reject
                    </a>
                @endif

                <a href="javascript:void(0);" class="btn btn-danger delete-user-modal" data-user-id="{{ $user->id }}">
                    <i class="ico-trash"></i> Delete
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Handle status update from modal
    $('.update-status-modal').on('click', function(e) {
        e.preventDefault();

        const userId = $(this).data('user-id');
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
                url: '{{ route('updateUserStatus', ['event_id' => $user->registration->event_id, 'registration_id' => $user->registration_id, 'user_id' => '']) }}' + userId,
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
                    console.error(xhr);
                    alert('An error occurred. Please try again.');
                }
            });
        }
    });

    // Handle delete from modal
    $('.delete-user-modal').on('click', function(e) {
        e.preventDefault();

        const userId = $(this).data('user-id');

        if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
            $.ajax({
                url: '{{ route('deleteUser', ['event_id' => $user->registration->event_id, 'registration_id' => $user->registration_id, 'user_id' => '']) }}' + userId,
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
</script>

## 3. Update Registration Table to Include Users Button

```blade type="code"
{{-- Update the Registration.blade.php file to include a button to view users --}}
<td>
    <a href="{{ route('showRegistrationUsers', ['event_id' => $event->id, 'registration_id' => $reg->id]) }}" class="btn btn-xs btn-info">
        <i class="ico-users"></i> {{ $reg->users_count }} Users
    </a>
</td>