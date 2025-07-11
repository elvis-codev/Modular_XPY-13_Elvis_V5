@extends('admin.master_layout')
@section('title')
    <title>{{ __('translate.Student Details') }}</title>
@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('translate.Student Details') }}</h3>
    <p class="crancy-header__text">{{ __('translate.Manage Student') }} >> {{ __('translate.Student Details') }}</p>
@endsection

@section('body-content')

    <!-- crancy Dashboard -->
    <section class="crancy-adashboard crancy-show">
        <div class="container container__bscreen">
            <div class="row row__bscreen">

                <div class="col-xxl-4 col-md-6 col-12 mg-top-30">
                    <div class="crancy-ecom-card crancy-ecom-card__v2">
                        <div class="flex-main">
                            <span>
                                @include('admin.user.svg.enrolled_course_qty')
                            </span>
                            <div class="flex-1">
                                <div class="crancy-ecom-card__heading">
                                    <div class="crancy-ecom-card__icon">
                                        <h4 class="crancy-ecom-card__title">{{ __('translate.Enrolled Course') }} </h4>
                                    </div>

                                </div>
                                <div class="crancy-ecom-card__content">
                                    <div class="crancy-ecom-card__camount">
                                        <div class="crancy-ecom-card__camount__inside">
                                            <h3 class="crancy-ecom-card__amount">{{ $enrolled_course_qty }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-md-6 col-12 mg-top-30">
                    <div class="crancy-ecom-card crancy-ecom-card__v2">
                        <div class="flex-main">
                            <span>
                                @include('admin.user.svg.total_transaction')
                            </span>
                            <div class="flex-1">
                                <div class="crancy-ecom-card__heading">
                                    <div class="crancy-ecom-card__icon">
                                        <h4 class="crancy-ecom-card__title">{{ __('translate.Total Transaction') }} </h4>
                                    </div>

                                </div>
                                <div class="crancy-ecom-card__content">
                                    <div class="crancy-ecom-card__camount">
                                        <div class="crancy-ecom-card__camount__inside">
                                            <h3 class="crancy-ecom-card__amount">{{ currency($enrolled_course_amount) }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-md-6 col-12 mg-top-30">
                    <div class="crancy-ecom-card crancy-ecom-card__v2">
                        <div class="flex-main">
                            <span>
                                @include('admin.user.svg.wallet_balance')
                            </span>
                            <div class="flex-1">
                                <div class="crancy-ecom-card__heading">
                                    <div class="crancy-ecom-card__icon">
                                        <h4 class="crancy-ecom-card__title">{{ __('translate.Wallet Balance') }} </h4>
                                    </div>

                                </div>
                                <div class="crancy-ecom-card__content">
                                    <div class="crancy-ecom-card__camount">
                                        <div class="crancy-ecom-card__camount__inside">
                                            <h3 class="crancy-ecom-card__amount">{{ currency($wallet_balance) }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mg-top-30 row__bscreen">
                <div class=" col-xxl-3 col-xl-4 col-lg-4">
                    <div class="overview-profile">
                        <div class="overview-profile-thumb-main">
                            <div class="overview-profile-thumb">
                                @if ($user->image)
                                <img src="{{ asset($user->image) }}" alt="thumb">
                                @else
                                <img src="{{ asset($general_setting->default_avatar) }}" alt="thumb">
                                @endif

                            </div>
                            <div class="overview-profile-txt">
                                <h4>{{ html_decode($user->name) }}</h4>
                            </div>
                        </div>



                        <div class="overview-profile-item">


                            <div class="overview-profile-inner">
                                <h4>{{ __('translate.Contact Information') }} </h4>


                                <ul class="overview-profile-inner-contact">
                                    <li>
                                        <a href="tel:{{ html_decode($user->phone) }}">
                                            <span>
                                                @include('admin.seller.svg.phone')
                                            </span>
                                            {{ html_decode($user->phone) }}
                                        </a>
                                    </li>


                                    <li>
                                        <a href="mailto:{{ html_decode($user->email) }}">
                                            <span>
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2 12V7C2 4.79086 3.79086 3 6 3H18C20.2091 3 22 4.79086 22 7V17C22 19.2091 20.2091 21 18 21H8M6 8L9.7812 10.5208C11.1248 11.4165 12.8752 11.4165 14.2188 10.5208L18 8M2 15H8M2 18H8"
                                                    stroke="#6440FBFF" stroke-width="1.5"
                                                    stroke-linecap="round" />
                                            </svg>


                                            </span>
                                            {{ html_decode($user->email) }}
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript:;">
                                            <span>
                                                @include('admin.seller.svg.address')
                                            </span>
                                            {{ html_decode($user->address) }}
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript:;">
                                            <span>
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3 3H21V21H3V3ZM5 5V19H19V5H5ZM7 7H17V9H7V7ZM7 11H17V13H7V11ZM7 15H13V17H7V15Z" fill="#6440FBFF"/>
                                                </svg>
                                            </span>
                                            {{ __('translate.School') }}: 
                                            @if($user->school)
                                                <strong>{{ $user->school->name }}</strong>
                                            @else
                                                <span class="text-muted">{{ __('translate.No School Assigned') }}</span>
                                            @endif
                                        </a>
                                    </li>

                                </ul>

                            </div>


                            <div class="overview-profile-inner">

                                @if ($user->is_seller == 1)
                                    <a target="_blank" href="{{ route('instructors', $user->username) }}" class="crancy-btn crancy-full-width mg-top-20"> <i class="fas fa-eye    "></i> {{ __('translate.Go To Public Profile') }}</a>
                                @endif


                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editModal" class="crancy-btn crancy-full-width mg-top-20 user_edit_btn"> <i class="fas fa-edit    "></i> {{ __('translate.Edit Profile') }}</a>

                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#assignCourseModal" class="crancy-btn crancy-full-width mg-top-20" style="background-color: #28a745; border-color: #28a745;"> <i class="fas fa-plus-circle"></i> Asignar Cursos</a>

                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#assignSchoolModal" class="crancy-btn crancy-full-width mg-top-20" style="background-color: #007bff; border-color: #007bff;"> <i class="fas fa-school"></i> {{ __('translate.Assign School') }}</a>

                                <a onclick="itemDeleteConfrimation({{ $user->id }})" href="javascript:;" data-bs-toggle="modal" data-bs-target="#exampleModal" class="crancy-btn crancy-full-width mg-top-20 user_delete_btn"> <i class="fas fa-trash    "></i> {{ __('translate.Delete Student') }}</a>

                            </div>
                        </div>
                    </div>
                </div>

                <div class=" col-xxl-9 col-xl-8 col-lg-8">
                    <div class="container container__bscreen ">
                        <div class="row">
                            <div class="col-12">
                                <div class="crancy-body">
                                    <div class="crancy-dsinner">

                                        <div class="crancy-table crancy-table--v3">

                                            <div class="crancy-customer-filter">
                                                <div class="crancy-customer-filter__single crancy-customer-filter__single--csearch d-flex items-center justify-between create_new_btn_box">
                                                    <div class="crancy-header__form crancy-header__form--customer create_new_btn_inline_box">
                                                        <h4 class="crancy-product-card__title">{{ __('translate.Enrollments List') }}</h4>


                                                    </div>
                                                </div>
                                            </div>

                                            <!-- crancy Table -->
                                            <div id="crancy-table__main_wrapper" class=" dt-bootstrap5 no-footer">

                                                <table class="crancy-table__main crancy-table__main-v3  no-footer" id="dataTable">
                                                    <!-- crancy Table Head -->
                                                    <thead class="crancy-table__head">
                                                        <tr>


                                                            <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                                {{ __('translate.Serial') }}
                                                            </th>


                                                            <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                                {{ __('translate.Invoice') }}
                                                            </th>

                                                            <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                                {{ __('translate.Total Amount') }}
                                                            </th>

                                                            <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                                {{ __('translate.Date') }}
                                                            </th>

                                                            <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                                {{ __('translate.Gateway') }}
                                                            </th>

                                                            <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                                {{ __('translate.Payment') }}
                                                            </th>


                                                            <th class="crancy-table__column-3 crancy-table__h3 sorting">
                                                                {{ __('translate.Action') }}
                                                            </th>

                                                        </tr>
                                                    </thead>

                                                    <!-- crancy Table Body -->
                                                    <tbody class="crancy-table__body">
                                                        @foreach ($enrollments as $index => $enrollment)
                                                            <tr class="odd">

                                                                <td class="crancy-table__column-2 crancy-table__data-2">
                                                                    <h4 class="crancy-table__product-title">{{ ++$index }}</h4>
                                                                </td>

                                                                <td class="crancy-table__column-2 crancy-table__data-2">
                                                                    <h4 class="crancy-table__product-title"><a href="{{ route('admin.course-enrollment', $enrollment->order_id) }}">#{{ $enrollment->order_id }}</a></h4>
                                                                </td>

                                                                <td class="crancy-table__column-2 crancy-table__data-2">
                                                                    <h4 class="crancy-table__product-title">
                                                                        {{ currency($enrollment->total_amount) }}
                                                                    </h4>
                                                                </td>


                                                                <td class="crancy-table__column-2 crancy-table__data-2">
                                                                    <h4 class="crancy-table__product-title">{{ $enrollment->created_at->format('d M, Y') }}</h4>
                                                                </td>

                                                                <td class="crancy-table__column-2 crancy-table__data-2">
                                                                    <h4 class="crancy-table__product-title">{{ $enrollment->payment_method }}</h4>
                                                                </td>




                                                                <td class="crancy-table__column-2 crancy-table__data-2">
                                                                    @if ($enrollment->payment_status == 'success')
                                                                        <div class="crancy-table__status crancy-table__status--paid">{{ __('translate.Success') }}</div>
                                                                    @elseif ($enrollment->payment_status == 'rejected')
                                                                        <div class="crancy-table__status crancy-table__status--delete">{{ __('translate.Rejected') }}</div>
                                                                    @else
                                                                        <div class="crancy-table__status crancy-table__status--unpaid">{{ __('translate.Pending') }}</div>
                                                                    @endif
                                                                </td>


                                                                <td class="crancy-table__column-2 crancy-table__data-2">

                                                                    <a href="{{ route('admin.course-enrollment', $enrollment->order_id) }}" class="crancy-btn"><i class="fas fa-eye"></i> {{ __('translate.Detail') }}</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                    <!-- End crancy Table Body -->
                                                </table>
                                            </div>
                                            <!-- End crancy Table -->
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
    <!-- End crancy Dashboard -->



    {{-- Edit Modal --}}

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('translate.Edit User Basic Information') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.user-update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6">
                                <div class="crancy__item-form--group mg-top-form-20">
                                    <label class="crancy__item-label">{{ __('translate.Name') }} * </label>
                                    <input class="crancy__item-input" type="text" name="name" value="{{ html_decode($user->name) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="crancy__item-form--group mg-top-form-20">
                                    <label class="crancy__item-label">{{ __('translate.Gender') }} * </label>
                                    <select class="form-select crancy__item-input" name="gender">
                                        <option value="">{{ __('translate.Select') }}</option>
                                        <option {{ $user->gender == 'Male' ? 'selected' : '' }} value="Male">{{ __('translate.Male') }}</option>
                                        <option {{ $user->gender == 'Female' ? 'selected' : '' }} value="Female">{{ __('translate.Female') }}</option>
                                        <option {{ $user->gender == 'Others' ? 'selected' : '' }} value="Others">{{ __('translate.Others') }}</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="crancy__item-form--group mg-top-form-20">
                                    <label class="crancy__item-label">{{ __('translate.Phone') }} *</label>
                                    <input class="crancy__item-input" type="text" name="phone" value="{{ html_decode($user->phone) }}" >
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="crancy__item-form--group mg-top-form-20">
                                    <label class="crancy__item-label">{{ __('translate.Address') }} *</label>
                                    <input class="crancy__item-input" type="text" name="address" value="{{ html_decode($user->address) }}" >
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="crancy__item-form--group mg-top-form-20">
                                    <label class="crancy__item-label">{{ __('translate.Status') }} </label>
                                    <div class="crancy-ptabs__notify-switch  crancy-ptabs__notify-switch--two">
                                        <label class="crancy__item-switch">
                                        <input {{ $user->status == 'enable' ? 'checked' : '' }} name="status" type="checkbox" >
                                        <span class="crancy__item-switch--slide crancy__item-switch--round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>


                </div>
                <div class="modal-footer delet_modal_form">

                    <button type="submit" class="btn btn-primary">{{ __('translate.Update Info') }}</button>
                </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Assign Course Modal --}}
    <div class="modal fade" id="assignCourseModal" tabindex="-1" aria-labelledby="assignCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignCourseModalLabel">Asignar Curso al Estudiante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="assignCourseForm">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $user->id }}">
                        
                        <div class="crancy__item-form--group">
                            <label class="crancy__item-label">Seleccionar Curso *</label>
                            <select class="form-select crancy__item-input" name="course_id" id="courseSelect" required>
                                <option value="">Seleccione un curso...</option>
                                @php
                                    $all_courses = \Modules\Course\App\Models\Course::with('translate')->get();
                                @endphp
                                @if($all_courses->count() > 0)
                                    @foreach($all_courses as $course)
                                        @if($course->translate && $course->translate->title)
                                            <option value="{{ $course->id }}">
                                                {{ $course->translate->title }} - {{ currency($course->offer_price ?: $course->regular_price) }}
                                            </option>
                                        @else
                                            <option value="{{ $course->id }}">
                                                Curso ID: {{ $course->id }} - {{ currency($course->offer_price ?: $course->regular_price) }}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="">No hay cursos disponibles</option>
                                @endif
                            </select>
                        </div>

                        <div class="crancy__item-form--group mg-top-form-20">
                            <label class="crancy__item-label">Estudiante</label>
                            <input class="crancy__item-input" type="text" value="{{ html_decode($user->name) }} ({{ $user->email }})" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" onclick="assignCourse()">Asignar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Assign School Modal --}}
    <div class="modal fade" id="assignSchoolModal" tabindex="-1" aria-labelledby="assignSchoolModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignSchoolModalLabel">{{ __('translate.Assign School to Student') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="assignSchoolForm">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $user->id }}">
                        
                        <div class="crancy__item-form--group">
                            <label class="crancy__item-label">{{ __('translate.Select School') }} *</label>
                            <select class="form-select crancy__item-input" name="school_id" id="schoolSelect" required>
                                <option value="">{{ __('translate.Select School') }}...</option>
                                @php
                                    $all_schools = \App\Models\School::where('status', 'active')->get();
                                @endphp
                                @if($all_schools->count() > 0)
                                    @foreach($all_schools as $school)
                                        <option value="{{ $school->id }}" {{ $user->school_id == $school->id ? 'selected' : '' }}>
                                            {{ $school->name }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="">{{ __('translate.No schools available') }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="crancy__item-form--group mg-top-form-20">
                            <label class="crancy__item-label">{{ __('translate.Student') }}</label>
                            <input class="crancy__item-input" type="text" value="{{ html_decode($user->name) }} ({{ $user->email }})" readonly>
                        </div>

                        @if($user->school)
                        <div class="crancy__item-form--group mg-top-form-20">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> {{ __('translate.Current School') }}: <strong>{{ $user->school->name }}</strong>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('translate.Cancel') }}</button>
                    <button type="button" class="btn btn-primary" onclick="assignSchool()">{{ __('translate.Assign School') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('translate.Delete Confirmation') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('translate.Are you realy want to delete this item?') }}</p>
                </div>
                <div class="modal-footer">
                    <form action="" id="item_delect_confirmation" class="delet_modal_form" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('translate.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('translate.Yes, Delete') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('js_section')
    <script>
        "use strict"
        function itemDeleteConfrimation(id){
            $("#item_delect_confirmation").attr("action",'{{ url("admin/user-delete/") }}'+"/"+id)
        }

        function manageStatus(id){
            var appMODE = "{{ env('APP_MODE') }}"
            if(appMODE == 'DEMO'){
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }

            $.ajax({
                type:"put",
                data: { _token : '{{ csrf_token() }}' },
                url:"{{url('/admin/user-status/') }}"+"/"+id,
                success:function(response){
                    toastr.success(response)
                },
                error:function(err){}
            })
        }

        function assignCourse(){
            var appMODE = "{{ env('APP_MODE') }}"
            if(appMODE == 'DEMO'){
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }

            var courseId = $('#courseSelect').val();
            var studentId = $('input[name="student_id"]').val();

            if(!courseId){
                toastr.error('Por favor seleccione un curso');
                return;
            }

            $.ajax({
                type: "POST",
                data: { 
                    _token: '{{ csrf_token() }}',
                    course_id: courseId,
                    student_id: studentId
                },
                url: "{{ route('admin.assign-course-to-student') }}",
                success: function(response){
                    if(response.success){
                        toastr.success(response.message);
                        $('#assignCourseModal').modal('hide');
                        // Recargar la página para mostrar el curso asignado
                        setTimeout(function(){
                            location.reload();
                        }, 1500);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr){
                    var response = JSON.parse(xhr.responseText);
                    toastr.error(response.message || 'Ocurrió un error al asignar el curso');
                }
            });
        }

        function assignSchool(){
            var appMODE = "{{ env('APP_MODE') }}"
            if(appMODE == 'DEMO'){
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }

            var schoolId = $('#schoolSelect').val();
            var studentId = $('input[name="student_id"]').val();

            if(!schoolId){
                toastr.error('{{ __("translate.Please select a school") }}');
                return;
            }

            $.ajax({
                type: "POST",
                data: { 
                    _token: '{{ csrf_token() }}',
                    school_id: schoolId,
                    student_id: studentId
                },
                url: "{{ route('admin.assign-school-to-student') }}",
                success: function(response){
                    if(response.success){
                        toastr.success(response.message);
                        $('#assignSchoolModal').modal('hide');
                        // Reload the page to show the updated school assignment
                        setTimeout(function(){
                            location.reload();
                        }, 1500);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr){
                    var response = JSON.parse(xhr.responseText);
                    toastr.error(response.message || '{{ __("translate.An error occurred while assigning the school") }}');
                }
            });
        }

    </script>
@endpush
