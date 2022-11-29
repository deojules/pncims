<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {

    if (Auth::guard('student')->user())

        return redirect('survey');

    elseif (Auth::user())

        return redirect('survey');

    else

        return redirect('login');

});

// Route::get('/home', function () { return redirect('/'); });

Route::post('login', [LoginController::class, 'postLogin'])->name('login');

Route::get('/bcrypt/{str}', function ($str) { return bcrypt($str); })->name('bcrypt');


Route::controller(HomeController::class)->middleware('PreventBack')->group(function() {


    Route::get('/dept_qualitative/{acronym}', 'dept_quali')->name('dept_quali')->middleware('auth');

    Route::post('/dept_qualitative/{acronym}/update', 'update_dept_quali')->name('update_dept_quali')->middleware('auth');

    Route::get('/survey', 'index')->name('index');

    Route::post('/survey/search', 'search')->name('search');

    Route::get('/{acronym}', 'get_department')->name('department');

    Route::post('/survey/start', 'start_survey')->name('survey.start');

    Route::post('/survey/save', 'save_survey')->name('survey.save');

    Route::post('/survey/validatemessage', 'validatemessage');

});



Route::controller(AdminController::class)->middleware('PreventBack')->prefix('admin')->name('admin.')->group(function() {

    Route::get('/dashboard', 'index')->name('index');

    Route::post('/dashboard', 'index')->name('search');

    Route::get('/service-data', 'get_service')->name('service');

    Route::post('/service-data/department', 'service_department')->name('service.department');

    Route::post('/service-data/add', 'add_service')->name('service.add');

    Route::post('service-data/delete', 'destroy_service')->name('service.delete');

    Route::get('/summary-of-clients', 'get_clients')->name('clients');

    Route::post('/summary-of-clients/update', 'update_clients')->name('clients.update');

    Route::get('/quantitative-data', 'get_quantitative')->name('quantitative');

    Route::post('/quantitative-data/update', 'update_quantitative')->name('quantitative.update');

    Route::get('/qualitative-data', 'get_qualitative')->name('qualitative');

    Route::post('/qualitative-data/update', 'update_qualitative')->name('qualitative.update');

    Route::get('/responses', 'get_responses')->name('responses');

    Route::post('/responses/update', 'update_responses')->name('responses.update');

    Route::get('/overall-ratings', 'get_overallRatings')->name('overall');

    Route::post('/overall-ratings/update', 'update_overallRatings')->name('overall.update');

});

Route::controller(StudentController::class)->prefix('student')->name('student.')->group(function() {

    Route::post('/login', 'postlogin')->name('login');

    Route::post('/logout', 'logout')->name('logout');

});


Route::controller(GuestController::class)->prefix('guest')->name('guest.')->group(function() {

    Route::post('/login', 'Guestlogin')->name('login');
    Route::post('/logout', 'logout')->name('logout');

});
