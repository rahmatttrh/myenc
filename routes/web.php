<?php

use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\CompositionController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DeactivateController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DutyController;
use App\Http\Controllers\EducationalController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FetchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\PeComponentController;
use App\Http\Controllers\PeDisciplineController;
use App\Http\Controllers\PeKpaController;
use App\Http\Controllers\PeKpiController;
use App\Http\Controllers\PekpiDetailController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\QuickPEController;
use App\Http\Controllers\SocialAccountController;
use App\Http\Controllers\SoController;
use App\Http\Controllers\SpController;
use App\Http\Controllers\SpklController;
use App\Http\Controllers\SubDeptController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\VerificationController;
use App\Models\Emergency;
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
   Route::prefix('fetch')->group(function () {
      Route::get('sp/active/{id}', [FetchController::class, 'fetchSpActive']);
      Route::get('schedule/{date}/{id}', [FetchController::class, 'fetchSchedule']);
      Route::get('department/{id}', [FetchController::class, 'fetchDepartment']);
      Route::get('subdept/{id}', [FetchController::class, 'fetchSubdept']);
      Route::get('position/{id}', [FetchController::class, 'fetchPosition']);
   });
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

   Route::group(['middleware' => ['role:Administrator|HRD|HRD-Recruitment|HRD-Spv']], function () {
      Route::prefix('employee')->group(function () {
         Route::get('tab/{tab}', [EmployeeController::class, 'index'])->name('employee');
         Route::get('nonactive', [EmployeeController::class, 'nonactive'])->name('employee.nonactive');
         Route::get('off', [EmployeeController::class, 'off'])->name('employee.off');

         Route::get('create', [EmployeeController::class, 'create'])->name('employee.create');
         Route::post('store', [EmployeeController::class, 'store'])->name('employee.store');

         Route::get('export', [EmployeeController::class, 'export'])->name('employee.export');
         Route::get('export/simple', [EmployeeController::class, 'exportSimple'])->name('employee.export.simple');
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
         Route::post('store', [ContractController::class, 'store'])->name('contract.store');
         Route::put('update', [ContractController::class, 'update'])->name('contract.update');
      });

      Route::post('deactivate', [DeactivateController::class, 'deactivate'])->name('deactivate');

      Route::prefix('emergency')->group(function () {
         Route::post('store', [EmergencyController::class, 'store'])->name('emergency.store');
         Route::put('update', [EmergencyController::class, 'update'])->name('emergency.update');
         Route::get('delete/{id}', [EmergencyController::class, 'delete'])->name('emergency.delete');
      });

      Route::prefix('educational')->group(function () {
         Route::post('store', [EducationalController::class, 'store'])->name('educational.store');
         Route::put('update', [EducationalController::class, 'update'])->name('educational.update');
         Route::get('delete/{id}', [EducationalController::class, 'delete'])->name('educational.delete');
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

      Route::prefix('mutation')->group(function () {
         Route::post('store', [MutationController::class, 'store'])->name('mutation.store');
      });

      Route::get('/log', [LogController::class, 'index'])->name('log');

   });


   // Semua Role 

   Route::group(['middleware' => ['role:Administrator|HRD|HRD-Recruitment|HRD-Spv|Karyawan|Manager|Supervisor|Leader']], function () {
      
      Route::prefix('qpe')->group(function () {
         Route::put('update', [EmployeeController::class, 'update'])->name('employee.update');
         Route::put('update/doc', [EmployeeController::class, 'updateDoc'])->name('employee.update.doc');
         Route::put('update/bio', [EmployeeController::class, 'updateBio'])->name('employee.update.bio');
         Route::put('update/picture', [EmployeeController::class, 'updatePicture'])->name('employee.update.picture');
         Route::put('update/role', [EmployeeController::class, 'updateRole'])->name('employee.update.role');
      });

      // Quick PE All
      Route::prefix('qpe')->group(function () {
         Route::get('/', [QuickPEController::class, 'index'])->name('qpe');

         Route::get('show/{id}', [QuickPEController::class, 'show'])->name('qpe.show');

         Route::get('approval/{id}', [QuickPEController::class, 'approval'])->name('qpe.approval');

         Route::patch('complain/{id}', [QuickPEController::class, 'complain'])->name('qpe.complain.patch');
         Route::patch('close-complain/{id}', [QuickPEController::class, 'closeComplain'])->name('qpe.closecomplain.patch');
      });
      
   });

   

   Route::group(['middleware' => ['role:Supervisor|Manager']], function () {
      Route::prefix('employee')->group(function () {
         Route::get('spv', [EmployeeController::class, 'indexSpv'])->name('supervisor.employee');
      });

      Route::prefix('spkl')->group(function () {
         Route::get('/index', [SpklController::class, 'indexSupervisor'])->name('supervisor.spkl');
         Route::get('/approve/supervisor/{id}', [SpklController::class, 'approveSupervisor'])->name('spkl.approve.supervisor');
         Route::get('/approve/manager/{id}', [SpklController::class, 'approveManager'])->name('spkl.approve.manager');
      });
   });


   Route::prefix('sp')->group(function () {
      Route::get('/', [SpController::class, 'index'])->name('sp');
      Route::post('store', [SpController::class, 'store'])->name('sp.store');
      Route::get('detail/{id}', [SpController::class, 'detail'])->name('sp.detail');
      Route::put('update', [SpController::class, 'update'])->name('sp.update');
      Route::get('delete/{id}', [SpController::class, 'delete'])->name('sp.delete');

      Route::put('/submit/{id}', [SpController::class, 'submit'])->name('sp.submit');
      Route::put('/app/hrd/{id}', [SpController::class, 'appHrd'])->name('sp.app.hrd');
      Route::put('/app/employee/{id}', [SpController::class, 'appEmployee'])->name('sp.app.employee');

      Route::put('/approved/{id}', [SpController::class, 'approved'])->name('sp.approved');

      Route::patch('/reject/{id}', [SpController::class, 'reject'])->name('sp.reject');
   });

   // Role Campuran  

   Route::group(['middleware' => ['role:Administrator|HRD|HRD-Recruitment|HRD-Spv|Leader|Manager|Supervisor']], function () {
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

         // Add/Revoke User
         Route::post('/detail/add-user', [PeKpiController::class, 'addUser'])->name('kpi.add.user');
         Route::patch('revoke-user/{id}', [PeKpiController::class, 'revokeUser'])->name('kpi.revoke.user');


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

      // Quick PE
      Route::prefix('qpe')->group(function () {
         // Route::get('/', [QuickPEController::class, 'index'])->name('qpe'); //ada di atas
         Route::get('/create', [QuickPEController::class, 'create'])->name('qpe.create');
         Route::get('edit/{id}', [QuickPEController::class, 'edit'])->name('qpe.edit');
         // Route::get('show/{id}', [QuickPEController::class, 'show'])->name('qpe.show');  //ada di atas

         Route::post('/', [QuickPEController::class, 'store'])->name('qpe.store');
         Route::put('/submit/{id}', [QuickPEController::class, 'submit'])->name('qpe.submit');

         // Route::get('approval/{id}', [QuickPEController::class, 'approval'])->name('qpe.approval');  // Ada di atas
         Route::patch('approved/{id}', [QuickPEController::class, 'approved'])->name('qpe.approved');

         Route::post('/behavior', [QuickPEController::class, 'storeBehavior'])->name('qpe.behavior.store');
         Route::patch('/behavior/update/{id}', [QuickPEController::class, 'updateBehavior'])->name('qpe.behavior.update');

         Route::patch('komentar/{id}', [QuickPEController::class, 'komentar'])->name('qpe.komentar.patch');

         Route::patch('discuss/{id}', [QuickPEController::class, 'discuss'])->name('qpe.discuss.patch');


         // Delete
         Route::get('delete/{id}', [QuickPEController::class, 'destroy'])->name('qpe.delete');

         // Route::put('update/{id}', [QuickPEController::class, 'update'])->name('qpe.update');
         // // ADDTIONAL
         // Route::put('addtional-update/{id}', [QuickPEController::class, 'updateAddtional'])->name('qpe.addtional.update');

         // Route::get('delete/{qpe:id}', [QuickPEController::class, 'delete'])->name('qpe.delete');
         // Route::put('submit/{id}', [QuickPEController::class, 'submit'])->name('qpe.submit');

         // Route::patch('done-validasi/{id}', [QuickPEController::class, 'doneValidasi'])->name('qpe.done.validasi');
         // Route::patch('reject-validasi/{id}', [QuickPEController::class, 'rejectValidasi'])->name('qpe.reject.validasi');
         // Route::patch('resending-validasi/{id}', [QuickPEController::class, 'resendingValidasi'])->name('qpe.resending.validasi');

         // // Validasi
         // Route::patch('item-validasi/{id}', [QuickPEController::class, 'itemValidasi'])->name('qpe.item.validasi');
         // Route::post('verifikasi/{id}', [QuickPEController::class, 'rejectVerifikasi'])->name('qpe.verifikasi.reject');

         // // Verifikasi
         // Route::patch('done-verifikasi/{id}', [QuickPEController::class, 'doneVerifikasi'])->name('qpe.done.verifikasi');

         // Route::get('/summary', [QuickPEController::class, 'summary'])->name('qpe.summary');
         // Route::get('/monitoring', [QuickPEController::class, 'monitoring'])->name('qpe.monitoring');
         // // Route::post('/summary/detail', [QuickPEController::class, 'summaryDetail'])->name('qpe.summary.detail');
         // Route::get('/summary/detail', [QuickPEController::class, 'summaryDetail'])->name('qpe.summary.detail');

         // Route::post('addtional/{id}', [QuickPEController::class, 'storeAddtional'])->name('qpe.addtional.store');
         // Route::get('addtional-delete/{id}', [QuickPEController::class, 'deleteAddtional'])->name('qpe.addtional.delete');
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



   Route::group(['middleware' => ['role:Manager']], function () {
      Route::prefix('spkl')->group(function () {
         Route::get('manager/index', [SpklController::class, 'indexManager'])->name('manager.spkl');
      });
   });





   Route::prefix('export')->group(function () {
      Route::get('kpa/employee/{id}', [ExportController::class, 'kpaEmployee'])->name('export.kpa.employee');
      Route::get('kpa/summary/{employee}/{semester}/{tahun}', [ExportController::class, 'kpaSummary'])->name('export.kpa.summary');

      // Example PDF
      Route::get('kpi/employee/', [ExportController::class, 'kpiExample'])->name('export.kpi');

      Route::get('qpe/{id}', [ExportController::class, 'qpe'])->name('export.qpe');
   });



   Route::prefix('spkl')->group(function () {
      Route::get('/detail/{id}', [SpklController::class, 'detail'])->name('spkl.detail');
   });
   // Role Karyawan
   Route::group(['middleware' => ['role:Karyawan|Leader']], function () {
      // kpi
      Route::prefix('employee')->group(function () {

         Route::prefix('spkl')->group(function () {
            Route::get('/index', [SpklController::class, 'index'])->name('employee.spkl');
            Route::post('/store', [SpklController::class, 'store'])->name('employee.spkl.store');
            Route::get('/send/{id}', [SpklController::class, 'send'])->name('employee.spkl.send');
            Route::get('/delete/{id}', [SpklController::class, 'delete'])->name('employee.spkl.delete');
         });

         Route::prefix('spt')->group(function () {
            Route::get('/index', [DutyController::class, 'index'])->name('employee.spt');
            // Route::get('/detail', [OvertimeController::class, 'detail'])->name('spkl.detail');
         });

         Route::prefix('presence')->group(function () {
            Route::post('/in', [PresenceController::class, 'in'])->name('employee.presence.in');
            Route::put('/out', [PresenceController::class, 'out'])->name('employee.presence.out');
         });
      });
   });
});






Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
