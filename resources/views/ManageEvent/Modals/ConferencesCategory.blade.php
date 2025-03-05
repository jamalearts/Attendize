<div role="dialog" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">
                    Show Conferences for : {{ $category->name }}
                </h3>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        @if($category->conferences)
                            <div class="conferences-grid">
                                <div class="row">
                                    @foreach($category->conferences as $conference)
                                        <div class="col-md-4 mb-4 mt-1">
                                            <div class="conference-card">
                                                 {{-- href="{{ route('conference.show', ['event_id' => $event->id, 'conference_id' => $conference->id]) }}" --}}
                                                 <a
                                                 class="conference-link">
                                                    <div class="card h-100 shadow-sm hover-shadow">
                                                        <div class="card-body">
                                                            <div class="conference-icon text-center mb-3">
                                                                <i class="ico-users text-primary" style="font-size: 45px"></i>
                                                            </div>
                                                            <h4 class="card-title text-center">{{ $conference->name }}</h4>
                                                            <div class="text-center mt-3">
                                                                <span class="btn btn-sm btn-outline-primary">View Details</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <p class="mb-0 text-center">No conferences found for this category.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                {!! Form::button(trans("ManageEvent.close"), ['class'=>"btn modal-close btn-danger",'data-dismiss'=>'modal']) !!}
            </div>

            <style>
                .conference-link {
                    text-decoration: none;
                    color: inherit;
                }

                .conference-card .card {
                    transition: all 0.3s ease;
                    border-radius: 8px;
                    border: 1px solid rgba(0,0,0,0.1);
                }

                .conference-card .card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
                    border-color: #007bff;
                }

                .conference-icon {
                    height: 60px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .hover-shadow:hover {
                    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
                }

                .modal-lg {
                    max-width: 800px;
                }

                .category-description {
                    padding: 10px;
                    background-color: #f8f9fa;
                    border-radius: 5px;
                    margin-bottom: 20px;
                }
            </style>
        </div><!-- /end modal content-->
    </div>
</div>
