<?php

use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SocialAccountController;
use App\Http\Controllers\VerificationController;
use App\Models\BankAccount;
use App\Models\Commission;
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

Route::middleware(["auth", "verified"])->group(function () {

   /**
    * Verification Routes
    */
   // Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
   // Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
   // Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');

   Route::get('/', function () {
      return view('home');
   });

   Route::get('employee/detail/{employee:id}/{tab}', [EmployeeController::class, 'detail'])->name('employee.detail');

   Route::group(['middleware' => ['role:Administrator']], function () {
      Route::prefix('employee')->group(function () {
         Route::get('tab/{tab}', [EmployeeController::class, 'index'])->name('employee');

         Route::get('create', [EmployeeController::class, 'create'])->name('employee.create');
         Route::post('store', [EmployeeController::class, 'store'])->name('employee.store');
         Route::put('update', [EmployeeController::class, 'update'])->name('employee.update');
         Route::put('update/bio', [EmployeeController::class, 'updateBio'])->name('employee.update.bio');
         Route::put('update/picture', [EmployeeController::class, 'updatePicture'])->name('employee.update.picture');
         Route::get('export', [EmployeeController::class, 'export'])->name('employee.export');
         Route::get('import', [EmployeeController::class, 'formImport'])->name('employee.import');
         Route::post('import', [EmployeeController::class, 'import'])->name('employee.import');

         Route::prefix('draft')->group(function () {
            Route::get('/', [EmployeeController::class, 'draft'])->name('employee.draft');
            Route::post('/publish', [EmployeeController::class, 'publish'])->name('employee.publish');
         });

         Route::prefix('document')->group(function () {
            Route::post('store', [DocumentController::class, 'store'])->name('employee.document.store');
            Route::get('delete/{document:id}', [DocumentController::class, 'delete'])->name('employee.document.delete');
            Route::put('update', [DocumentController::class, 'update'])->name('employee.document.update');
         });

         Route::prefix('allowances')->group(function () {
            Route::post('store', [AllowanceController::class, 'store'])->name('employee.allowances.store');
            Route::get('delete/{id}', [AllowanceController::class, 'delete'])->name('employee.allowances.delete');
            Route::put('update', [AllowanceController::class, 'update'])->name('employee.allowances.update');
         });

         Route::prefix('commissions')->group(function () {
            Route::post('store', [CommissionController::class, 'store'])->name('employee.commissions.store');
         });
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

      Route::prefix('contract')->group(function () {
         Route::put('update', [ContractController::class, 'update'])->name('contract.update');
      });

      Route::prefix('emergency')->group(function () {
         Route::put('update', [EmergencyController::class, 'update'])->name('emergency.update');
      });

      Route::prefix('social/account')->group(function () {
         Route::post('store', [SocialAccountController::class, 'store'])->name('social.account.store');
         Route::get('delete/{id}', [SocialAccountController::class, 'delete'])->name('social.account.delete');
         Route::put('update', [SocialAccountController::class, 'update'])->name('social.account.update');
      });

      Route::prefix('bank/account')->group(function () {
         Route::post('store', [BankAccountController::class, 'store'])->name('bank.account.store');
         Route::get('delete/{id}', [BankAccountController::class, 'delete'])->name('bank.account.delete');
         Route::put('update', [BankAccountController::class, 'update'])->name('bank.account.update');
      });
   });
});





Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
