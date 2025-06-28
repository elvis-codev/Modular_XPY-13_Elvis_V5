@extends('admin.master_layout')
@section('title')
    <title>{{ __('translate.School List') }}</title>
@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('translate.School List') }}</h3>
    <p class="crancy-header__text">{{ __('translate.Manage Schools') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12">
                <div class="crancy-body">
                    <div class="crancy-dsinner">
                        <div class="crancy-table crancy-table--v3 mg-top-30">
                            <div class="crancy-customer-filter">
                                <div class="crancy-customer-filter__single crancy-customer-filter__single--csearch d-flex items-center justify-between create_new_btn_box">
                                    <div class="crancy-header__form crancy-header__form--customer create_new_btn_inline_box">
                                        <h4 class="crancy-product-card__title">{{ __('translate.School List') }}</h4>
                                        <a href="{{ route('admin.schools.create') }}" class="crancy-btn">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M8 1V15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M1 8H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span> 
                                            {{ __('translate.Create School') }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div id="crancy-table__main_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <table class="crancy-table__main crancy-table__main-v3 dataTable no-footer" id="dataTable">
                                    <thead class="crancy-table__head">
                                        <tr>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('translate.Serial') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('translate.Logo') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('translate.Name') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('translate.Students') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('translate.Instructors') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('translate.Status') }}</th>
                                            <th class="crancy-table__column-3 crancy-table__h3 sorting">{{ __('translate.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="crancy-table__body">
                                        @foreach ($schools as $index => $school)
                                            <tr class="odd">
                                                <td class="crancy-table__column-2 crancy-table__data-2">
                                                    <h4 class="crancy-table__product-title">{{ ++$index }}</h4>
                                                </td>

                                                <td class="crancy-table__column-2 crancy-table__data-2">
                                                    <div class="crancy-table__product--thumb">
                                                        <img src="{{ $school->logo_url }}" alt="{{ $school->name }}" style="width: 60px; height: 40px; object-fit: cover; border-radius: 5px;">
                                                    </div>
                                                </td>

                                                <td class="crancy-table__column-2 crancy-table__data-2">
                                                    <h4 class="crancy-table__product-title">{{ $school->name }}</h4>
                                                </td>

                                                <td class="crancy-table__column-2 crancy-table__data-2">
                                                    <h4 class="crancy-table__product-title">
                                                        <span class="badge bg-primary">{{ $school->total_students }}</span>
                                                    </h4>
                                                </td>

                                                <td class="crancy-table__column-2 crancy-table__data-2">
                                                    <h4 class="crancy-table__product-title">
                                                        <span class="badge bg-info">{{ $school->total_instructors }}</span>
                                                    </h4>
                                                </td>

                                                <td class="crancy-table__column-2 crancy-table__data-2">
                                                    @if ($school->status == 'active')
                                                        <span class="badge badge--success">{{ __('translate.Active') }}</span>
                                                    @else
                                                        <span class="badge badge--danger">{{ __('translate.Inactive') }}</span>
                                                    @endif
                                                </td>

                                                <td class="crancy-table__column-2 crancy-table__data-2">
                                                    <div class="dropdown">
                                                        <button class="crancy-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                            {{ __('translate.Action') }}
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="{{ route('admin.schools.show', $school->id) }}" class="dropdown-item">
                                                                    <i class="fas fa-eye"></i> {{ __('translate.View') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('admin.schools.edit', $school->id) }}" class="dropdown-item">
                                                                    <i class="fas fa-edit"></i> {{ __('translate.Edit') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a onclick="schoolStatusChange({{ $school->id }})" href="javascript:;" class="dropdown-item">
                                                                    <i class="fas fa-toggle-on"></i> {{ __('translate.Change Status') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a onclick="schoolDeleteConfrimation({{ $school->id }})" href="javascript:;" data-bs-toggle="modal" data-bs-target="#exampleModal" class="dropdown-item text-danger">
                                                                    <i class="fas fa-trash"></i> {{ __('translate.Delete') }}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('translate.Delete Confirmation') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ __('translate.Are you really want to delete this item?') }}</p>
            </div>
            <div class="modal-footer">
                <form action="" id="school_delect_confirmation" method="POST">
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
    "use strict";
    function schoolDeleteConfrimation(id){
        $("#school_delect_confirmation").attr("action",'{{ url("admin/schools/") }}'+"/"+id)
    }

    function schoolStatusChange(id){
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/admin/school-status/') }}"+"/"+id,
            success:function(response){
                toastr.success(response)
                location.reload();
            },
            error:function(err){
                console.log(err);
            }
        })
    }
</script>
@endpush