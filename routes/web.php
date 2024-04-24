<?php

use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\CompositionController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DutyController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\PeComponentController;
use App\Http\Controllers\PeDisciplineController;
use App\Http\Controllers\PeKpaController;
use App\Http\Controllers\PeKpiController;
use App\Http\Controllers\PekpiDetailController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\SocialAccountController;
use App\Http\Controllers\SoController;
use App\Http\Controllers\SubDeptController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\VerificationController;
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

   /**
    * Verification Routes
    */
   // Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
   // Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
   // Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');

   Route::get('/', [HomeController::class, 'index']);

   Route::get('employee/detail/{employee:id}/{tab}', [EmployeeController::class, 'detail'])->name('employee.detail');

   // Fetch 
   Route::get('unit/fetch-data/{id}', [UnitController::class, 'fetchData'])->name('unit.fetch-data');
   Route::get('department/fetch-data/{id}', [DepartmentController::class, 'fetchData'])->name('department.fetch-data');
   Route::get('sub-dept/fetch-data/{id}', [SubDeptController::class, 'fetchData'])->name('department.fetch-data');
   // End Fetch

   Route::group(['middleware' => ['role:Administrator|HRD']], function () {
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

      Route::prefix('unit')->group(function () {
         Route::get('/', [UnitController::class, 'index'])->name('unit');

         // Belum
         Route::post('store', [UnitController::class, 'store'])->name('unit.store');
         Route::get('edit/{unit:id}', [UnitController::class, 'edit'])->name('unit.edit');
         Route::put('update', [UnitController::class, 'update'])->name('unit.update');
         Route::get('delete/{unit:id}', [UnitController::class, 'delete'])->name('unit.delete');
      });

      Route::prefix('department')->group(function () {
         Route::get('/', [DepartmentController::class, 'index'])->name('department');
         Route::post('store', [DepartmentController::class, 'store'])->name('department.store');
         Route::get('edit/{department:id}', [DepartmentController::class, 'edit'])->name('department.edit');
         Route::put('update', [DepartmentController::class, 'update'])->name('department.update');
         Route::get('delete/{department:id}', [DepartmentController::class, 'delete'])->name('department.delete');
      });

      Route::prefix('sub-dept')->group(function () {
      });

      Route::prefix('designation')->group(function () {
         Route::get('/', [DesignationController::class, 'index'])->name('designation');
         Route::post('store', [DesignationController::class, 'store'])->name('designation.store');
         Route::get('edit/{designation:id}', [DesignationController::class, 'edit'])->name('designation.edit');
         Route::put('update', [DesignationController::class, 'update'])->name('designation.update');
         Route::get('delete/{designation:id}', [DesignationController::class, 'delete'])->name('designation.delete');
      });

      Route::prefix('position')->group(function () {
         Route::get('/', [PositionController::class, 'index'])->name('position');
         //    Route::post('store', [DesignationController::class, 'store'])->name('position.store');
         //    Route::get('edit/{position:id}', [DesignationController::class, 'edit'])->name('position.edit');
         //    Route::put('update', [DesignationController::class, 'update'])->name('position.update');
         //    Route::get('delete/{position:id}', [DesignationController::class, 'delete'])->name('position.delete');
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

      // PE
      Route::prefix('so')->group(function () {
         Route::get('/', [SoController::class, 'index'])->name('so');
      });

      // PE
      Route::prefix('pe-component')->group(function () {
         Route::get('/', [PeComponentController::class, 'index'])->name('pe.component');
         // Route::post('store', [DepartmentController::class, 'store'])->name('department.store');
         // Route::get('edit/{department:id}', [DepartmentController::class, 'edit'])->name('department.edit');
         // Route::put('update', [DepartmentController::class, 'update'])->name('department.update');
         // Route::get('delete/{department:id}', [DepartmentController::class, 'delete'])->name('department.delete');
      });


      // KPA
      Route::prefix('generate')->group(function () {
         Route::get('/komposisi', [CompositionController::class, 'komposisi'])->name('komposisi');
      });
   });


   // Role Campuran  

   Route::group(['middleware' => ['role:Administrator|HRD|Leader|Manager']], function () {
      // kpi
      Route::prefix('kpi')->group(function () {
         Route::get('/', [PeKpiController::class, 'index'])->name('kpi');
         Route::post('', [PeKpiController::class, 'store'])->name('kpi.store');
         Route::get('{id}', [PeKpiController::class, 'edit'])->name('kpi.edit');
         Route::get('delete/{id}', [PeKpiController::class, 'delete'])->name('kpi.delete');  // Belum selesai semua

         Route::get('delete-objective/{id}', [PeKpiController::class, 'deleteObjective'])->name('kpi.objective.delete');  // Belum selesai semua

         // id yang di gunakan id employee
         // untuk melakukan penilaian
         Route::get('employe/{id}', [PeKpiController::class, 'kpiEmploye'])->name('kpi.employe');

         // DETAIL
         Route::post('/detail', [PekpiDetailController::class, 'store'])->name('kpidetail.store');
         Route::post('/detail/add-user', [PeKpiController::class, 'addUser'])->name('kpi.add.user');


         // KPI POINT
         Route::post('point', [PeKpiController::class, 'storePoint'])->name('kpi.point.store');
         Route::get('delete-point/{id}', [PeKpiController::class, 'deletePoint'])->name('kpi.point.delete');  // Belum selesai semua
      });

      // KPA
      Route::prefix('kpa')->group(function () {
         Route::get('/', [PeKpaController::class, 'index'])->name('kpa');
         Route::post('/', [PeKpaController::class, 'store'])->name('kpa.store');
         Route::get('edit/{id}', [PeKpaController::class, 'edit'])->name('kpa.edit');
         Route::put('update/{id}', [PeKpaController::class, 'update'])->name('kpa.update');
         // ADDTIONAL
         Route::put('addtional-update/{id}', [PeKpaController::class, 'updateAddtional'])->name('kpa.addtional.update');

         Route::get('delete/{kpa:id}', [PeKpaController::class, 'delete'])->name('kpa.delete');
         Route::put('submit/{id}', [PeKpaController::class, 'submit'])->name('kpa.submit');

         Route::patch('done-validasi/{id}', [PeKpaController::class, 'doneValidasi'])->name('kpa.done.validasi');
         Route::patch('reject-validasi/{id}', [PeKpaController::class, 'rejectValidasi'])->name('kpa.reject.validasi');
         Route::patch('resending-validasi/{id}', [PeKpaController::class, 'resendingValidasi'])->name('kpa.resending.validasi');

         // Validasi
         Route::patch('item-validasi/{id}', [PeKpaController::class, 'itemValidasi'])->name('kpa.item.validasi');
         Route::post('verifikasi/{id}', [PeKpaController::class, 'rejectVerifikasi'])->name('kpa.verifikasi.reject');

         // Verifikasi
         Route::patch('done-verifikasi/{id}', [PeKpaController::class, 'doneVerifikasi'])->name('kpa.done.verifikasi');

         Route::get('/summary', [PeKpaController::class, 'summary'])->name('kpa.summary');
         Route::get('/monitoring', [PeKpaController::class, 'monitoring'])->name('kpa.monitoring');
         // Route::post('/summary/detail', [PeKpaController::class, 'summaryDetail'])->name('kpa.summary.detail');
         Route::get('/summary/detail', [PeKpaController::class, 'summaryDetail'])->name('kpa.summary.detail');

         Route::post('addtional/{id}', [PeKpaController::class, 'storeAddtional'])->name('kpa.addtional.store');
         Route::get('addtional-delete/{id}', [PeKpaController::class, 'deleteAddtional'])->name('kpa.addtional.delete');
      });

      // Discipline
      Route::prefix('discipline')->group(function () {
         Route::get('/', [PeDisciplineController::class, 'index'])->name('discipline');
         Route::get('import', [PeDisciplineController::class, 'formImport'])->name('discipline.import');
         Route::post('import', [PeDisciplineController::class, 'import'])->name('discipline.import');

         Route::get('delete/{discipline:id}', [PeDisciplineController::class, 'delete'])->name('discipline.delete');

         Route::post('apply-many', [PeDisciplineController::class, 'applyMany'])->name('discipline.apply');
         // Route::put('delete-many', [PeDisciplineController::class, 'deleteMany'])->name('discipline.delete.many');

         Route::get('draft', [PeDisciplineController::class, 'draft'])->name('discipline.draft');
         Route::get('monitoring', [PeDisciplineController::class, 'formImport'])->name('discipline.monitoring');
      });
   });

   Route::prefix('export')->group(function(){
      Route::get('kpa/employee/{id}', [ExportController::class, 'kpaEmployee'])->name('export.kpa.employee');
      Route::get('kpa/summary/{employee}/{semester}/{tahun}', [ExportController::class, 'kpaSummary'])->name('export.kpa.summary');
   });




   // Role Karyawan
   Route::group(['middleware' => ['role:Karyawan']], function () {
      // kpi
      Route::prefix('employee')->group(function () {

         Route::prefix('spkl')->group(function () {
            Route::get('/index', [OvertimeController::class, 'index'])->name('employee.spkl');
            Route::get('/detail', [OvertimeController::class, 'detail'])->name('spkl.detail');
         });

         Route::prefix('spt')->group(function () {
            Route::get('/index', [DutyController::class, 'index'])->name('employee.spt');
            Route::get('/detail', [OvertimeController::class, 'detail'])->name('spkl.detail');
         });

         Route::prefix('presence')->group(function () {
            Route::post('/in', [PresenceController::class, 'in'])->name('employee.presence.in');
            Route::put('/out', [PresenceController::class, 'out'])->name('employee.presence.out');
         });
         Route::get('/', [PeKpiController::class, 'index'])->name('kpi');
         Route::post('', [PeKpiController::class, 'store'])->name('kpi.store');
         Route::get('{id}', [PeKpiController::class, 'edit'])->name('kpi.edit');
         Route::get('delete/{id}', [PeKpiController::class, 'delete'])->name('kpi.delete');  // Belum selesai semua
         Route::get('delete-objective/{id}', [PeKpiController::class, 'deleteObjective'])->name('kpi.objective.delete');  // Belum selesai semua
      });

   });


});






Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
