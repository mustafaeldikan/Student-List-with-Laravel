<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;


Route::get('/', [StudentController::class, 'index'])->name('students_index');
Route::post('/', [StudentController::class, 'store'])->name('student_store');
Route::put('/', [StudentController::class, 'update'])->name('student_update');
Route::delete('/', [StudentController::class, 'destroy'])->name('student_delete');

// Route::resource(StudentController::class,'index');
