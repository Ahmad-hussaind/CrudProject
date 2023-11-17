<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\DepartmentController;
use App\http\Controllers\EmployeeController;
use App\http\Controllers\TempImagesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Department Routes

        Route::get('/department',[DepartmentController::class,'index'])->name('department.index');
        Route::get('/department/create',[DepartmentController::class,'create'])->name('department.create');
        Route::post('/department/store',[DepartmentController::class,'store'])->name('department.store');
        Route::get('/departments/{department}/edit',[DepartmentController::class,'edit'])->name('department.edit');
        Route::put('/departments/{department}',[DepartmentController::class,'update'])->name('department.update');
        Route::delete('/departments/{department}',[DepartmentController::class,'destroy'])->name('department.delete');

//    Employee Routes

        Route::get('/employees',[EmployeeController::class,'index'])->name('employees.index');
        Route::get('/employees/create',[EmployeeController::class,'create'])->name('employees.create');
        Route::post('/employees/store',[EmployeeController::class,'store'])->name('employees.store');
        Route::get('/employees/{employee}/edit',[EmployeeController::class,'edit'])->name('employees.edit');
        Route::put('/employees/{employee}',[EmployeeController::class,'update'])->name('employees.update');
        Route::delete('/employees/{employee}',[EmployeeController::class,'destroy'])->name('employees.delete');


        // temp-images.create
        Route::post('/upload-temp-image',[TempImagesController::class,'create'])->name('temp-images.create');

