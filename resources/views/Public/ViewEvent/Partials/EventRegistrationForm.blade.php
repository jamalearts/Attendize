{{-- Public/ViewEvent/RegistrationForm.blade.php --}}
@extends('Public.ViewEvent.Layouts.EventPage')

@section('head')
    @include('Public.ViewEvent.Partials.GoogleTagManager')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">

    <style>
        .registration-form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #5829bc;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(88, 41, 188, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        .required-label::after {
            content: '*';
            color: #dc3545;
            margin-left: 4px;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 6px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #5829bc;
            box-shadow: 0 0 0 0.2rem rgba(88, 41, 188, 0.25);
        }

        .form-select {
            border: 1px solid #ced4da;
            border-radius: 6px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
            background-position: right 15px center;
        }

        .form-select:focus {
            border-color: #5829bc;
            box-shadow: 0 0 0 0.2rem rgba(88, 41, 188, 0.25);
        }

        .btn-submit {
            background-color: #5829bc;
            border-color: #5829bc;
            color: white;
            border-radius: 6px;
            padding: 12px 25px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .btn-submit:hover {
            background-color: #4a1fa8;
            border-color: #4a1fa8;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(88, 41, 188, 0.3);
        }

        .registration-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .registration-info {
            flex: 1;
            min-width: 300px;
        }

        .registration-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .registration-subtitle {
            font-size: 1.1rem;
            color: #666;
        }

        .category-badge {
            font-weight: 500;
            color: #5829bc;
            background: rgba(88, 41, 188, 0.1);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 15px;
        }

        /* Compact Countdown Timer */
        .countdown-container {
            background-color: rgba(88, 41, 188, 0.05);
            border-radius: 8px;
            padding: 15px;
            margin-left: 20px;
            min-width: 200px;
            text-align: center;
        }

        .countdown-label {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 10px;
        }

        .countdown-timer {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .timer-block {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 5px;
        }

        .timer-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: #5829bc;
            background: white;
            border-radius: 6px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .timer-label {
            font-size: 0.7rem;
            color: #666;
            margin-top: 5px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -10px;
            margin-left: -10px;
        }

        .form-col {
            flex: 0 0 50%;
            max-width: 50%;
            padding-right: 10px;
            padding-left: 10px;
        }

        @media (max-width: 767.98px) {
            .form-col {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .registration-header {
                flex-direction: column;
            }

            .countdown-container {
                margin-left: 0;
                margin-top: 20px;
                width: 100%;
            }

            .fee-card {
                margin-top: 20px;
            }
        }

        /* Price update animation */
        @keyframes priceUpdate {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .price-updated {
            animation: priceUpdate 0.5s ease;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .is-invalid+.invalid-feedback {
            display: block;
        }

        /* New Fee Card Styles */
        .fee-card {
            background: linear-gradient(135deg, #6e45e2 0%, #5829bc 100%);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            color: white;
            box-shadow: 0 10px 20px rgba(88, 41, 188, 0.2);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .fee-card-hidden {
            height: 0;
            padding: 0;
            margin: 0;
            opacity: 0;
        }

        .fee-card-visible {
            height: auto;
            opacity: 1;
        }

        .fee-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
            pointer-events: none;
        }

        .fee-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .fee-card-title {
            font-size: 1.1rem;
            font-weight: 500;
            margin: 0;
        }

        .fee-card-conference {
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0 0 15px 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .fee-card-amount {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0;
            line-height: 1;
        }

        .fee-card-details {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-top: 5px;
        }

        .fee-card-icon {
            position: absolute;
            bottom: 20px;
            right: 20px;
            font-size: 4rem;
            opacity: 0.2;
        }

        .fee-card-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
    </style>
@endsection

@section('content')
    @include('Public.ViewEvent.Partials.EventHeaderSection')

    <section class="container py-5">
        <div class="registration-form-container">
            <div class="registration-header">
                <div class="registration-info">
                    <h1 class="registration-title">{{ $registration->name }}</h1>
                    @if ($registration->category)
                        <div>
                            <span class="category-badge">{{ $registration->category->name }}</span>
                        </div>
                    @endif
                    <p class="registration-subtitle">{{ $event->title }}</p>
                </div>

                <!-- Compact Countdown Timer -->
                <div class="countdown-container">
                    <div class="countdown-label">Registration closes in:</div>
                    <div class="countdown-timer" data-end="{{ $registration->end_date }}">
                        <div class="timer-block">
                            <span class="timer-value days">00</span>
                            <span class="timer-label">Days</span>
                        </div>
                        <div class="timer-block">
                            <span class="timer-value hours">00</span>
                            <span class="timer-label">Hours</span>
                        </div>
                        <div class="timer-block">
                            <span class="timer-value minutes">00</span>
                            <span class="timer-label">Mins</span>
                        </div>
                        <div class="timer-block">
                            <span class="timer-value seconds">00</span>
                            <span class="timer-label">Secs</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Fee Card - Initially Hidden -->
            <div id="fee-card" class="fee-card fee-card-hidden">
                <div class="fee-card-badge">Selected Conference</div>
                <div class="fee-card-header">
                    <h4 class="fee-card-title">Registration Fee</h4>
                </div>
                <h3 id="fee-card-conference" class="fee-card-conference">Conference Name</h3>
                <h2 id="fee-card-amount" class="fee-card-amount">$0.00</h2>
                <p class="fee-card-details">This fee includes all conference materials and access to all sessions.</p>
                <div class="fee-card-icon">
                    <i class="fa fa-ticket"></i>
                </div>
            </div>

            <form method="POST"
                action="{{ route('postEventRegistration', ['event_id' => $event->id, 'registration_id' => $registration->id]) }}"
                enctype="multipart/form-data">
                @csrf

                <!-- Single Form Section with All Fields -->
                <div class="form-section">
                    <h3 class="form-section-title">Registration Information</h3>

                    <!-- Personal Information -->
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="first_name" class="form-label required-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label for="last_name" class="form-label required-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="email" class="form-label required-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                        </div>
                    </div>

                    <!-- Conference Selection (if applicable) -->
                    @if (
                        $registration->category &&
                            $registration->category->conferences &&
                            $registration->category->conferences->count() > 0)
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="conference_id" class="form-label required-label">Select Conference</label>
                                    <select class="form-select" id="conference_id" name="conference_id" style="width: 100%" required>
                                        <option value="">-- Loading Conferences... --</option>
                                    </select>
                                    <div class="invalid-feedback" id="conference-error">
                                        Please select a conference.
                                    </div>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="profession_id" class="form-label required-label">Profession</label>
                                    <select class="form-select" id="profession_id" name="profession_id" style="width: 100%" required disabled>
                                        <option value="">-- Select Profession --</option>
                                    </select>
                                    <div class="invalid-feedback" id="profession-error">
                                        Please select a profession.
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Dynamic Form Fields -->
                    @if ($registration->dynamicFormFields && $registration->dynamicFormFields->count() > 0)
                        @foreach ($registration->dynamicFormFields as $field)
                            <div class="form-group">
                                <label for="field_{{ $field->id }}"
                                    class="form-label {{ $field->is_required ? 'required-label' : '' }}">{{ $field->label }}</label>

                                @if ($field->type == 'text')
                                    <input type="text" class="form-control" id="field_{{ $field->id }}"
                                        name="fields[{{ $field->id }}]" {{ $field->is_required ? 'required' : '' }}>
                                @elseif($field->type == 'email')
                                    <input type="email" class="form-control" id="field_{{ $field->id }}"
                                        name="fields[{{ $field->id }}]" {{ $field->is_required ? 'required' : '' }}>
                                @elseif($field->type == 'tel')
                                    <input type="tel" class="form-control" id="field_{{ $field->id }}"
                                        name="fields[{{ $field->id }}]" {{ $field->is_required ? 'required' : '' }}>
                                @elseif($field->type == 'number')
                                    <input type="number" class="form-control" id="field_{{ $field->id }}"
                                        name="fields[{{ $field->id }}]" {{ $field->is_required ? 'required' : '' }}>
                                @elseif($field->type == 'textarea')
                                    <textarea class="form-control" id="field_{{ $field->id }}" name="fields[{{ $field->id }}]" rows="3"
                                        {{ $field->is_required ? 'required' : '' }}></textarea>
                                @elseif($field->type == 'select')
                                    <select class="form-select" id="field_{{ $field->id }}"
                                        name="fields[{{ $field->id }}]" {{ $field->is_required ? 'required' : '' }}>
                                        <option value="">-- Select Option --</option>
                                        @foreach (explode(',', $field->options) as $option)
                                            <option value="{{ trim($option) }}">{{ trim($option) }}</option>
                                        @endforeach
                                    </select>
                                @elseif($field->type == 'checkbox')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="field_{{ $field->id }}"
                                            name="fields[{{ $field->id }}]" value="1"
                                            {{ $field->is_required ? 'required' : '' }}>
                                        <label class="form-check-label"
                                            for="field_{{ $field->id }}">{{ $field->description }}</label>
                                    </div>
                                @elseif($field->type == 'radio')
                                    @foreach (explode(',', $field->options) as $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                name="fields[{{ $field->id }}]"
                                                id="field_{{ $field->id }}_{{ $loop->index }}"
                                                value="{{ trim($option) }}" {{ $field->is_required ? 'required' : '' }}>
                                            <label class="form-check-label"
                                                for="field_{{ $field->id }}_{{ $loop->index }}">{{ trim($option) }}</label>
                                        </div>
                                    @endforeach
                                @elseif($field->type == 'date')
                                    <input type="date" class="form-control" id="field_{{ $field->id }}"
                                        name="fields[{{ $field->id }}]" {{ $field->is_required ? 'required' : '' }}>
                                @elseif($field->type == 'file')
                                    <input type="file" class="form-control" id="field_{{ $field->id }}"
                                        name="fields[{{ $field->id }}]" {{ $field->is_required ? 'required' : '' }}>
                                    @if ($field->description)
                                        <small class="form-text text-muted">{{ $field->description }}</small>
                                    @endif
                                @endif

                                @if ($field->description && $field->type != 'checkbox' && $field->type != 'file')
                                    <small class="form-text text-muted">{{ $field->description }}</small>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-submit">Complete Registration</button>
                </div>
            </form>
        </div>
    </section>

    @include('Public.ViewEvent.Partials.EventFooterSection')

        <!-- Add toast notifications inline -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            $(document).ready(function() {
                // Configure Toastr
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                @if(session('error'))
                    toastr.error("{{ session('error') }}", "Error");
                @endif

            });
        </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize countdown timer
            initCountdownTimer();

            // Load conferences via AJAX
            if (document.getElementById('conference_id')) {
                loadConferences();
            }
        });

        function initCountdownTimer() {
            const countdownTimer = document.querySelector('.countdown-timer');
            if (!countdownTimer) return;

            const endDate = new Date(countdownTimer.dataset.end).getTime();

            // Update the countdown every second
            const countdownInterval = setInterval(function() {
                // Get current date and time
                const now = new Date().getTime();

                // Calculate the time remaining
                const distance = endDate - now;

                // Calculate days, hours, minutes, and seconds
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Update the timer display
                countdownTimer.querySelector('.days').textContent = days.toString().padStart(2, '0');
                countdownTimer.querySelector('.hours').textContent = hours.toString().padStart(2, '0');
                countdownTimer.querySelector('.minutes').textContent = minutes.toString().padStart(2, '0');
                countdownTimer.querySelector('.seconds').textContent = seconds.toString().padStart(2, '0');

                // If the countdown is finished, display expired message
                if (distance < 0) {
                    clearInterval(countdownInterval);
                    const container = countdownTimer.closest('.countdown-container');
                    if (container) {
                        container.innerHTML =
                        '<div class="alert alert-warning">Registration period has ended</div>';
                    }
                }
            }, 1000);
        }

        // Load conferences via AJAX
        function loadConferences() {
            const conferenceSelect = document.getElementById('conference_id');
            const categoryId = {{ $registration->category_id ?? 'null' }};

            if (!conferenceSelect || !categoryId) return;

            // Show loading state
            conferenceSelect.innerHTML = '<option value="">-- Loading Conferences... --</option>';
            conferenceSelect.disabled = true;

            // Fetch conferences for this category
            fetch(`/e/api/categories/${categoryId}/conferences`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Clear loading option
                    conferenceSelect.innerHTML = '<option value="">-- Select Conference --</option>';

                    if (data.conferences && data.conferences.length > 0) {
                        data.conferences.forEach(conference => {
                            // Format the price to 2 decimal places
                            const formattedPrice = parseFloat(conference.price).toFixed(2);

                            // Include the price in the option text
                            const optionText = `${conference.name} - $${formattedPrice}`;

                            const option = new Option(optionText, conference.id);
                            option.dataset.price = conference.price;
                            option.dataset.name = conference.name;
                            conferenceSelect.add(option);
                        });

                        // Enable the select
                        conferenceSelect.disabled = false;

                        // Add change event listener
                        conferenceSelect.addEventListener('change', function() {
                            loadProfessions(this.value);
                            updateFeeCard();
                        });
                    } else {
                        conferenceSelect.innerHTML = '<option value="">No conferences available</option>';
                        document.getElementById('conference-error').textContent =
                            'No conferences are currently available for this registration.';
                        conferenceSelect.classList.add('is-invalid');
                    }
                })
                .catch(error => {
                    console.error('Error loading conferences:', error);
                    conferenceSelect.innerHTML = '<option value="">Error loading conferences</option>';
                    document.getElementById('conference-error').textContent =
                        'Failed to load conferences. Please try again later.';
                    conferenceSelect.classList.add('is-invalid');
                });
        }

        // Load professions via AJAX
        function loadProfessions(conferenceId) {
            const professionSelect = document.getElementById('profession_id');

            if (!professionSelect || !conferenceId) {
                professionSelect.disabled = true;
                professionSelect.innerHTML = '<option value="">-- Select Profession --</option>';
                return;
            }

            // Show loading state
            professionSelect.innerHTML = '<option value="">-- Loading Professions... --</option>';
            professionSelect.disabled = true;

            // Fetch professions for the selected conference
            fetch(`/e/api/conferences/${conferenceId}/professions`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Clear loading option
                    professionSelect.innerHTML = '<option value="">-- Select Profession --</option>';

                    if (data.professions && data.professions.length > 0) {
                        data.professions.forEach(profession => {
                            const option = new Option(profession.name, profession.id);
                            professionSelect.add(option);
                        });

                        // Enable the select
                        professionSelect.disabled = false;
                        professionSelect.classList.remove('is-invalid');
                    } else {
                        professionSelect.innerHTML = '<option value="">No professions available</option>';
                        document.getElementById('profession-error').textContent =
                            'No professions are available for this conference.';
                        professionSelect.classList.add('is-invalid');
                    }
                })
                .catch(error => {
                    console.error('Error loading professions:', error);
                    professionSelect.innerHTML = '<option value="">Error loading professions</option>';
                    document.getElementById('profession-error').textContent =
                        'Failed to load professions. Please try again later.';
                    professionSelect.classList.add('is-invalid');
                });
        }

        // Update the fee card with selected conference details
        function updateFeeCard() {
            const conferenceSelect = document.getElementById('conference_id');
            const feeCard = document.getElementById('fee-card');
            const feeCardConference = document.getElementById('fee-card-conference');
            const feeCardAmount = document.getElementById('fee-card-amount');

            if (!conferenceSelect || !feeCard || !feeCardConference || !feeCardAmount) return;

            const selectedOption = conferenceSelect.options[conferenceSelect.selectedIndex];

            if (selectedOption && selectedOption.value) {
                const price = selectedOption.dataset.price || 0;
                const conferenceName = selectedOption.dataset.name || 'Selected Conference';

                // Update the fee card content
                feeCardConference.textContent = conferenceName;
                feeCardAmount.textContent = `$${parseFloat(price).toFixed(2)}`;

                // Show the fee card with animation
                feeCard.classList.remove('fee-card-hidden');
                feeCard.classList.add('fee-card-visible');

                // Add animation effect
                feeCardAmount.classList.add('price-updated');
                setTimeout(() => {
                    feeCardAmount.classList.remove('price-updated');
                }, 500);

                // Scroll to the fee card if it's not in view
                const rect = feeCard.getBoundingClientRect();
                if (rect.top < 0 || rect.bottom > window.innerHeight) {
                    feeCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                // Hide the fee card if no conference is selected
                feeCard.classList.remove('fee-card-visible');
                feeCard.classList.add('fee-card-hidden');
            }
        }
    </script>
@endsection
