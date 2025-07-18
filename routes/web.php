<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SchoolController;

use App\Http\Controllers\Admin\ProfileController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;

use App\Http\Controllers\Admin\FrontEndManagementController;
use App\Http\Controllers\Auth\LoginController as StudentLoginController;
use App\Http\Controllers\Auth\RegisterController as StudentRegisterController;


use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Instructor\ProfileController as InstructorProfileController;


Route::group(['middleware' => [ 'HtmlSpecialchars', 'MaintenanceMode']], function () {

    // Redirect root to student login
    Route::get('/', function () {
        return redirect()->route('student.login');
    })->name('home');

    // Block access to landing page - redirect to student login
    Route::get('/landing', function () {
        return redirect()->route('student.login');
    });
    Route::get('/index', function () {
        return redirect()->route('student.login');
    });

    // Block all landing page routes - redirect to student login
    Route::get('/about-us', function () {
        return redirect()->route('student.login');
    })->name('about-us');

    Route::get('/blogs', function () {
        return redirect()->route('student.login');
    })->name('blogs');
    Route::get('/blog/{slug}', function () {
        return redirect()->route('student.login');
    })->name('blog');
    Route::post('/store-blog-comment/{id}', function () {
        return redirect()->route('student.login');
    })->name('store-blog-comment');

    Route::get('/faq', function () {
        return redirect()->route('student.login');
    })->name('faq');

    Route::get('/privacy-policy', function () {
        return redirect()->route('student.login');
    })->name('privacy-policy');
    Route::get('/terms-conditions', function () {
        return redirect()->route('student.login');
    })->name('terms-conditions');

    Route::get('/custom-page/{slug}', function () {
        return redirect()->route('student.login');
    })->name('custom-page');

    Route::get('/contact-us', function () {
        return redirect()->route('student.login');
    })->name('contact-us');

    // Keep functional routes but ensure they redirect back to student login
    Route::get('/language-switcher', [HomeController::class,  'language_switcher'])->name('language-switcher');
    Route::get('/currency-switcher', [HomeController::class, 'currency_switcher'])->name('currency-switcher');


    Route::get('/download-file/{file}', [HomeController::class, 'download_file'])->name('download-file');


    Auth::routes();

    Route::group(['as' => 'student.', 'prefix' => 'student'], function(){
        Route::controller(StudentLoginController::class)->group(function () {

            Route::get('/login', 'custom_login_page')->name('login');
            Route::post('/store-login', 'store_login')->name('store-login');
            Route::get('/logout', 'student_logout')->name('logout');

            Route::get('login/google', 'redirect_to_google')->name('login-google');
            Route::get('/callback/google', 'google_callback')->name('callback-google');

            Route::get('login/facebook', 'redirect_to_facebook')->name('login-facebook');
            Route::get('/callback/facebook', 'facebook_callback')->name('callback-facebook');

            Route::get('/forget-password', 'custom_forget_page')->name('forget-password');

            Route::post('/send-forget-password', 'send_custom_forget_pass')->name('send-forget-password');
            Route::get('/reset-password', 'custom_reset_password')->name('reset-password');
            Route::post('/store-reset-password/{token}', 'store_reset_password')->name('store-reset-password');



        });
    });


    Route::group(['as' => 'student.', 'prefix' => 'student'], function(){

        Route::group(['middleware' => 'auth:web'],function () {

            Route::get('/dashboard', function() { abort(404); })->name('dashboard');

            Route::get('/edit-profile', [StudentProfileController::class, 'edit_profile'])->name('edit-profile');
            Route::put('/update-profile', [StudentProfileController::class, 'update_profile'])->name('update-profile');

            Route::get('/change-password', [StudentProfileController::class, 'change_password'])->name('change-password');
            Route::put('/update-password', [StudentProfileController::class, 'update_password'])->name('update-password');


            Route::get('/become-an-instructor', function() { abort(404); })->name('become-an-instructor');
            Route::post('/instructor-application', function() { abort(404); })->name('instructor-application');

            Route::get('/account-delete', function() { abort(404); })->name('account-delete');
            Route::delete('/confirm-account-delete', function() { abort(404); })->name('confirm-account-delete');


        });

    });


    Route::group(['as' => 'instructor.', 'prefix' => 'instructor'], function(){

        Route::group(['middleware' => ['auth:web', 'CheckInstructor']],function () {

            Route::get('/dashboard', [InstructorProfileController::class, 'dashboard'])->name('dashboard');

            Route::get('/edit-profile', [InstructorProfileController::class, 'edit_profile'])->name('edit-profile');
            Route::put('/update-profile', [InstructorProfileController::class, 'update_profile'])->name('update-profile');

            Route::get('/instructor-profile', [InstructorProfileController::class, 'instructor_profile'])->name('instructor-profile');
            Route::put('/update-instructor-profile', [InstructorProfileController::class, 'update_instructor_profile'])->name('update-instructor-profile');

            Route::get('/change-password', [InstructorProfileController::class, 'change_password'])->name('change-password');
            Route::put('/update-password', [InstructorProfileController::class, 'update_password'])->name('update-password');

            Route::get('/account-delete', [InstructorProfileController::class, 'account_delete'])->name('account-delete');
            Route::delete('/confirm-account-delete', [InstructorProfileController::class, 'confirm_account_delete'])->name('confirm-account-delete');

        });


    });

});



Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){

    Route::get('login', [LoginController::class, 'custom_login_page'])->name('login');
    Route::post('store-login', [LoginController::class, 'store_login'])->name('store-login');
    Route::post('store-register', [LoginController::class, 'store_register'])->name('store-register');
    Route::post('logout', [LoginController::class, 'admin_logout'])->name('logout');


    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', [DashboardController::class, 'dashboard']);
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::controller(ProfileController::class)->group(function(){
            Route::get('edit-profile', 'edit_profile')->name('edit-profile');
            Route::put('profile-update', 'profile_update')->name('profile-update');
            Route::put('update-password', 'update_password')->name('update-password');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('user-list', 'user_list')->name('user-list');
            Route::get('pending-user', 'pending_user')->name('pending-user');
            Route::get('user-show/{id}', 'user_show')->name('user-show');
            Route::delete('user-delete/{id}', 'user_destroy')->name('user-delete');
            Route::put('user-status/{id}', 'user_status')->name('user-status');
            Route::put('user-update/{id}', 'update')->name('user-update');
            Route::post('assign-course-to-student', 'assignCourseToStudent')->name('assign-course-to-student');
            Route::post('assign-school-to-student', 'assignSchoolToStudent')->name('assign-school-to-student');
            Route::post('create-student', 'createStudentWithSchool')->name('create-student');
            Route::post('bulk-import-students', 'bulkImportStudentsWithSchool')->name('bulk-import-students');

            Route::get('seller-list', 'seller_list')->name('seller-list');
            Route::get('pending-seller', 'pending_seller')->name('pending-seller');
            Route::get('seller-show/{id}', 'seller_show')->name('seller-show');

            Route::get('seller-joining-request', 'seller_joining_request')->name('seller-joining-request');
            Route::get('seller-joining-detail/{id}', 'seller_joining_detail')->name('seller-joining-detail');
            Route::put('seller-joining-approval/{id}', 'seller_joining_approval')->name('seller-joining-approval');
            Route::put('seller-joining-reject/{id}', 'seller_joining_reject')->name('seller-joining-reject');

        });

        // School Management
        Route::controller(SchoolController::class)->group(function () {
            Route::get('schools', 'index')->name('schools.index');
            Route::get('schools/create', 'create')->name('schools.create');
            Route::post('schools', 'store')->name('schools.store');
            Route::get('schools/{school}', 'show')->name('schools.show');
            Route::get('schools/{school}/edit', 'edit')->name('schools.edit');
            Route::put('schools/{school}', 'update')->name('schools.update');
            Route::delete('schools/{school}', 'destroy')->name('schools.destroy');
            Route::put('school-status/{id}', 'school_status')->name('school-status');
        });

         // Frontend Management
         Route::controller(FrontEndManagementController::class)->name('front-end.')->group(function () {
            Route::get('/frontend-section', 'index')->name('frontend-section');
            Route::get('/section/{id}', 'section')->name('section');
            Route::put('store/{key}/{id?}', 'store')->name('store');
        });


    });


});








