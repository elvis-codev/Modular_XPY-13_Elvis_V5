@extends('admin.master_layout')
@section('title')
    <title>{{ __('translate.Edit School') }}</title>
@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('translate.Edit School') }}</h3>
    <p class="crancy-header__text">{{ __('translate.Manage Schools') }} >> {{ __('translate.Edit School') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12">
                <div class="crancy-body">
                    <div class="crancy-dsinner">
                        <form action="{{ route('admin.schools.update', $school->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12 mg-top-30">
                                    <div class="crancy-product-card">
                                        <div class="create_new_btn_inline_box">
                                            <h4 class="crancy-product-card__title">{{ __('translate.Edit School') }}</h4>
                                            <a href="{{ route('admin.schools.index') }}" class="crancy-btn">
                                                <i class="fa fa-list"></i> {{ __('translate.School List') }}
                                            </a>
                                        </div>

                                        <div class="row mg-top-30">
                                            <div class="col-md-6">
                                                <div class="crancy__item-form--group mg-top-form-20">
                                                    <label class="crancy__item-label">{{ __('translate.School Name') }} *</label>
                                                    <input class="crancy__item-input" type="text" name="name" id="name" value="{{ old('name', $school->name) }}" placeholder="{{ __('translate.School Name') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="crancy__item-form--group mg-top-form-20">
                                                    <label class="crancy__item-label">{{ __('translate.Slug') }}</label>
                                                    <input class="crancy__item-input" type="text" name="slug" id="slug" value="{{ old('slug', $school->slug) }}" placeholder="{{ __('translate.Leave empty to auto-generate') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="crancy__item-form--group mg-top-form-20">
                                                    <label class="crancy__item-label">{{ __('translate.Primary Color') }} *</label>
                                                    <input class="crancy__item-input" type="color" name="primary_color" id="primary_color" value="{{ old('primary_color', $school->primary_color) }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="crancy__item-form--group mg-top-form-20">
                                                    <label class="crancy__item-label">{{ __('translate.Secondary Color') }} *</label>
                                                    <input class="crancy__item-input" type="color" name="secondary_color" id="secondary_color" value="{{ old('secondary_color', $school->secondary_color) }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="crancy__item-form--group mg-top-form-20">
                                                    <label class="crancy__item-label">{{ __('translate.Status') }}</label>
                                                    <div class="crancy-ptabs__notify-switch crancy-ptabs__notify-switch--two">
                                                        <label class="crancy__item-switch">
                                                            <input name="status" type="checkbox" value="active" {{ old('status', $school->status) == 'active' ? 'checked' : '' }}>
                                                            <span class="crancy__item-switch--slide crancy__item-switch--round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="crancy__item-form--group w-100 h-100">
                                                            <label class="crancy__item-label">{{ __('translate.School Logo') }}</label>
                                                            <div class="crancy-product-card__upload crancy-product-card__upload--border">
                                                                <input type="file" class="btn-check" name="logo" id="input-img1" autocomplete="off" onchange="previewImage(event)">
                                                                <label class="crancy-image-video-upload__label" for="input-img1">
                                                                    <img id="view_img" src="{{ $school->logo_url }}" alt="preview">
                                                                    <h4 class="crancy-image-video-upload__title">
                                                                        {{ __('translate.Click here to') }} 
                                                                        <span class="crancy-primary-color">{{ __('translate.Choose File') }}</span> 
                                                                        {{ __('translate.and upload') }}
                                                                    </h4>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="crancy-product-card mg-top-30">
                                                            <h4 class="crancy-product-card__title">{{ __('translate.Statistics') }}</h4>
                                                            <div class="row mg-top-20">
                                                                <div class="col-6">
                                                                    <div class="crancy-product-card__counter">
                                                                        <h3 class="crancy-product-card__number crancy-color-1">{{ $school->total_students }}</h3>
                                                                        <p class="crancy-product-card__text">{{ __('translate.Students') }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="crancy-product-card__counter">
                                                                        <h3 class="crancy-product-card__number crancy-color-2">{{ $school->total_instructors }}</h3>
                                                                        <p class="crancy-product-card__text">{{ __('translate.Instructors') }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="crancy-btn mg-top-25" type="submit">{{ __('translate.Update') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js_section')
<script>
    "use strict";
    
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('view_img');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    };

    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-')
                        .trim('-');
        document.getElementById('slug').value = slug;
    });

    // Handle status checkbox
    document.querySelector('input[name="status"]').addEventListener('change', function() {
        this.value = this.checked ? 'active' : 'inactive';
    });
</script>
@endpush