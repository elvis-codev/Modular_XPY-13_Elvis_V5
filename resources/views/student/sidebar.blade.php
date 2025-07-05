

@php
    $auth_user = Auth::guard('web')->user();
@endphp
<!-- Main Menu -->
<div class="admin-menu__one crancy-sidebar-padding mg-top-20">

    <!-- Nav Menu -->
    <div class="menu-bar">
        <ul id="CrancyMenu" class="menu-bar__one crancy-dashboard-menu">



            <li class="{{ Route::is('student.enrolled-courses') || Route::is('student.enrolled-course') ? 'active' : '' }}"><a class="collapsed" href="{{ route('student.enrolled-courses') }}"><span class="menu-bar__text">
                <span class="crancy-menu-icon crancy-svg-icon__v1">

                    <svg class="crancy-svg-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 21C2.5 20.0909 4.4 18.2727 8 18.2727C11.6 18.2727 13.5 16.0909 14 15M8 8V5C8 3.89543 8.89543 3 10 3H20C21.1046 3 22 3.89543 22 5V13C22 14.1046 21.1046 15 20 15H16.7397M12 7H18M10 13C10 14.1046 9.10457 15 8 15C6.89543 15 6 14.1046 6 13C6 11.8954 6.89543 11 8 11C9.10457 11 10 11.8954 10 13Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M15 11H18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>

                </span>
                <span class="menu-bar__name">{{ __('translate.Enrolled Courses') }}</span></span></a>
            </li>





            <li class="{{ Route::is('student.edit-profile') ? 'active' : '' }}"><a class="collapsed" href="{{ route('student.edit-profile') }}">
                <span class="menu-bar__text">
                    <span class="crancy-menu-icon crancy-svg-icon__v1">
                       <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <ellipse cx="12" cy="17.5" rx="7" ry="3.5" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                        <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                        </svg>


                    </span>
                    <span class="menu-bar__name">{{ __('translate.Edit Profile') }}</span>
                </span>

                </a>
            </li>

            <li class="{{ Route::is('student.change-password') ? 'active' : '' }}"><a class="collapsed" href="{{ route('student.change-password') }}">
                <span class="menu-bar__text">
                    <span class="crancy-menu-icon crancy-svg-icon__v1">
                      <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 7H5M13 7C15.2091 7 17 8.79086 17 11V17C17 19.2091 15.2091 21 13 21H5C2.79086 21 1 19.2091 1 17V11C1 8.79086 2.79086 7 5 7M13 7V5C13 2.79086 11.2091 1 9 1C6.79086 1 5 2.79086 5 5V7M9 15V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>


                    </span>
                    <span class="menu-bar__name">{{ __('translate.Change Password') }}</span>
                </span>

                </a>
            </li>






            <li class="{{ Route::is('student.support-ticket.*') ? 'active' : '' }}"><a class="collapsed" href="{{ route('student.support-ticket.index') }}">
                <span class="menu-bar__text">
                    <span class="crancy-menu-icon crancy-svg-icon__v1">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.2419 12.2555C10.2419 10.7377 9.0123 9.50732 7.49538 9.50732C5.97848 9.50732 4.74878 10.7377 4.74878 12.2555C4.74878 13.7732 5.97848 15.0036 7.49538 15.0036C9.0123 15.0036 10.2419 13.7732 10.2419 12.2555Z" stroke="currentColor" stroke-width="1.5"/>
<path d="M12.9881 21.9985H2.00171C2.00171 19.7909 4.46111 17.5016 7.49491 17.5016C10.5287 17.5016 12.9881 19.7909 12.9881 21.9985Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M15.4944 7.01221H15.5025M18.4944 7.01221H18.5025" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"/>
<path d="M16.9799 12.0102C19.7514 12.0102 21.9982 9.7697 21.9982 7.00586C21.9982 4.24201 19.7514 2.00146 16.9799 2.00146C14.2084 2.00146 11.9617 4.24201 11.9617 7.00586C11.9617 8.71617 12.9965 10.248 13.9497 10.9756C13.88 11.7125 13.5228 12.4935 13.0049 13.0032C12.9133 13.0933 14.243 12.7049 15.812 11.8587C16.2939 11.9708 16.3293 12.0102 16.9799 12.0102Z" stroke="currentColor" stroke-width="1.5"/>
</svg>


                    </span>
                    <span class="menu-bar__name">{{ __('translate.Support Ticket') }}</span>
                </span>

                </a>
            </li>








            <li><a href="{{ route('student.logout') }}" class="collapsed"><span class="menu-bar__text">
                <span class="crancy-menu-icon crancy-svg-icon__v1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 14L21.2929 12.7071C21.6834 12.3166 21.6834 11.6834 21.2929 11.2929L20 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M21 12H13M6 20C3.79086 20 2 18.2091 2 16V8C2 5.79086 3.79086 4 6 4M6 20C8.20914 20 10 18.2091 10 16V8C10 5.79086 8.20914 4 6 4M6 20H14C16.2091 20 18 18.2091 18 16M6 4H14C16.2091 4 18 5.79086 18 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>

                </span>
                <span class="menu-bar__name">{{ __('translate.Logout') }}</span></span></a>
            </li>


        </ul>
    </div>

    <!-- End Nav Menu -->
</div>
