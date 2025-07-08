@extends('layout_inner_page')

@section('title')
    <title>{{ html_decode($course->title) }} - {{ __('translate.Course Details') }}</title>
    <meta name="title" content="{{ $course->seo_title }}">
    <meta name="description" content="{{ $course->seo_description }}">
@endsection

@section('front-content')

    <!-- Course Details Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    
                    <!-- Course Header -->
                    <div class="course-header mb-5">
                        <div class="text-center mb-4">
                            <span class="badge bg-secondary mb-2">{{ $course?->category?->name }}</span>
                            <h1 class="display-5 fw-bold text-dark mb-3">{{ html_decode($course?->title) }}</h1>
                        </div>
                        
                        <!-- Instructor Info -->
                        <div class="instructor-info d-flex align-items-center justify-content-center mb-4">
                            @if ($instructor?->image)
                                <img src="{{ asset($instructor?->image) }}" alt="{{ html_decode($instructor?->name) }}" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;" />
                            @else
                                <img src="{{ asset($general_setting->default_avatar) }}" alt="{{ html_decode($instructor?->name) }}" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;" />
                            @endif
                            <div>
                                <h5 class="mb-1 text-primary">{{ html_decode($instructor?->name) }}</h5>
                                <small class="text-muted">{{ __('translate.Created') }}: {{ $course->created_at->format('d M, Y') }}</small>
                            </div>
                        </div>

                        <!-- Course Image -->
                        <div class="course-image text-center mb-4">
                            <img src="{{ asset($course?->thumb_image) }}" alt="{{ html_decode($course?->title) }}" class="img-fluid rounded shadow" style="max-height: 350px;">
                        </div>

                        <!-- Course Meta Info -->
                        <div class="course-meta">
                            <div class="row text-center">
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="p-3 bg-light rounded">
                                        <i class="fas fa-signal text-primary fs-4 mb-2"></i>
                                        <div class="fw-semibold">{{ __('translate.Level') }}</div>
                                        <small class="text-muted">{{ $course?->course_level?->name }}</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="p-3 bg-light rounded">
                                        <i class="fas fa-globe text-success fs-4 mb-2"></i>
                                        <div class="fw-semibold">{{ __('translate.Language') }}</div>
                                        <small class="text-muted">{{ $course?->course_language?->name }}</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="p-3 bg-light rounded">
                                        <i class="fas fa-play-circle text-info fs-4 mb-2"></i>
                                        <div class="fw-semibold">{{ __('translate.Lessons') }}</div>
                                        <small class="text-muted">{{ html_decode($course->total_lesson) }} {{ __('translate.Lessons') }}</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="p-3 bg-light rounded">
                                        <i class="fas fa-clock text-warning fs-4 mb-2"></i>
                                        <div class="fw-semibold">{{ __('translate.Duration') }}</div>
                                        <small class="text-muted">{{ html_decode($course->total_duration) }} {{ __('translate.Hour') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Content Tabs -->
                    <div class="course-content">
                        <ul class="nav nav-pills nav-fill mb-4" id="courseTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="pill" data-bs-target="#description" type="button" role="tab">
                                    <i class="fas fa-info-circle me-2"></i>{{ __('translate.Overview') }}
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="content-tab" data-bs-toggle="pill" data-bs-target="#content" type="button" role="tab">
                                    <i class="fas fa-list me-2"></i>{{ __('translate.Content') }}
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="instructor-details-tab" data-bs-toggle="pill" data-bs-target="#instructor-details" type="button" role="tab">
                                    <i class="fas fa-user me-2"></i>{{ __('translate.Instructor') }}
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="courseTabContent">
                            <!-- Description Tab -->
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <h4 class="card-title mb-0"><i class="fas fa-book-open me-2"></i>{{ __('translate.Courses Descriptions') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="course-description">
                                            {!! clean(html_decode($course->description), 'iframe_allowed') !!}
                                        </div>
                                        
                                        @if($course->short_description)
                                            <div class="mt-4 p-3 bg-light rounded">
                                                <h6 class="text-muted mb-2">{{ __('translate.Short Description') }}</h6>
                                                <p class="mb-0">{{ html_decode($course->short_description) }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Content Tab -->
                            <div class="tab-pane fade" id="content" role="tabpanel">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-success text-white">
                                        <h4 class="card-title mb-0"><i class="fas fa-list-ul me-2"></i>{{ __('translate.Course Content') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        @if($course_modules->count() > 0)
                                            <div class="accordion" id="courseModules">
                                                @foreach ($course_modules as $module_index => $course_module)
                                                    <div class="accordion-item mb-3">
                                                        <h2 class="accordion-header" id="module-{{ $course_module->id }}">
                                                            <button class="accordion-button {{ $module_index != 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $course_module->id }}">
                                                                <div class="d-flex w-100 justify-content-between align-items-center pe-3">
                                                                    <span><i class="fas fa-folder me-2"></i>{{ html_decode($course_module?->name) }}</span>
                                                                    <span class="badge bg-primary">{{ count($course_module->lessons ?? []) }} {{ __('translate.Lessons') }}</span>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse-{{ $course_module->id }}" class="accordion-collapse collapse {{ $module_index == 0 ? 'show' : '' }}">
                                                            <div class="accordion-body">
                                                                @forelse ($course_module->lessons ?? [] as $lesson_index => $lesson)
                                                                    <div class="lesson-item d-flex align-items-center py-3 border-bottom">
                                                                        <div class="lesson-number me-3">
                                                                            <span class="badge bg-secondary rounded-pill">{{ $lesson_index + 1 }}</span>
                                                                        </div>
                                                                        <div class="lesson-content flex-grow-1">
                                                                            <h6 class="mb-1">{{ html_decode($lesson?->name) }}</h6>
                                                                            <small class="text-muted">
                                                                                <i class="fas fa-clock me-1"></i>{{ html_decode($lesson?->video_duration) }} {{ __('translate.minute') }}
                                                                                @if ($lesson?->is_public_lesson == 'disable')
                                                                                    <i class="fas fa-lock ms-2 text-warning"></i>
                                                                                @else
                                                                                    <i class="fas fa-play-circle ms-2 text-success"></i>
                                                                                @endif
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                    <div class="text-center py-4 text-muted">
                                                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                                                        <p>{{ __('translate.No lessons available') }}</p>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center py-5 text-muted">
                                                <i class="fas fa-folder-open fa-4x mb-3"></i>
                                                <h5>{{ __('translate.No modules available') }}</h5>
                                                <p>{{ __('translate.Course content will be available soon') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Instructor Details Tab -->
                            <div class="tab-pane fade" id="instructor-details" role="tabpanel">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-info text-white">
                                        <h4 class="card-title mb-0"><i class="fas fa-chalkboard-teacher me-2"></i>{{ __('translate.About the Instructor') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 text-center mb-4">
                                                @if ($instructor?->image)
                                                    <img src="{{ asset($instructor?->image) }}" alt="{{ html_decode($instructor?->name) }}" class="img-fluid rounded-circle shadow" style="max-width: 200px;" />
                                                @else
                                                    <img src="{{ asset($general_setting->default_avatar) }}" alt="{{ html_decode($instructor?->name) }}" class="img-fluid rounded-circle shadow" style="max-width: 200px;" />
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <h3 class="text-primary mb-3">{{ html_decode($instructor?->name) }}</h3>
                                                
                                                @if($instructor?->designation)
                                                    <p class="text-muted mb-3"><i class="fas fa-briefcase me-2"></i>{{ html_decode($instructor?->designation) }}</p>
                                                @endif

                                                <div class="instructor-stats row text-center mb-4">
                                                    <div class="col-4">
                                                        <div class="p-3 bg-light rounded">
                                                            <h4 class="text-primary mb-1">{{ $instructor->total_course }}</h4>
                                                            <small class="text-muted">{{ __('translate.Courses') }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="p-3 bg-light rounded">
                                                            <h4 class="text-success mb-1">{{ $instructor->total_student }}</h4>
                                                            <small class="text-muted">{{ __('translate.Students') }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="p-3 bg-light rounded">
                                                            <h4 class="text-warning mb-1">{{ number_format($instructor->avg_rating, 1) }}</h4>
                                                            <small class="text-muted">{{ __('translate.Rating') }}</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($instructor?->qualification)
                                                    <div class="mb-3">
                                                        <h6 class="text-muted mb-2"><i class="fas fa-graduation-cap me-2"></i>{{ __('translate.Qualification') }}</h6>
                                                        <p>{{ html_decode($instructor?->qualification) }}</p>
                                                    </div>
                                                @endif

                                                @if($instructor?->experience)
                                                    <div class="mb-3">
                                                        <h6 class="text-muted mb-2"><i class="fas fa-star me-2"></i>{{ __('translate.Experience') }}</h6>
                                                        <p>{{ html_decode($instructor?->experience) }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@push('style_section')
<style>
    .course-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 2rem;
    }
    
    .course-meta .bg-light {
        transition: transform 0.2s ease;
    }
    
    .course-meta .bg-light:hover {
        transform: translateY(-2px);
    }
    
    .lesson-item:last-child {
        border-bottom: none !important;
    }
    
    .nav-pills .nav-link {
        color: #6c757d;
        border-radius: 25px;
        margin: 0 0.25rem;
    }
    
    .nav-pills .nav-link.active {
        background-color: #0d6efd;
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .instructor-stats .bg-light:hover {
        background-color: #f1f3f4 !important;
        transform: translateY(-2px);
        transition: all 0.2s ease;
    }
</style>
@endpush