<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(["auth"])->group(function () {
   Route::get('/', function () {
      return view('home');
   });

   Route::group(['middleware' => ['role:admin']], function () {
      Route::prefix('employee')->group(function () {
         Route::get('/', [EmployeeController::class, 'index'])->name('employee');
         Route::get('detail/{employee:id}', [EmployeeController::class, 'detail'])->name('employee.detail');
         Route::get('create', [EmployeeController::class, 'create'])->name('employee.create');
         Route::post('store', [EmployeeController::class, 'store'])->name('employee.store');
         Route::put('update', [EmployeeController::class, 'update'])->name('employee.update');
         Route::put('update/picture', [EmployeeController::class, 'updatePicture'])->name('employee.update.picture');
         Route::get('export', [EmployeeController::class, 'export'])->name('employee.export');
         Route::get('import', [EmployeeController::class, 'formImport'])->name('employee.import');
         Route::post('import', [EmployeeController::class, 'import'])->name('employee.import');
      });
      Route::prefix('department')->group(function () {
         Route::get('/', [DepartmentController::class, 'index'])->name('department');
         Route::post('store', [DepartmentController::class, 'store'])->name('department.store');
         Route::get('edit/{department:id}', [DepartmentController::class, 'edit'])->name('department.edit');
         Route::put('update', [DepartmentController::class, 'update'])->name('department.update');
         Route::get('delete/{department:id}', [DepartmentController::class, 'delete'])->name('department.delete');
      });
      Route::prefix('designation')->group(function () {
         Route::get('/', [DesignationController::class, 'index'])->name('designation');
         Route::post('store', [DesignationController::class, 'store'])->name('designation.store');
         Route::get('edit/{designation:id}', [DesignationController::class, 'edit'])->name('designation.edit');
         Route::put('update', [DesignationController::class, 'update'])->name('designation.update');
         Route::get('delete/{designation:id}', [DesignationController::class, 'delete'])->name('designation.delete');
      });
   });
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
