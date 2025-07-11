@extends('student.master_layout')
@section('title')
    <title>{{ __('Teacher Support') }}</title>
@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Teacher Support') }}</h3>
    <p class="crancy-header__text">{{ __('Dashboard') }} >> {{ __('Teacher Support') }}</p>
@endsection

@section('body-content')
    <!-- crancy Dashboard -->
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
                                            <h4 class="crancy-product-card__title">{{ __('Teacher Support') }}</h4>

                                            <a href="{{ route('student.teacher-support.create') }}" class="crancy-btn "><span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
																<path d="M8 1V15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
																<path d="M1 8H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
															</svg>
                                            </span> {{ __('New Ticket') }}</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- crancy Table -->
                                <div id="crancy-table__main_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                                    <table class="crancy-table__main crancy-table__main-v3 dataTable no-footer" id="dataTable">
                                        <!-- crancy Table Head -->
                                        <thead class="crancy-table__head">
                                            <tr>

                                                <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                    {{ __('Serial') }}
                                                </th>

                                                <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                    {{ __('Course') }}
                                                </th>

                                                <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                    {{ __('Subject') }}
                                                </th>



                                                <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                    {{ __('Ticket Id') }}
                                                </th>



                                                <th class="crancy-table__column-2 crancy-table__h2 sorting" >
                                                    {{ __('Status') }}
                                                </th>

                                                <th class="crancy-table__column-3 crancy-table__h3 sorting">
                                                    {{ __('Action') }}
                                                </th>

                                            </tr>
                                        </thead>
                                        <!-- crancy Table Body -->
                                        <tbody class="crancy-table__body">
                                            @foreach ($support_tickets as $index => $support_ticket)

                                                <tr class="odd">

                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        <h4 class="crancy-table__product-title">{{ ++$index }}</h4>
                                                    </td>

                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        <h4 class="crancy-table__product-title">{{ html_decode($support_ticket->subject) }}</h4>
                                                    </td>

                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        <h4 class="crancy-table__product-title">{{ html_decode($support_ticket?->course?->title) }}</h4>
                                                    </td>



                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        <h4 class="crancy-table__product-title">#{{ $support_ticket->ticket_id }}</h4>
                                                    </td>


                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        @if ($support_ticket->status == 'open')
                                                            <span class="badge bg-success text-white">{{ __('In-progress') }}</span>
                                                        @else
                                                            <span class="badge bg-danger text-white">{{ __('Closed') }}</span>
                                                        @endif
                                                    </td>

                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        <a href="{{ route('student.teacher-support.show', $support_ticket->ticket_id) }}" class="crancy-btn"><i class="far fa-message"></i> {{ __('Chat') }}</a>
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
    </section>
    <!-- End crancy Dashboard -->

@endsection
