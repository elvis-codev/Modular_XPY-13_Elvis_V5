@extends('admin.master_layout')
@section('title')
    <title>{{ __('translate.Lesson List') }}</title>
@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('translate.Lesson List') }}</h3>
    <p class="crancy-header__text">{{ __('translate.Manage Course') }} >> {{ __('translate.Lesson List') }}</p>
@endsection

@section('body-content')


<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row row__bscreen">
            <div class="col-12">
                <div class="crancy-body">

                    <div class="crancy-psidebar edc-edit-course-sidebar">
                        <!-- Features Tab List -->
                        @include('course::admin.course_sidebar')

                    </div>

                    <!-- Dashboard Inner -->
                    <div class="crancy-dsinner">
                        <div class="crancy-personals mg-top-30">

                            <div class="crancy-ptabs edc-edit-course-body">

                                <div class="crancy-customer-filter">
                                    <div class="crancy-customer-filter__single crancy-customer-filter__single--csearch d-flex items-center justify-between create_new_btn_box">
                                        <div class="crancy-header__form crancy-header__form--customer create_new_btn_inline_box">
                                            <h4 class="crancy-product-card__title">{{ __('translate.Module') }} : {{ html_decode($course_module->name) }}</h4>

                                            <a  href="javascript:;" data-bs-toggle="modal" data-bs-target="#curriculumAdd" class="crancy-btn ">
                                            <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                                <path d="M8 1V15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M1 8H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                            </span>
                                            {{ __('translate.Add Lesson') }}</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- crancy Table -->
                                <div id="crancy-table__main_wrapper" class=" dt-bootstrap5 no-footer">

                                    <table class="crancy-table__main crancy-table__main-v3  no-footer">
                                        <!-- crancy Table Head -->
                                        <thead class="crancy-table__head">
                                            <tr>

                                                <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                    {{ __('translate.Serial') }}
                                                </th>

                                                <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                    {{ __('translate.Name') }}
                                                </th>

                                                <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                    {{ __('translate.Visibility') }}
                                                </th>

                                                <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                    {{ __('translate.Status') }}
                                                </th>


                                                <th class="crancy-table__column-3 crancy-table__h3 sorting">
                                                    {{ __('translate.Action') }}
                                                </th>

                                            </tr>
                                        </thead>

                                        <!-- crancy Table Body -->
                                        <tbody class="crancy-table__body">
                                            @foreach ($module_lessons as $index => $module_lesson)
                                                <tr class="odd">

                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        <h4 class="crancy-table__product-title">{{ $module_lesson->serial }}</h4>
                                                    </td>

                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        <h4 class="crancy-table__product-title">{{ html_decode($module_lesson?->name) }} </h4>
                                                    </td>


                                                    <td class="crancy-table__column-2 crancy-table__data-2">

                                                        @if ($module_lesson->is_public_lesson == 'enable')
                                                            <span class="badge bg-success">{{ __('translate.Public') }}</span>
                                                        @else
                                                            <span class="badge bg-danger">{{ __('translate.Private') }}</span>
                                                        @endif

                                                    </td>


                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        @if ($module_lesson->status == 'enable')
                                                            <span class="badge bg-success">{{ __('translate.Active') }}</span>
                                                        @else
                                                            <span class="badge bg-danger">{{ __('translate.In-active') }}</span>
                                                        @endif
                                                    </td>


                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        <a href="javascript:void(0);" onclick="toggleEditForm({{ $module_lesson->id }}); return false;" class="crancy-btn edit-lesson-btn" data-lesson-id="{{ $module_lesson->id }}"><i class="fas fa-edit"></i> {{ __('translate.Edit') }}</a>

                                                        <a onclick="itemDeleteConfrimation({{ $course_module->id }}, {{ $module_lesson->id }})" href="javascript:;" data-bs-toggle="modal" data-bs-target="#exampleModal" class="crancy-btn delete_danger_btn"><i class="fas fa-trash"></i> </a>

                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                        <!-- End crancy Table Body -->
                                    </table>
                                </div>
                                <!-- End crancy Table -->
                                
                                <!-- Inline Edit Form -->
                                <div id="inlineEditForm" class="crancy-product-card mg-top-30" style="display: none;">
                                    <h4 class="crancy-product-card__title">{{ __('translate.Edit Lesson') }}</h4>
                                    <form id="editLessonForm" method="POST" action="">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="crancy__item-form--group mg-top-form-20">
                                                    <label class="crancy__item-label">{{ __('Tipo de Contenido') }} * </label>
                                                    <select class="form-select crancy__item-input" name="content_type" id="edit_content_type" onchange="toggleContentFieldsInline()">
                                                        <option value="video">{{ __('Video') }}</option>
                                                        <option value="link">{{ __('translate.Link') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12" id="edit_video_source_div">
                                                <div class="crancy__item-form--group mg-top-form-20">
                                                    <label class="crancy__item-label">{{ __('translate.Video Source') }} * </label>
                                                    <select class="form-select crancy__item-input" name="video_source" id="edit_video_source">
                                                        <option value="youtube">{{ __('translate.Youtube') }}</option>
                                                        <option value="vimeo">{{ __('translate.Vimeo') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12" id="edit_video_link_div">
                                                <div class="crancy__item-form--group mg-top-form-20">
                                                    <label class="crancy__item-label">{{ __('translate.Video Link') }} * </label>
                                                    <input class="crancy__item-input" type="text" name="video_id" id="edit_video_id">
                                                </div>
                                            </div>

                                            <div class="col-12" id="edit_embed_url_div" style="display:none;">
                                                <div class="crancy__item-form--group mg-top-form-20">
                                                    <label class="crancy__item-label">{{ __('Embed URL') }} * </label>
                                                    <input class="crancy__item-input" type="text" name="embed_url" id="edit_embed_url" placeholder="e.g., https://docs.google.com/presentation/d/e/EXAMPLE/embed">
                                                    <small class="form-text text-muted">{{ __('Paste the embed URL for PDFs, PPTs, or other content') }}</small>
                                                </div>
                                            </div>

                                            <input type="hidden" name="video_duration" id="edit_video_duration" value="1">

                                            <div class="col-12">
                                                <div class="crancy__item-form--group mg-top-form-20">
                                                    <label class="crancy__item-label">{{ __('translate.Name') }} * </label>
                                                    <input class="crancy__item-input" type="text" name="name" id="edit_name">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="crancy__item-form--group mg-top-form-20">
                                                    <label class="crancy__item-label">{{ __('translate.Serial') }} * </label>
                                                    <input class="crancy__item-input" type="number" name="serial" id="edit_serial">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="crancy__item-form--group mg-top-form-20">
                                                    <label class="crancy__item-label">{{ __('translate.Description') }} * </label>
                                                    <textarea class="crancy__item-input crancy__item-textarea inline-summernote" name="description" id="edit_description"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="crancy__item-form--group mg-top-form-20">
                                                    <label class="crancy__item-label">{{ __('translate.Make it Public') }} </label>
                                                    <div class="crancy-ptabs__notify-switch  crancy-ptabs__notify-switch--two">
                                                        <label class="crancy__item-switch">
                                                            <input name="is_public_lesson" type="checkbox" id="edit_is_public_lesson">
                                                            <span class="crancy__item-switch--slide crancy__item-switch--round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="crancy__item-form--group mg-top-form-20">
                                                    <label class="crancy__item-label">{{ __('translate.Visibility Status') }} </label>
                                                    <div class="crancy-ptabs__notify-switch  crancy-ptabs__notify-switch--two">
                                                        <label class="crancy__item-switch">
                                                            <input name="status" type="checkbox" id="edit_status">
                                                            <span class="crancy__item-switch--slide crancy__item-switch--round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end mg-top-25">
                                            <button type="button" onclick="cancelEdit()" class="crancy-btn me-2">{{ __('translate.Cancel') }}</button>
                                            <button type="submit" class="btn btn-primary">{{ __('translate.Update Lesson') }}</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- End Inline Edit Form -->

                                <div class="d-flex justify-content-end">
                                    <div>
                                        @if (request()->has('req_type') && request()->get('req_type') == 'from_create')

                                            <a class="crancy-btn next-btn mg-top-25" href="{{ route('admin.course-curriculum', ['course_id' => $course->id, 'req_type' => 'from_create'] ) }}">  {{ __('translate.Previous') }}</a>

                                        @else

                                            <a class="crancy-btn next-btn mg-top-25" href="{{ route('admin.course-curriculum', $course->id ) }}"> {{ __('translate.Previous') }}</a>

                                        @endif
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- End Dashboard Inner -->




                </div>
            </div>
        </div>
    </div>
</section>



<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModalId" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


  <!-- New curriculum modal -->
  <div class="modal fade" id="curriculumAdd" tabindex="-1" aria-labelledby="curriculumAdd" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="modal-content delet_modal_form" method="POST" action="{{ route('admin.store-course-lesson', $course_module->id) }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="curriculumAdd">{{ __('translate.Create New Lesson') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-12">
                        <div class="crancy__item-form--group">
                            <label class="crancy__item-label">{{ __('translate.Name') }} * </label>
                            <input class="crancy__item-input" type="text" name="name" id="name" value="{{ html_decode(old('name')) }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="crancy__item-form--group mg-top-form-20">
                            <label class="crancy__item-label">{{ __('translate.Content Type') }} * </label>
                            <select class="form-select crancy__item-input" name="content_type" id="add_content_type" onchange="toggleContentFieldsAdd()">
                                <option value="video">{{ __('translate.Video') }}</option>
                                <option value="link">{{ __('translate.Link') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12" id="add_video_source_div">
                        <div class="crancy__item-form--group mg-top-form-20">
                            <label class="crancy__item-label">{{ __('translate.Video Source') }} * </label>
                            <select class="form-select crancy__item-input" name="video_source">
                                <option {{ old('video_source') == 'youtube' ? 'selected' : '' }} value="youtube">{{ __('translate.Youtube') }}</option>
                                <option {{ old('video_source') == 'vimeo' ? 'selected' : '' }} value="vimeo">{{ __('translate.Vimeo') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12" id="add_video_link_div">
                        <div class="crancy__item-form--group mg-top-form-20">
                            <label class="crancy__item-label">{{ __('translate.Video Link') }} * </label>
                            <input class="crancy__item-input" type="text" name="video_id" value="{{ old('video_id') }}">
                        </div>
                    </div>

                    <div class="col-12" id="add_embed_url_div" style="display:none;">
                        <div class="crancy__item-form--group mg-top-form-20">
                            <label class="crancy__item-label">{{ __('translate.Embed URL') }} * </label>
                            <input class="crancy__item-input" type="text" name="embed_url" value="{{ old('embed_url') }}" placeholder="e.g., https://docs.google.com/presentation/d/e/EXAMPLE/embed">
                            <small class="form-text text-muted">{{ __('translate.Paste the embed URL for PDFs, PPTs, or other content') }}</small>
                        </div>
                    </div>

                    <input type="hidden" name="video_duration" value="{{ old('video_duration') ?: '1' }}">

                    <div class="col-12">
                        <div class="crancy__item-form--group mg-top-form-20">
                            <label class="crancy__item-label">{{ __('translate.Serial') }} * </label>
                            <input class="crancy__item-input" type="number" name="serial" value="{{ old('serial') }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="crancy__item-form--group mg-top-form-20">
                            <label class="crancy__item-label">{{ __('translate.Description') }} * </label>

                            <textarea class="crancy__item-input crancy__item-textarea summernote"  name="description">{{ html_decode(old('description')) }}</textarea>
                        </div>
                    </div>



                    <div class="col-12">
                        <div class="crancy__item-form--group mg-top-form-20">
                            <label class="crancy__item-label">{{ __('translate.Make it Public') }} </label>
                            <div class="crancy-ptabs__notify-switch  crancy-ptabs__notify-switch--two">
                                <label class="crancy__item-switch">
                                <input {{ old('is_public_lesson') ? 'checked' : '' }} name="is_public_lesson" type="checkbox" >
                                <span class="crancy__item-switch--slide crancy__item-switch--round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="crancy__item-form--group mg-top-form-20">
                            <label class="crancy__item-label">{{ __('translate.Visibility Status') }} </label>
                            <div class="crancy-ptabs__notify-switch  crancy-ptabs__notify-switch--two">
                                <label class="crancy__item-switch">
                                <input {{ old('status') ? 'checked' : '' }} name="status" type="checkbox" >
                                <span class="crancy__item-switch--slide crancy__item-switch--round"></span>
                                </label>
                            </div>
                        </div>
                    </div>



                </div>

            </div>

            <div class="modal-footer ">
                <button type="submit" class="btn btn-primary">{{ __('translate.Save Lesson') }}</button>
            </div>
        </form>
    </div>
</div>



@endsection

@push('style_section')

    <style>
        .tox .tox-promotion,
        .tox-statusbar__branding{
            display: none !important;
        }
    </style>
@endpush

@push('js_section')
    <script src="{{ asset('global/tinymce/js/tinymce/tinymce.min.js') }}"></script>

    <script>

        (function($) {
            "use strict"
            $(document).ready(function () {
                initializeTinyMCE();
                
                // Initialize TinyMCE when modals are shown (for Add lesson modal only)
                $('#curriculumAdd').on('shown.bs.modal', function () {
                    var textareaSelector = '#curriculumAdd .summernote';
                    
                    // Remove existing TinyMCE instances in this modal
                    tinymce.remove(textareaSelector);
                    
                    // Initialize TinyMCE for textareas in this modal
                    initializeTinyMCEModal(textareaSelector);
                });
                
                // Clean up TinyMCE when modals are hidden
                $('#curriculumAdd').on('hidden.bs.modal', function () {
                    var textareaSelector = '#curriculumAdd .summernote';
                    tinymce.remove(textareaSelector);
                });
            });
            
            function initializeTinyMCE() {
                tinymce.init({
                    selector: '.summernote',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount code fullscreen help',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | codesample code sourcecode | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | fullscreen help | removeformat',
                    menubar: false,
                    height: 400,
                    content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }',
                    skin: 'oxide',
                    extended_valid_elements: 'script[language|type|src],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder|allowfullscreen|allow|name]',
                    valid_elements: '*[*]',
                    verify_html: false,
                    cleanup: false,
                    convert_urls: false,
                    remove_script_host: false,
                    allow_script_urls: true,
                    allow_conditional_comments: false,
                    forced_root_block: false,
                    force_br_newlines: false,
                    force_p_newlines: false,
                    entity_encoding: 'raw',
                    setup: function(editor) {
                        editor.ui.registry.addButton('sourcecode', {
                            text: 'Source Code',
                            icon: 'sourcecode',
                            onAction: function() {
                                editor.windowManager.open({
                                    title: 'Source Code',
                                    body: {
                                        type: 'panel',
                                        items: [
                                            {
                                                type: 'textarea',
                                                name: 'code',
                                                multiline: true,
                                                minWidth: 520,
                                                minHeight: 400
                                            }
                                        ]
                                    },
                                    buttons: [
                                        {
                                            type: 'cancel',
                                            text: 'Cancel'
                                        },
                                        {
                                            type: 'submit',
                                            text: 'Save',
                                            primary: true
                                        }
                                    ],
                                    initialData: {
                                        code: editor.getContent({source_view: true})
                                    },
                                    onSubmit: function(api) {
                                        editor.setContent(api.getData().code);
                                        api.close();
                                    }
                                });
                            }
                        });
                    }
                });
            }

            function initializeTinyMCEModal(selector) {
                tinymce.init({
                    selector: selector,
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount code fullscreen help',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | codesample code sourcecode | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | fullscreen help | removeformat',
                    menubar: false,
                    height: 400,
                    content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }',
                    skin: 'oxide',
                    extended_valid_elements: 'script[language|type|src],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder|allowfullscreen|allow|name]',
                    valid_elements: '*[*]',
                    verify_html: false,
                    cleanup: false,
                    convert_urls: false,
                    remove_script_host: false,
                    allow_script_urls: true,
                    allow_conditional_comments: false,
                    forced_root_block: false,
                    force_br_newlines: false,
                    force_p_newlines: false,
                    entity_encoding: 'raw',
                    setup: function(editor) {
                        editor.ui.registry.addButton('sourcecode', {
                            text: 'Source Code',
                            icon: 'sourcecode',
                            onAction: function() {
                                editor.windowManager.open({
                                    title: 'Source Code',
                                    body: {
                                        type: 'panel',
                                        items: [
                                            {
                                                type: 'textarea',
                                                name: 'code',
                                                multiline: true,
                                                minWidth: 520,
                                                minHeight: 400
                                            }
                                        ]
                                    },
                                    buttons: [
                                        {
                                            type: 'cancel',
                                            text: 'Cancel'
                                        },
                                        {
                                            type: 'submit',
                                            text: 'Save',
                                            primary: true
                                        }
                                    ],
                                    initialData: {
                                        code: editor.getContent({source_view: true})
                                    },
                                    onSubmit: function(api) {
                                        editor.setContent(api.getData().code);
                                        api.close();
                                    }
                                });
                            }
                        });
                    }
                });
            }

            // Store lesson data for reference
            var lessonData = {
                @foreach ($module_lessons as $lesson)
                {{ $lesson->id }}: {
                    id: {{ $lesson->id }},
                    course_module_id: {{ $lesson->course_module_id }},
                    video_source: '{{ $lesson->video_source }}',
                    video_id: '{{ addslashes($lesson->video_id) }}',
                    embed_url: '{{ addslashes($lesson->embed_url ?? '') }}',
                    video_duration: {{ $lesson->video_duration ?? 0 }},
                    name: '{{ addslashes($lesson->name) }}',
                    serial: {{ $lesson->serial ?? 0 }},
                    is_public_lesson: '{{ $lesson->is_public_lesson }}',
                    status: '{{ $lesson->status }}',
                    description: {!! json_encode($lesson->description) !!}
                },
                @endforeach
            };

            function toggleEditForm(lessonId) {
                var lesson = lessonData[lessonId];
                if (!lesson) {
                    console.error('Lesson not found:', lessonId);
                    alert('Lesson data not found');
                    return;
                }

                // Show the form
                $('#inlineEditForm').show();
                
                // Populate form fields
                $('#edit_video_source').val(lesson.video_source);
                $('#edit_video_id').val(lesson.video_id);
                $('#edit_embed_url').val(lesson.embed_url);
                $('#edit_video_duration').val(lesson.video_duration);
                $('#edit_name').val(lesson.name);
                $('#edit_serial').val(lesson.serial);
                $('#edit_is_public_lesson').prop('checked', lesson.is_public_lesson === 'enable');
                $('#edit_status').prop('checked', lesson.status === 'enable');
                
                // Set content type and toggle fields
                if (lesson.embed_url) {
                    $('#edit_content_type').val('link');
                    toggleContentFieldsInline();
                } else {
                    $('#edit_content_type').val('video');
                    toggleContentFieldsInline();
                }
                
                // Set form action
                var actionUrl = '{{ url("admin/update-course-lesson") }}/' + lesson.course_module_id + '/' + lesson.id;
                $('#editLessonForm').attr('action', actionUrl);

                // Initialize TinyMCE for inline form
                tinymce.remove('.inline-summernote');
                tinymce.init({
                    selector: '.inline-summernote',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount code fullscreen help',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | codesample code sourcecode | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | fullscreen help | removeformat',
                    menubar: false,
                    height: 400,
                    content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }',
                    skin: 'oxide',
                    extended_valid_elements: 'script[language|type|src],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder|allowfullscreen|allow|name]',
                    valid_elements: '*[*]',
                    verify_html: false,
                    cleanup: false,
                    convert_urls: false,
                    remove_script_host: false,
                    allow_script_urls: true,
                    allow_conditional_comments: false,
                    forced_root_block: false,
                    force_br_newlines: false,
                    force_p_newlines: false,
                    entity_encoding: 'raw',
                    setup: function(editor) {
                        editor.ui.registry.addButton('sourcecode', {
                            text: 'Source Code',
                            icon: 'sourcecode',
                            onAction: function() {
                                editor.windowManager.open({
                                    title: 'Source Code',
                                    body: {
                                        type: 'panel',
                                        items: [
                                            {
                                                type: 'textarea',
                                                name: 'code',
                                                multiline: true,
                                                minWidth: 520,
                                                minHeight: 400
                                            }
                                        ]
                                    },
                                    buttons: [
                                        {
                                            type: 'cancel',
                                            text: 'Cancel'
                                        },
                                        {
                                            type: 'submit',
                                            text: 'Save',
                                            primary: true
                                        }
                                    ],
                                    initialData: {
                                        code: editor.getContent({source_view: true})
                                    },
                                    onSubmit: function(api) {
                                        editor.setContent(api.getData().code);
                                        api.close();
                                    }
                                });
                            }
                        });
                        
                        // Set content after initialization
                        editor.on('init', function() {
                            editor.setContent(lesson.description || '');
                        });
                    }
                });

                // Scroll to form
                $('html, body').animate({
                    scrollTop: $('#inlineEditForm').offset().top
                }, 500);
            }

            // Make functions global
            window.toggleEditForm = toggleEditForm;
            window.cancelEdit = function() {
                $('#inlineEditForm').hide();
                tinymce.remove('.inline-summernote');
            };
        })(jQuery);


        function itemDeleteConfrimation(course_module_id, module_lesson_id){

            $("#item_delect_confirmation").attr("action",'{{ url("admin/destroy-course-lesson/") }}'+"/"+course_module_id + "/" + module_lesson_id)
        }

        // Toggle content fields for inline edit form
        function toggleContentFieldsInline() {
            const contentType = document.getElementById('edit_content_type').value;
            const videoSourceDiv = document.getElementById('edit_video_source_div');
            const videoLinkDiv = document.getElementById('edit_video_link_div');
            const embedUrlDiv = document.getElementById('edit_embed_url_div');

            if (contentType === 'video') {
                if (videoSourceDiv) videoSourceDiv.style.display = 'block';
                if (videoLinkDiv) videoLinkDiv.style.display = 'block';
                if (embedUrlDiv) embedUrlDiv.style.display = 'none';
                
                // Clear embed URL field
                const embedUrlInput = document.getElementById('edit_embed_url');
                if (embedUrlInput) embedUrlInput.value = '';
            } else {
                if (videoSourceDiv) videoSourceDiv.style.display = 'none';
                if (videoLinkDiv) videoLinkDiv.style.display = 'none';
                if (embedUrlDiv) embedUrlDiv.style.display = 'block';
                
                // Clear video fields
                const videoIdInput = document.getElementById('edit_video_id');
                if (videoIdInput) videoIdInput.value = '';
                
                // Set duration to 0 for links
                const durationInput = document.getElementById('edit_video_duration');
                if (durationInput) durationInput.value = '0';
            }
        }

        // Toggle content fields for Add modal
        function toggleContentFieldsAdd() {
            const contentType = document.getElementById('add_content_type').value;
            const videoSourceDiv = document.getElementById('add_video_source_div');
            const videoLinkDiv = document.getElementById('add_video_link_div');
            const embedUrlDiv = document.getElementById('add_embed_url_div');
            const videoDurationDiv = document.getElementById('add_video_duration_div');

            if (contentType === 'video') {
                videoSourceDiv.style.display = 'block';
                videoLinkDiv.style.display = 'block';
                embedUrlDiv.style.display = 'none';
                videoDurationDiv.style.display = 'block';
                
                // Clear embed URL field
                embedUrlDiv.querySelector('input').value = '';
            } else {
                videoSourceDiv.style.display = 'none';
                videoLinkDiv.style.display = 'none';
                embedUrlDiv.style.display = 'block';
                videoDurationDiv.style.display = 'none';
                
                // Clear video fields
                videoLinkDiv.querySelector('input').value = '';
                // Set duration to 0 for links
                videoDurationDiv.querySelector('input').value = '0';
            }
        }
    </script>
@endpush



