<?php

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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

//Route::get('/home', 'HomeController@index');

Route::resource('users', 'UserController');
Route::get('/verifyOtp', 'UserController@verifyOtp');
Route::post('/verifyOtp', 'UserController@verifyOtp');

/*
 * 03-21-2017
 * Attndance Routes
 * Belga
 */
Route::group(['prefix' => 'attendance'], function () {

    Route::get('/today',                ['uses' => 'AttendanceController@today',                'as' => 'today']);
    Route::post('/log_form',            ['uses' => 'AttendanceController@log_form',             'as' => 'log_form']);
    Route::post('/log_user',            ['uses' => 'AttendanceController@log_user',             'as' => 'log_user']);
    Route::post('/check_date_for_logs', ['uses' => 'AttendanceController@check_date_for_logs',  'as' => 'check_date_for_logs']);

    /*
    * 03-23-2017
    * Leave Routes
    * Belga
    */
    Route::get('/leave',            ['uses' => 'AttendanceController@leave',            'as' => 'leave']);
    Route::post('/leave_list',      ['uses' => 'AttendanceController@leave_list',       'as' => 'leave_list']);
    Route::post('/delete_leave',    ['uses' => 'AttendanceController@delete_leave',     'as' => 'delete_leave']);
    Route::get('/apply_leave',      ['uses' => 'AttendanceController@apply_leave',      'as' => 'apply_leave']);
    Route::post('/request_leave',   ['uses' => 'AttendanceController@request_leave',    'as' => 'request_leave']);


    Route::get('/summary',              ['uses' => 'AttendanceController@summary',              'as' => 'summary']);
    Route::post('/summary_list',        ['uses' => 'AttendanceController@summary_list',         'as' => 'summary_list']);
    Route::post('/delete_attendance',   ['uses' => 'AttendanceController@delete_attendance',    'as' => 'delete_attendance']);
});

Route::group(['prefix' => 'dashboard'], function (){

    Route::get('/', function(){
        
        return view('attendance.dashboard.index');

    })->name('dashboard');

    Route::get('/calendar', 'CalendarController@calendar')->name('calendar');

    Route::post('/attendance/calendarUser', 'CalendarController@calendarUser')->name('calendarUser');

    Route::post('/attendance/calendarAdmin', 'CalendarController@calendarAdmin')->name('calendarAdmin');

    Route::post('/attendance/isapproveAttendance/{id}', 'CalendarController@isapproveAttendance')->name('isapproveAttendance');

    Route::post('/attendance/isapproveOvertime/{id}', 'CalendarController@isapproveOvertime')->name('isapproveOvertime');

    Route::post('/attendance/isapproveLeave/{id}', 'CalendarController@isapproveLeave')->name('isapproveLeave');

    Route::get('/test', 'CalendarController@index');
    
});

Route::group(['prefix' => 'announcement'], function(){
    
    Route::get('/', 'AnnouncementController@index')->name('announcement');

    Route::get('/create', 'AnnouncementController@create')->name('createAnnouncement');

    Route::get('/show/{announcement}', 'AnnouncementController@show')->name('showAnnouncement');

    Route::post('/store', 'AnnouncementController@store')->name('storeAnnouncement');

    Route::get('/{announcement}/edit', 'AnnouncementController@edit')->name('editAnnouncement');

    Route::post('/{announcement}/update', 'AnnouncementController@update')->name('updateAnnouncement');

    Route::get('/{announcement}/destroy', 'AnnouncementController@destroy')->name('destroyAnnouncement');

});

