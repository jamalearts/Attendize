<section id="registrations" class="container py-5">
    <div class="row">
        <h1 class='section_head'>
            Upcoming Events
        </h1>
        {{-- <p class="text-muted">Discover and register for exciting events in your area</p> --}}
    </div>
    <div class="section-header mb-4">
        <h2 class="fw-bold"></h2>
    </div>

    <div class="row g-4">
        @if ($event->registrations->count() > 0 && $event->end_date->isPast() == false)
            @foreach ($event->registrations as $registration)
              @if($registration->end_date > now())
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card registration-card h-100 border-0 shadow-sm">
                        <!-- Image -->
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                            style="height: 200px;">
                            @if ($registration->image)
                                <img src="{{ asset('storage/' . $registration->image) }}"
                                    class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $registration->name }}">
                            @else
                                <div class="reg-title">{{ $registration->name }}</div>
                            @endif
                        </div>

                        <div class="card-body p-4">
                            <!-- Title -->
                            <h5 class="card-title fw-bold mb-2 reg-title">{{ $registration->name }}</h5>

                            <!-- Category -->
                            @if ($registration->category)
                                <div class="parent-category-badge">
                                    <p class="category-badge small mb-2">{{ $registration->category->name }}</p>
                                </div>
                            @endif


                            <!-- Description -->
                            <p class="card-text text-muted small mb-4">
                                {{ Str::limit($registration->descriptionid ?? '', 100) }}
                            </p>

                            <!-- Register Button -->
                            <a href="{{ route('showEventRegistrationForm', ['event_id' => $event->id, 'event_slug' => $event->slug, 'registration_id' => $registration->id]) }}"
                                class="btn btn-primary w-100">
                                Register Now
                            </a>

                        </div>
                    </div>
                </div>
                @else
                <div class="col-12">
                    <div class="alert alert-info">
                        No upcoming events available at this time.
                    </div>
                </div>
              @endif
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">
                    No upcoming events available at this time.
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Add this CSS to your stylesheet -->
<style>
    .registration-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border-radius: 8px;
        overflow: hidden;
    }

    .registration-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .btn-primary {
        background-color: #5829bc;
        border-color: #5829bc;
        color: white;
        border-radius: 4px;
        padding: 8px 16px;
        font-weight: 500;
    }

    .object-fit-cover {
        object-fit: cover;
    }

    .parent-category-badge {
        display: flex;
        justify-content: center;
    }

    .category-badge {
        font-weight: 500;
        color: #000;
        background: #5829bc49;
        width: fit-content;
        padding: 5px 10px;
        border-radius: 4px;
    }

    .section-header h2 {
        font-size: 1.8rem;
    }

    .section-header p {
        font-size: 1rem;
    }

    .w-100 {
        width: 100%;
    }

    .h-100 {
        height: 100%;
    }

    .reg-title {
        text-align: center;
        font-size: 2rem;
        font-weight: 600;
    }
</style>
