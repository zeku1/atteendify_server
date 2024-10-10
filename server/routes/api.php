<?php

use App\Http\Controllers\Api\V1\ClassSessionController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\SectionController;
use App\Http\Controllers\Api\V1\StudentController;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'],function(){

    Route::controller(LoginController::class)
        ->group(function(){
            Route::post('/register','register')->name('register');
            Route::post('/login','login')->name('login');
            Route::post('/logout','logout')->name('logout');
        });

    Route::group(['middleware' => 'auth:sanctum'],function(){

        Route::controller(StudentController::class)
        ->prefix('student')
        ->group(function(){
            Route::get('/profile/{id}','show')->name('profile');
            Route::get('/all-student','index')->name('profile');
        });

        Route::controller(SectionController::class)
        ->prefix('class')
        ->group(function(){
            Route::post('/add-students','addStudents')->name('class.add');
            Route::post('/store','store')->name('class.store');
            Route::get('/index/{id}','index')->name('class.index');
            Route::get('/show/{id}','show')->name('class.show');
            Route::put('/edit/{id}','update')->name('class.update');
            Route::delete('/destroy/{id}','destroy')->name('class.destroy');
        });

        Route::controller(ClassSessionController::class)
        ->prefix('session')
        ->group(function(){
            Route::post('/open-session','start')->name('session.open');
            Route::post('/end-session','end')->name('session.end');
            Route::post('/add-student/bulk','addBulkStudent')->name('session.addStudent.bulk');
            Route::post('/add-student','addStudent')->name('session.addStudent');
            Route::post('/join-session','joinSession')->name('session.joinSession');
        });
    });

});

