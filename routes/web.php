<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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



Route::get('/clear', function () {
    Artisan::call('config:clear');
     Artisan::call('route:clear');
     Artisan::call('view:clear');
     Artisan::call('cache:clear');
    return ' cleared';
});


Auth::routes();

Route::get('/', 'ExamController@index')->name('index');
// Route::get('/', [ExamFormPublicController::class,'index'])->name('home'); 
Route::get('/forms', 'ExamController@index')->name('forms.index'); 
Route::get('/forms/{examForm:slug}', 'ExamController@show')->name('forms.show'); 

Route::middleware('auth')->group(function(){ 
    Route::get('/submissions/create/{examForm}', 'SubmissionController@create')->name('submissions.create'); 
    Route::post('/submissions/{examForm}', 'SubmissionController@store')->name('submissions.store'); 
    Route::get('/submissions/{submission}', 'SubmissionController@show')->name('submissions.show'); 
    Route::post('/submissions/{submission}/pay', 'PaymentController@createIntent')->name('payments.createIntent');
    Route::get('/payment/success/{submission}', 'PaymentController@success')->name('payments.success');
    Route::get('/payment/error', 'PaymentController@error')->name('payments.error'); 
});

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {
    Route::group([ 'middleware' => ['admin']], function () {
        Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');
        Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles']);
        Route::resource('users', 'Backend\UsersController', ['names' => 'admin.users']);
        Route::resource('exam-forms', 'Backend\ExamFormController',['names' => 'admin.exam_forms']);
        Route::prefix('exam-forms/{examForm}')->group(function () {
            Route::resource('form-fields', 'Backend\FormFieldController',['names' => 'admin.form_fields']);
        });
        Route::resource('admins', 'Backend\AdminsController', ['names' => 'admin.admins']);
        Route::resource('submissions', 'Backend\SubmissionsController', ['names' => 'admin.submissions']);
    });
    // Login Routes
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout.submit');

    // Forget Password Routes
    Route::get('/password/reset', 'Backend\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset/submit', 'Backend\Auth\ForgetPasswordController@reset')->name('admin.password.update');
});
