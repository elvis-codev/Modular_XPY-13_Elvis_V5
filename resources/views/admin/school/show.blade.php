@extends('admin.master_layout')
@section('title')
    <title>{{ $school->name }} - {{ __('translate.School Details') }}</title>
@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ $school->name }}</h3>
    <p class="crancy-header__text">{{ __('translate.Manage Schools') }} >> {{ __('translate.School Details') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12">
                <div class="crancy-body">
                    <div class="crancy-dsinner">
                        <div class="row">
                            <div class="col-12 mg-top-30">
                                <div class="crancy-product-card">
                                    <div class="create_new_btn_inline_box">
                                        <h4 class="crancy-product-card__title">{{ __('translate.School Information') }}</h4>
                                        <div>
                                            <a href="{{ route('admin.schools.edit', $school->id) }}" class="crancy-btn mg-right-15">
                                                <i class="fas fa-edit"></i> {{ __('translate.Edit School') }}
                                            </a>
                                            <a href="{{ route('admin.schools.index') }}" class="crancy-btn">
                                                <i class="fa fa-list"></i> {{ __('translate.School List') }}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row mg-top-30">
                                        <div class="col-md-4">
                                            <div class="crancy-product-card__thumb">
                                                <img src="{{ $school->logo_url }}" alt="{{ $school->name }}" style="width: 100%; max-width: 200px; height: auto; border-radius: 10px;">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="crancy-product-card__content">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td style="width: 30%;"><strong>{{ __('translate.Name') }}:</strong></td>
                                                        <td>{{ $school->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>{{ __('translate.Slug') }}:</strong></td>
                                                        <td>{{ $school->slug }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>{{ __('translate.Primary Color') }}:</strong></td>
                                                        <td>
                                                            <span style="display: inline-block; width: 30px; height: 20px; background-color: {{ $school->primary_color }}; border: 1px solid #ddd; border-radius: 3px; margin-right: 10px;"></span>
                                                            {{ $school->primary_color }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>{{ __('translate.Secondary Color') }}:</strong></td>
                                                        <td>
                                                            <span style="display: inline-block; width: 30px; height: 20px; background-color: {{ $school->secondary_color }}; border: 1px solid #ddd; border-radius: 3px; margin-right: 10px;"></span>
                                                            {{ $school->secondary_color }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>{{ __('translate.Status') }}:</strong></td>
                                                        <td>
                                                            @if ($school->status == 'active')
                                                                <span class="badge badge--success">{{ __('translate.Active') }}</span>
                                                            @else
                                                                <span class="badge badge--danger">{{ __('translate.Inactive') }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>{{ __('translate.Created') }}:</strong></td>
                                                        <td>{{ $school->created_at->format('M d, Y H:i') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>{{ __('translate.Updated') }}:</strong></td>
                                                        <td>{{ $school->updated_at->format('M d, Y H:i') }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistics Cards -->
                            <div class="col-md-6 mg-top-30">
                                <div class="crancy-product-card">
                                    <div class="crancy-product-card__thumb crancy-bg-color-1">
                                        <i class="fas fa-user-graduate crancy-color-1"></i>
                                    </div>
                                    <div class="crancy-product-card__content">
                                        <h3 class="crancy-product-card__number crancy-color-1">{{ $school->total_students }}</h3>
                                        <p class="crancy-product-card__text">{{ __('translate.Total Students') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mg-top-30">
                                <div class="crancy-product-card">
                                    <div class="crancy-product-card__thumb crancy-bg-color-2">
                                        <i class="fas fa-chalkboard-teacher crancy-color-2"></i>
                                    </div>
                                    <div class="crancy-product-card__content">
                                        <h3 class="crancy-product-card__number crancy-color-2">{{ $school->total_instructors }}</h3>
                                        <p class="crancy-product-card__text">{{ __('translate.Total Instructors') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Students List -->
                            @if($school->students->count() > 0)
                            <div class="col-12 mg-top-30">
                                <div class="crancy-table crancy-table--v3">
                                    <div class="crancy-customer-filter">
                                        <div class="crancy-customer-filter__single crancy-customer-filter__single--csearch">
                                            <h4 class="crancy-product-card__title">{{ __('translate.Students') }}</h4>
                                        </div>
                                    </div>

                                    <div class="crancy-table__main crancy-table__main-v3">
                                        <table class="table">
                                            <thead class="crancy-table__head">
                                                <tr>
                                                    <th>{{ __('translate.Name') }}</th>
                                                    <th>{{ __('translate.Email') }}</th>
                                                    <th>{{ __('translate.Status') }}</th>
                                                    <th>{{ __('translate.Joined') }}</th>
                                                    <th>{{ __('translate.Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="crancy-table__body">
                                                @foreach($school->students->take(25) as $student)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset($student->image ? $student->image : 'uploads/website-images/avatar-placeholder.png') }}" 
                                                                 alt="{{ $student->name }}" 
                                                                 style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                                                            {{ $student->name }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>
                                                        @if($student->status == 'enable')
                                                            <span class="badge badge--success">{{ __('translate.Active') }}</span>
                                                        @else
                                                            <span class="badge badge--danger">{{ __('translate.Inactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $student->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.user-show', $student->id) }}" class="crancy-btn crancy-btn--small">
                                                            <i class="fas fa-eye"></i> {{ __('translate.View') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if($school->students->count() > 25)
                                            <div class="text-center mg-top-20">
                                                <p class="text-muted">{{ __('translate.Showing 25 of') }} {{ $school->students->count() }} {{ __('translate.students') }}</p>
                                                <a href="{{ route('admin.user-list') }}?school={{ $school->id }}" class="crancy-btn" style="background-color: #6440FB;">
                                                    <i class="fas fa-eye"></i> {{ __('translate.View All Students') }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Instructors List -->
                            @if($school->instructors->count() > 0)
                            <div class="col-12 mg-top-30">
                                <div class="crancy-table crancy-table--v3">
                                    <div class="crancy-customer-filter">
                                        <div class="crancy-customer-filter__single crancy-customer-filter__single--csearch">
                                            <h4 class="crancy-product-card__title">{{ __('translate.Instructors') }}</h4>
                                        </div>
                                    </div>

                                    <div class="crancy-table__main crancy-table__main-v3">
                                        <table class="table">
                                            <thead class="crancy-table__head">
                                                <tr>
                                                    <th>{{ __('translate.Name') }}</th>
                                                    <th>{{ __('translate.Email') }}</th>
                                                    <th>{{ __('translate.Status') }}</th>
                                                    <th>{{ __('translate.Joined') }}</th>
                                                    <th>{{ __('translate.Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="crancy-table__body">
                                                @foreach($school->instructors->take(25) as $instructor)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset($instructor->image ? $instructor->image : 'uploads/website-images/avatar-placeholder.png') }}" 
                                                                 alt="{{ $instructor->name }}" 
                                                                 style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                                                            {{ $instructor->name }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $instructor->email }}</td>
                                                    <td>
                                                        @if($instructor->status == 'enable')
                                                            <span class="badge badge--success">{{ __('translate.Active') }}</span>
                                                        @else
                                                            <span class="badge badge--danger">{{ __('translate.Inactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $instructor->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.seller-show', $instructor->id) }}" class="crancy-btn crancy-btn--small">
                                                            <i class="fas fa-eye"></i> {{ __('translate.View') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if($school->instructors->count() > 25)
                                            <div class="text-center mg-top-20">
                                                <p class="text-muted">{{ __('translate.Showing 25 of') }} {{ $school->instructors->count() }} {{ __('translate.instructors') }}</p>
                                                <a href="{{ route('admin.seller-list') }}?school={{ $school->id }}" class="crancy-btn" style="background-color: #6440FB;">
                                                    <i class="fas fa-eye"></i> {{ __('translate.View All Instructors') }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection