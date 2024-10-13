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
        });

    Route::group(['middleware' => 'auth:sanctum'],function(){
        Route::post('/logout',[LoginController::class,'logout'])->name('logout');

        Route::controller(StudentController::class)
            ->prefix('student')
            ->group(function(){
                Route::get('/{student}','show')->name('profile.student');
                Route::get('/all','index')->name('profile.all');
            });

        Route::controller(SectionController::class)
            ->prefix('class')
            ->middleware(['ability:teacher'])
            ->group(function(){
                Route::get('/all','index')->name('class.index');
                Route::get('/{id}','show')->name('class.show');
                Route::post('/create','store')->name('class.store');
                Route::put('/edit/{id}','update')->name('class.update');
                Route::delete('/destroy/{id}','destroy')->name('class.destroy');
                Route::post('/add-students','addStudents')->name('class.add'); 
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

