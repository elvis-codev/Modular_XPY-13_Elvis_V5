@extends('layout_inner_page')

@section('title')
    <title>{{ html_decode($course->title) }}</title>
    <meta name="title" content="{{ $course->seo_title }}">
    <meta name="description" content="{{ $course->seo_description }}">
@endsection

@section('front-content')

    <!-- Start Course Details Section -->
    <section>
        <div class="td_height_60 td_height_lg_40"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="td_course_details">
                        <!-- Course Header -->
                        <div class="text-center mb-4">
                            <span class="td_course_label td_mb_10">{{ $course?->category?->name }}</span>
                            <h1 class="td_fs_36 td_mb_20">{{ html_decode($course?->title) }}</h1>
                            <div class="td_course_meta td_mb_30">
                                <div class="td_course_avatar d-inline-flex align-items-center">
                                    @if ($instructor?->image)
                                        <img src="{{ asset($instructor?->image) }}" alt="" class="rounded-circle me-3" style="width: 50px; height: 50px;" />
                                    @else
                                        <img src="{{ asset($general_setting->default_avatar) }}" alt="" class="rounded-circle me-3" style="width: 50px; height: 50px;" />
                                    @endif
                                    <div>
                                        <p class="td_heading_color mb-0 td_medium">
                                            <span class="td_accent_color">{{ __('translate.Instructor') }}:</span> 
                                            {{ html_decode($instructor?->name) }}
                                        </p>
                                        <small class="td_heading_color td_opacity_7">
                                            {{ __('translate.Created') }}: {{ $course->created_at->format('d M, Y') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Course Image -->
                        <div class="text-center mb-4">
                            <img src="{{ asset($course?->thumb_image) }}" alt="{{ html_decode($course?->title) }}" class="img-fluid rounded" style="max-height: 400px;">
                        </div>

                        <!-- Course Info Pills -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-3 justify-content-center">
                                    <span class="badge bg-primary fs-6 py-2 px-3">
                                        {{ __('translate.Level') }}: {{ $course?->course_level?->name }}
                                    </span>
                                    <span class="badge bg-success fs-6 py-2 px-3">
                                        {{ __('translate.Language') }}: {{ $course?->course_language?->name }}
                                    </span>
                                    <span class="badge bg-info fs-6 py-2 px-3">
                                        {{ __('translate.Lessons') }}: {{ html_decode($course->total_lesson) }}
                                    </span>
                                    <span class="badge bg-warning fs-6 py-2 px-3">
                                        {{ __('translate.Durations') }}: {{ html_decode($course->total_duration) }} {{ __('translate.Hour') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Tabs Navigation -->
                        <div class="td_tabs td_style_1">
                            <ul class="nav nav-tabs td_tab_links td_style_2 td_type_2 td_mp_0 td_medium td_fs_20 td_heading_color justify-content-center" id="courseTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">
                                        {{ __('translate.Overview') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab">
                                        {{ __('translate.Content') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="instructor-tab" data-bs-toggle="tab" data-bs-target="#instructor" type="button" role="tab">
                                        {{ __('translate.Instructor') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
                                        {{ __('translate.Reviews') }}
                                    </button>
                                </li>
                            </ul>

                            <!-- Tabs Content -->
                            <div class="tab-content td_tab_body td_fs_18 mt-4" id="courseTabContent">
                                <!-- Overview Tab -->
                                <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body p-4">
                                            <h2 class="td_fs_28 td_mb_20">{{ __('translate.Courses Descriptions') }}</h2>
                                            <div class="course-description">
                                                {!! clean(html_decode($course->description), 'iframe_allowed') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Curriculum Tab -->
                                <div class="tab-pane fade" id="curriculum" role="tabpanel">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body p-4">
                                            <div class="accordion" id="curriculumAccordion">
                                                @foreach ($course_modules as $module_index => $course_module)
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading{{ $course_module->id }}">
                                                            <button class="accordion-button {{ $module_index != 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $course_module->id }}">
                                                                {{ html_decode($course_module?->name) }}
                                                                <span class="badge bg-secondary ms-auto me-3">
                                                                    {{ count($course_module->lessons ?? []) }} {{ __('translate.Lessons') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse{{ $course_module->id }}" class="accordion-collapse collapse {{ $module_index == 0 ? 'show' : '' }}">
                                                            <div class="accordion-body">
                                                                @foreach ($course_module->lessons ?? [] as $lesson_index => $lesson)
                                                                    <div class="d-flex align-items-center py-2 border-bottom">
                                                                        <div class="me-3">
                                                                            <span class="badge bg-light text-dark">{{ $lesson_index + 1 }}</span>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <h6 class="mb-0">{{ html_decode($lesson?->name) }}</h6>
                                                                        </div>
                                                                        <div class="text-muted">
                                                                            {{ html_decode($lesson?->video_duration) }} min
                                                                            @if ($lesson?->is_public_lesson == 'disable')
                                                                                <i class="fa-solid fa-lock ms-2"></i>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Instructor Tab -->
                                <div class="tab-pane fade" id="instructor" role="tabpanel">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body p-4">
                                            <div class="row align-items-center">
                                                <div class="col-md-3 text-center">
                                                    @if ($instructor?->image)
                                                        <img src="{{ asset($instructor?->image) }}" alt="" class="rounded-circle img-fluid" style="max-width: 150px;" />
                                                    @else
                                                        <img src="{{ asset($general_setting->default_avatar) }}" alt="" class="rounded-circle img-fluid" style="max-width: 150px;" />
                                                    @endif
                                                </div>
                                                <div class="col-md-9">
                                                    <h3 class="td_fs_24 mb-2">{{ html_decode($instructor?->name) }}</h3>
                                                    <p class="text-muted mb-3">{{ html_decode($instructor?->designation) }}</p>
                                                    
                                                    <div class="row mb-3">
                                                        <div class="col-sm-6">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <i class="fa-solid fa-book-open me-2 text-primary"></i>
                                                                <span>{{ $instructor->total_course }} {{ __('translate.Courses') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <i class="fa-solid fa-users me-2 text-success"></i>
                                                                <span>{{ $instructor->total_student }} {{ __('translate.Students') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="td_rating me-2" data-rating="{{ $instructor->avg_rating }}">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $instructor->avg_rating)
                                                                    <i class="fa-solid fa-star text-warning"></i>
                                                                @else
                                                                    <i class="fa-regular fa-star text-warning"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <span class="text-muted">({{ $instructor->total_rating }} {{ __('translate.Ratings') }})</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reviews Tab -->
                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body p-4">
                                            <!-- Rating Summary -->
                                            <div class="row mb-4">
                                                <div class="col-md-4 text-center">
                                                    <h2 class="display-4 text-primary">{{ $course->avg_rating }}</h2>
                                                    <p class="text-muted">{{ $course->total_rating }} {{ __('translate.Reviews') }}</p>
                                                </div>
                                                <div class="col-md-8">
                                                    @foreach ($rating_data as $rating => $data)
                                                        <div class="d-flex align-items-center mb-2">
                                                            <span class="me-2">{{ $rating }} {{ __('translate.Star') }}</span>
                                                            <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                                <div class="progress-bar" style="width: {{ $data['percentage'] }}%"></div>
                                                            </div>
                                                            <span class="text-muted">({{ $data['count'] }})</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Reviews List -->
                                            @if ($reviews->count() > 0)
                                                <div class="reviews-list">
                                                    @foreach ($reviews as $review)
                                                        <div class="d-flex mb-4 pb-3 border-bottom">
                                                            <div class="me-3">
                                                                @if ($review?->student?->image)
                                                                    <img src="{{ asset($review?->student?->image) }}" alt="" class="rounded-circle" style="width: 50px; height: 50px;" />
                                                                @else
                                                                    <img src="{{ asset($general_setting->default_avatar) }}" alt="" class="rounded-circle" style="width: 50px; height: 50px;" />
                                                                @endif
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-1">{{ html_decode($review?->student?->name) }}</h6>
                                                                <div class="mb-2">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $review->rating)
                                                                            <i class="fa-solid fa-star text-warning"></i>
                                                                        @else
                                                                            <i class="fa-regular fa-star text-warning"></i>
                                                                        @endif
                                                                    @endfor
                                                                    <small class="text-muted ms-2">{{ $review->created_at->format('d M, Y') }}</small>
                                                                </div>
                                                                <p class="mb-0">{{ html_decode($review?->review) }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <!-- Write Review Form -->
                                            <div class="write-review-section mt-4">
                                                <h4 class="mb-3">{{ __('translate.Write a Review') }}</h4>
                                                <form action="{{ route('student.store-review', $course->id) }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label">{{ __('translate.Rating') }}</label>
                                                        <div class="rating-input">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i class="fa-solid fa-star course_rat text-warning" data-rating="{{ $i }}" onclick="courseReview({{ $i }})" style="cursor: pointer;"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="review" class="form-label">{{ __('translate.Review') }} *</label>
                                                        <textarea class="form-control" id="review" rows="4" name="review" placeholder="{{ __('translate.Write your review') }}" required>{{ old('review') }}</textarea>
                                                    </div>
                                                    
                                                    @if($general_setting->recaptcha_status==1)
                                                        <div class="mb-3">
                                                            <div class="g-recaptcha" data-sitekey="{{ $general_setting->recaptcha_site_key }}"></div>
                                                        </div>
                                                    @endif
                                                    
                                                    <input type="hidden" name="rating" value="5" id="course_rating">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('translate.Submit Review') }}
                                                    </button>
                                                </form>
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
        <div class="td_height_60 td_height_lg_40"></div>
    </section>
    <!-- End Course Details Section -->

@endsection

@push('js_section')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        "use strict";
        
        function courseReview(rating){
            $(".course_rat").each(function(){
                var course_rat = $(this).data('rating')
                if(course_rat > rating){
                    $(this).removeClass('text-warning').addClass('text-muted');
                }else{
                    $(this).addClass('text-warning').removeClass('text-muted');
                }
            })
            $("#course_rating").val(rating);
        }
    </script>
@endpush