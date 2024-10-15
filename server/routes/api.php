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
            Route::get('/verify-email/{token}','verify')->name('verify');
            Route::post('/login','login')->name('login');
        });

    Route::group(['middleware' => 'auth:sanctum'],function(){
        Route::post('/logout',[LoginController::class,'logout'])->name('logout');

        Route::controller(StudentController::class)
            ->prefix('student')
            ->group(function(){
                Route::get('/{student}','show')->name('profile.student');
                Route::get('/','index')->name('profile.all');
            });

        Route::get('class/show/{id}',[SectionController::class,'show'])->name('class.show');

        Route::controller(SectionController::class)
            ->prefix('class')
            // ->middleware(['ability:teacher'])
            ->group(function(){
                Route::get('/{id}','getByTeacher')->name('class.index');
                Route::post('/create','store')->name('class.store');
                Route::put('/edit/{id}','update')->name('class.update');
                Route::delete('/destroy/{id}','destroy')->name('class.destroy');
                Route::post('/add-students','addStudents')->name('class.add'); 
            });

        Route::controller(ClassSessionController::class)
            ->prefix('session')
            ->group(function(){
                Route::post('/open-session/{id}','start')->name('session.open');
                Route::post('/end-session','end')->name('session.end');
                Route::post('/add-student','addStudent')->name('session.addStudent');
                Route::post('/join-session','joinSession')->name('session.joinSession');
                Route::post('/{$classSession}','show')->name('session.show');
            });
    });

});

