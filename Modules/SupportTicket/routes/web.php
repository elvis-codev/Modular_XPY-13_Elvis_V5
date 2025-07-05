<?php

use Illuminate\Support\Facades\Route;
use Modules\SupportTicket\App\Http\Controllers\CourseQuery\Student\CourseQueryController as StudentCourseQueryController;
use Modules\SupportTicket\App\Http\Controllers\CourseQuery\Instructor\CourseQueryController as InstructorCourseQueryController;
use Modules\SupportTicket\App\Http\Controllers\Support\Admin\SupportTicketController as AdminSupportTicketController;
use Modules\SupportTicket\App\Http\Controllers\Support\Student\SupportTicketController as StudentSupportTicketController;
use Modules\SupportTicket\App\Http\Controllers\Support\Instructor\SupportTicketController as InstructorSupportTicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::group(['as' => 'student.', 'prefix' => 'student', 'middleware' => ['auth:web', 'HtmlSpecialchars', 'MaintenanceMode']], function(){

    Route::resource('support-ticket', StudentSupportTicketController::class);
    Route::post('support-ticket-message/{id}', [StudentSupportTicketController::class, 'support_ticket_message'])->name('support-ticket-message');

    Route::get('teacher-support', function() { abort(404); })->name('teacher-support.index');
    Route::get('teacher-support/create', function() { abort(404); })->name('teacher-support.create');
    Route::post('teacher-support', function() { abort(404); })->name('teacher-support.store');
    Route::get('teacher-support/{id}', function() { abort(404); })->name('teacher-support.show');
    Route::get('teacher-support/{id}/edit', function() { abort(404); })->name('teacher-support.edit');
    Route::put('teacher-support/{id}', function() { abort(404); })->name('teacher-support.update');
    Route::delete('teacher-support/{id}', function() { abort(404); })->name('teacher-support.destroy');
    Route::post('teacher-support-message/{id}', function() { abort(404); })->name('teacher-support-message');

});


Route::group(['as' => 'instructor.', 'prefix' => 'instructor', 'middleware' => ['auth:web', 'HtmlSpecialchars', 'MaintenanceMode']], function(){

    Route::resource('support-ticket', InstructorSupportTicketController::class);
    Route::post('support-ticket-message/{id}', [InstructorSupportTicketController::class, 'support_ticket_message'])->name('support-ticket-message');


    Route::get('teacher-supports', [InstructorCourseQueryController::class, 'index'])->name('teacher-supports');
    Route::get('teacher-support/{id}', [InstructorCourseQueryController::class, 'show'])->name('teacher-support');
    Route::post('teacher-support-message/{id}', [InstructorCourseQueryController::class, 'support_ticket_message'])->name('teacher-support-message');
    Route::put('teacher-support-close/{id}', [InstructorCourseQueryController::class, 'close'])->name('teacher-support-close');

});


Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth:admin', 'HtmlSpecialchars', 'MaintenanceMode']], function(){

    Route::get('support-tickets', [AdminSupportTicketController::class, 'index'])->name('support-tickets');
    Route::get('support-ticket/{id}', [AdminSupportTicketController::class, 'show'])->name('support-ticket');
    Route::post('support-ticket-message/{id}', [AdminSupportTicketController::class, 'support_ticket_message'])->name('support-ticket-message');
    Route::delete('support-ticket-delete/{id}', [AdminSupportTicketController::class, 'destroy'])->name('support-ticket-delete');
    Route::put('support-ticket-close/{id}', [AdminSupportTicketController::class, 'close'])->name('support-ticket-close');

});

