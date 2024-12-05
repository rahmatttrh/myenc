<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AdditionalController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\ChatController;
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
use App\Http\Controllers\EmployeeLeaderController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FetchController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PeComponentController;
use App\Http\Controllers\PeDisciplineController;
use App\Http\Controllers\PeKpaController;
use App\Http\Controllers\PeKpiController;
use App\Http\Controllers\PekpiDetailController;
use App\Http\Controllers\PerdinController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\QuickPEController;
use App\Http\Controllers\ReductionController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SocialAccountController;
use App\Http\Controllers\SoController;
use App\Http\Controllers\SpApprovalController;
use App\Http\Controllers\SpController;
use App\Http\Controllers\SpklController;
use App\Http\Controllers\SubDeptController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionOvertimeController;
use App\Http\Controllers\TransactionReductionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\FuncController;
use App\Http\Controllers\PayrollApprovalController;
use App\Http\Controllers\ReductionAdditionalController;
use App\Http\Controllers\ReductionEmployeeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UnitTransactionController;
use App\Models\Emergency;
use App\Models\EmployeeLeader;
use App\Models\Reduction;
use App\Models\SpApproval;
use App\Models\TransactionOvertime;
use Illuminate\Support\Facades\Route;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer\SpgrContainer\SpContainer;

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
   // Route::get('{any?}', function ($any = null) {
   //    return view('errors.maintenance');
   // })->where('any', '.*');
   // Func
   Route::get('update/position', [FuncController::class, 'updatePosition']);
   Route::get('test/email', [FuncController::class, 'testEmail']);

   // Fixing QPE leader bobot disiplin 15
   Route::get('update/weight/discipline/{id}', [FuncController::class, 'updateWeightDiscipline']);


   Route::prefix('pass')->group(function () {
      Route::get('reset', [PasswordController::class, 'index'])->name('pass.reset');
      Route::put('reset/update', [PasswordController::class, 'update'])->name('pass.reset.update');
      // Route::get('department/{id}', [FetchController::class, 'fetchDepartment']);
      // Route::get('subdept/{id}', [FetchController::class, 'fetchSubdept']);
      // Route::get('position/{id}', [FetchController::class, 'fetchPosition']);
   });

   Route::prefix('fetch')->group(function () {
      Route::get('sp/active/{id}', [FetchController::class, 'fetchSpActive']);
      Route::get('schedule/{date}/{id}', [FetchController::class, 'fetchSchedule']);
      Route::get('department/{id}', [FetchController::class, 'fetchDepartment']);
      Route::get('subdept/{id}', [FetchController::class, 'fetchSubdept']);
      Route::get('position/{id}', [FetchController::class, 'fetchPosition']);
      Route::get('leader/{id}', [FetchController::class, 'fetchLeader']);
   });
   /**
    * Verification Routes
    */
   // Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
   // Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
   // Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');

   Route::get('/', [HomeController::class, 'index']);

   Route::get('/phpinfo', function () {
      phpinfo();
   });

   Route::get('employee/detail/{employee:id}/{tab}', [EmployeeController::class, 'detail'])->name('employee.detail');

   // Fetch 
   Route::get('unit/fetch-data/{id}', [UnitController::class, 'fetchData'])->name('unit.fetch-data');
   Route::get('department/fetch-data/{id}', [DepartmentController::class, 'fetchData'])->name('department.fetch-data');
   Route::get('sub-dept/fetch-data/{id}', [SubDeptController::class, 'fetchData'])->name('department.fetch-data');
   // End Fetch
   Route::get('announcement/detail/{id}', [AnnouncementController::class, 'detail'])->name('announcement.detail');


   Route::prefix('task')->group(function () {
      Route::get('list', [TaskController::class, 'index'])->name('task');
      Route::get('create', [TaskController::class, 'create'])->name('task.create');
      Route::post('store', [TaskController::class, 'store'])->name('task.store');
      Route::get('detail/{id}', [TaskController::class, 'detail'])->name('task.detail');
      Route::put('update', [TaskController::class, 'update'])->name('task.update');
      Route::get('delete/{id}', [TaskController::class, 'delete'])->name('task.delete');
      Route::get('history', [TaskController::class, 'history'])->name('task.history');
      Route::post('add/pic', [TaskController::class, 'addPic'])->name('task.add.pic');
   });

   Route::prefix('chat')->group(function () {
      Route::post('store', [ChatController::class, 'store'])->name('chat.store');
   });

   Route::get('payroll/transaction/detail/{id}', [TransactionController::class, 'detail'])->name('payroll.transaction.detail');

   Route::get('payroll/transaction/employee', [TransactionController::class, 'employee'])->name('payroll.transaction.employee');




   Route::group(['middleware' => ['role:Administrator|BOD|HRD|HRD-Manager|HRD-Recruitment|HRD-Payroll|HRD-Spv']], function () {
      Route::prefix('announcement')->group(function () {
         Route::get('/', [AnnouncementController::class, 'index'])->name('announcement');
         Route::get('create', [AnnouncementController::class, 'create'])->name('announcement.create');
         Route::post('store', [AnnouncementController::class, 'store'])->name('announcement.store');

         Route::get('activate/{id}', [AnnouncementController::class, 'activate'])->name('announcement.activate');
         Route::get('deactivate/{id}', [AnnouncementController::class, 'deactivate'])->name('announcement.deactivate');
      });

      Route::prefix('employee')->group(function () {
         Route::get('tab/{tab}', [EmployeeController::class, 'index'])->name('employee');
         Route::get('nonactive', [EmployeeController::class, 'nonactive'])->name('employee.nonactive');
         Route::get('off', [EmployeeController::class, 'off'])->name('employee.off');

         Route::get('create', [EmployeeController::class, 'create'])->name('employee.create');
         Route::post('store', [EmployeeController::class, 'store'])->name('employee.store');
         Route::get('delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');

         Route::get('export', [EmployeeController::class, 'export'])->name('employee.export');
         Route::get('export/simple', [EmployeeController::class, 'exportSimple'])->name('employee.export.simple');
         Route::get('import', [EmployeeController::class, 'formImport'])->name('employee.import');
         Route::post('import', [EmployeeController::class, 'import'])->name('employee.import.data');

         Route::get('export-form', [EmployeeController::class, 'formExport'])->name('employee.export.form');
         Route::post('filter', [EmployeeController::class, 'filter'])->name('employee.filter');

         Route::get('import/edit', [EmployeeController::class, 'formImportEdit'])->name('employee.import.edit');

         Route::prefix('draft')->group(function () {
            Route::get('/', [EmployeeController::class, 'draft'])->name('employee.draft');
            Route::post('/publish', [EmployeeController::class, 'publish'])->name('employee.publish');
            Route::get('/publish/single/{id}', [EmployeeController::class, 'publishSingle'])->name('employee.publish.single');
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

      Route::prefix('master/unit')->group(function () {
         Route::get('/', [UnitController::class, 'index'])->name('unit');

         // Belum
         Route::post('store', [UnitController::class, 'store'])->name('unit.store');
         Route::get('detail/{id}', [UnitController::class, 'detail'])->name('unit.detail');
         Route::get('edit/{unit:id}', [UnitController::class, 'edit'])->name('unit.edit');
         Route::put('update', [UnitController::class, 'update'])->name('unit.update');
         Route::get('delete/{unit:id}', [UnitController::class, 'delete'])->name('unit.delete');
      });

      Route::prefix('master/department')->group(function () {
         Route::get('/', [DepartmentController::class, 'index'])->name('department');
         Route::post('store', [DepartmentController::class, 'store'])->name('department.store');
         Route::get('edit/{department:id}', [DepartmentController::class, 'edit'])->name('department.edit');
         Route::put('update', [DepartmentController::class, 'update'])->name('department.update');
         Route::get('delete/{department:id}', [DepartmentController::class, 'delete'])->name('department.delete');
      });

      Route::prefix('master/subdept')->group(function () {
         // Route::get('/', [DepartmentController::class, 'index'])->name('department');
         Route::post('store', [SubDeptController::class, 'store'])->name('subdept.store');
         // Route::get('edit/{department:id}', [DepartmentController::class, 'edit'])->name('department.edit');
         Route::put('update', [SubDeptController::class, 'update'])->name('subdept.update');
         Route::get('delete/{id}', [SubDeptController::class, 'delete'])->name('subdept.delete');
      });

      Route::prefix('<master>sub-dept')->group(function () {
      });

      Route::prefix('master/designation')->group(function () {
         Route::get('/', [DesignationController::class, 'index'])->name('designation');
         Route::post('store', [DesignationController::class, 'store'])->name('designation.store');
         Route::get('edit/{designation:id}', [DesignationController::class, 'edit'])->name('designation.edit');
         Route::put('update', [DesignationController::class, 'update'])->name('designation.update');
         Route::get('delete/{designation:id}', [DesignationController::class, 'delete'])->name('designation.delete');
      });

      Route::prefix('master/position')->group(function () {
         Route::get('/', [PositionController::class, 'index'])->name('position');
         Route::post('store', [PositionController::class, 'store'])->name('position.store');
         Route::post('department/store', [PositionController::class, 'departmentStore'])->name('position.dept.store');
         //    Route::get('edit/{position:id}', [DesignationController::class, 'edit'])->name('position.edit');
         Route::put('update', [PositionController::class, 'update'])->name('position.update');
         Route::put('department/update', [PositionController::class, 'departUpdate'])->name('position.department.update');
         Route::get('department/delete/{id}', [PositionController::class, 'departDelete'])->name('position.department.delete');
         Route::get('delete/{position:id}', [PositionController::class, 'delete'])->name('position.delete');
      });

      Route::prefix('master/shift')->group(function () {
         Route::get('/', [ShiftController::class, 'index'])->name('shift');
         Route::post('store', [ShiftController::class, 'store'])->name('shift.store');
         // Route::get('edit/{department:id}', [DepartmentController::class, 'edit'])->name('department.edit');
         Route::put('update', [ShiftController::class, 'update'])->name('shift.update');
         Route::get('delete/{id}', [ShiftController::class, 'delete'])->name('shift.delete');
      });

      Route::prefix('leader')->group(function () {
         // Route::get('/', [ShiftController::class, 'index'])->name('shift');
         Route::post('store', [EmployeeLeaderController::class, 'store'])->name('leader.store');
         Route::get('delete/{id}', [EmployeeLeaderController::class, 'delete'])->name('leader.revoke');
         // Route::get('edit/{department:id}', [DepartmentController::class, 'edit'])->name('department.edit');
         // Route::put('update', [ShiftController::class, 'update'])->name('shift.update');
         // Route::get('delete/{id}', [ShiftController::class, 'delete'])->name('shift.delete');
      });

      Route::prefix('contract')->group(function () {
         Route::post('store', [ContractController::class, 'store'])->name('contract.store');
         Route::get('delete/{id}', [ContractController::class, 'delete'])->name('contract.delete');
         Route::put('update', [ContractController::class, 'update'])->name('contract.update');
      });

      Route::post('deactivate', [DeactivateController::class, 'deactivate'])->name('deactivate');
      Route::post('activate', [DeactivateController::class, 'activate'])->name('activate');

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
      Route::prefix('master/so')->group(function () {
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
      Route::get('/log/auth', [LogController::class, 'auth'])->name('log.auth');

      Route::prefix('payroll')->group(function () {
         Route::prefix('setup')->group(function () {
            Route::get('/index', [PayrollController::class, 'index'])->name('payroll');
            Route::get('/index/unit/{id}', [PayrollController::class, 'indexUnit'])->name('payroll.unit.list');
            Route::get('/import', [PayrollController::class, 'import'])->name('payroll.import');
            Route::post('import/store', [PayrollController::class, 'importStore'])->name('payroll.import.store');
            Route::get('/unit/index', [PayrollController::class, 'unit'])->name('payroll.unit');
            Route::get('/holiday/index', [HolidayController::class, 'index'])->name('holiday');


            Route::get('/setup', [PayrollController::class, 'setup'])->name('payroll.setup');

            Route::get('report/bpjsks/{id}', [PayrollController::class, 'reportBpjsKs'])->name('payroll.report.bpjsks');

            Route::put('payslip/update', [PayrollController::class, 'payslipUpdate'])->name('payroll.payslip.update');
            Route::put('payslip/show', [PayrollController::class, 'payslipShow'])->name('payslip.show');
            Route::put('payslip/hide', [PayrollController::class, 'payslipHide'])->name('payslip.hide');

            Route::get('payslip/export/pdf/{id}', [PayrollController::class, 'exportPdf'])->name('payslip.pdf');
         });



         Route::get('/report/index', [PayrollController::class, 'report'])->name('payroll.report');
         Route::post('/report/get', [PayrollController::class, 'getReport'])->name('payroll.report.get');
         Route::get('/detail/{id}', [PayrollController::class, 'detail'])->name('payroll.detail');
         Route::put('/update', [PayrollController::class, 'update'])->name('payroll.update');
         Route::prefix('transaction')->group(function () {
            Route::post('/add/master', [TransactionController::class, 'storeMaster'])->name('payroll.add.master.transaction');
            Route::get('/delete/master/{id}', [TransactionController::class, 'deleteMaster'])->name('payroll.delete.master.transaction');




            Route::get('/export/{id}', [TransactionController::class, 'export'])->name('payroll.transaction.export');
            // Route::get('/export/bpjs/{id}', [TransactionController::class, 'export'])->name('payroll.transaction.export');


            Route::get('/monthly/all/{id}', [TransactionController::class, 'monthlyAll'])->name('payroll.transaction.monthly.all');
            Route::get('/index', [TransactionController::class, 'index'])->name('payroll.transaction');
            // Route::get('/detail/{id}', [TransactionController::class, 'detail'])->name('payroll.transaction.detail');
            Route::post('store', [TransactionController::class, 'store'])->name('payroll.transaction.store');
            Route::get('location/{unit}/{loc}', [TransactionController::class, 'location'])->name('transaction.location');

            Route::prefix('reduction')->group(function () {
               Route::get('/delete/{id}', [TransactionReductionController::class, 'delete'])->name('transaction.reduction.delete');
               // Route::post('store', [ReductionController::class, 'store'])->name('reduction.store');
               // Route::get('delete/{id}', [ReductionController::class, 'delete'])->name('reduction.delete');
            });

            Route::prefix('reduction/employee')->group(function () {
               Route::put('/update', [ReductionEmployeeController::class, 'update'])->name('reduction.employee.update');
               // Route::post('store', [ReductionController::class, 'store'])->name('reduction.store');
               Route::post('delete', [ReductionEmployeeController::class, 'delete'])->name('reduction.employee.delete');
            });
         });
         Route::prefix('overtime')->group(function () {
            Route::get('index', [OvertimeController::class, 'index'])->name('payroll.overtime');
            Route::post('filter', [OvertimeController::class, 'filter'])->name('payroll.overtime.filter');

            Route::get('import', [OvertimeController::class, 'import'])->name('overtime.import');
            Route::post('import/store', [OvertimeController::class, 'importStore'])->name('overtime.import.store');

            Route::post('store', [OvertimeController::class, 'store'])->name('payroll.overtime.store');
            Route::get('delete/{id}', [OvertimeController::class, 'delete'])->name('payroll.overtime.delete');
            // Route::get('/detail/{id}' , [TransactionController::class, 'detail'])->name('payroll.transaction.detail');
            // Route::post('store', [TransactionController::class, 'store'])->name('payroll.transaction.store');
         });
         Route::prefix('absence')->group(function () {
            Route::get('/index', [AbsenceController::class, 'index'])->name('payroll.absence');

            Route::get('/form', [AbsenceController::class, 'create'])->name('payroll.absence.create');
            Route::get('/edit/{id}', [AbsenceController::class, 'edit'])->name('payroll.absence.edit');
            Route::put('/update', [AbsenceController::class, 'update'])->name('payroll.absence.update');

            Route::post('/download-template', [AbsenceController::class, 'downloadTemplate'])->name('payroll.absence.template');
            Route::get('/export', [AbsenceController::class, 'export'])->name('payroll.absence.export');

            Route::get('/import', [AbsenceController::class, 'import'])->name('payroll.absence.import');
            Route::post('/import/store', [AbsenceController::class, 'importStore'])->name('payroll.absence.import.store');

            Route::get('/draft', [AbsenceController::class, 'draft'])->name('payroll.absence.draft');
            Route::get('/monitoring', [AbsenceController::class, 'monitoring'])->name('payroll.absence.monitoring');

            Route::post('filter', [AbsenceController::class, 'filter'])->name('payroll.absence.filter');
            Route::post('/store', [AbsenceController::class, 'store'])->name('payroll.absence.store');
            Route::get('/delete/{id}', [AbsenceController::class, 'delete'])->name('payroll.absence.delete');
            // Route::get('/detail/{id}' , [TransactionController::class, 'detail'])->name('payroll.transaction.detail');
            // Route::post('store', [TransactionController::class, 'store'])->name('payroll.transaction.store');
         });
         Route::prefix('unit')->group(function () {
            // Route::get('/index', [PayrollController::class, 'unit'])->name('payroll.unit');

            Route::post('/update/pph', [PayrollController::class, 'unitUpdatePph'])->name('payroll.unit.update');
            // Route::get('/detail/{id}' , [TransactionController::class, 'detail'])->name('payroll.transaction.detail');
            // Route::post('store', [TransactionController::class, 'store'])->name('payroll.transaction.store');
         });

         Route::prefix('additional')->group(function () {
            Route::get('index', [AdditionalController::class, 'index'])->name('payroll.additional');
            Route::post('store', [AdditionalController::class, 'store'])->name('payroll.additional.store');
            Route::get('delete/{id}', [AdditionalController::class, 'delete'])->name('payroll.additional.delete');
            // Route::get('/detail/{id}' , [TransactionController::class, 'detail'])->name('payroll.transaction.detail');
            // Route::post('store', [TransactionController::class, 'store'])->name('payroll.transaction.store');
         });

         Route::prefix('reduction/additional')->group(function () {
            // Route::get('index', [AdditionalController::class, 'index'])->name('payroll.additional');
            Route::post('store', [ReductionAdditionalController::class, 'store'])->name('reduction.additional.store');
            // Route::get('delete/{id}', [AdditionalController::class, 'delete'])->name('payroll.additional.delete');
            // Route::get('/detail/{id}' , [TransactionController::class, 'detail'])->name('payroll.transaction.detail');
            // Route::post('store', [TransactionController::class, 'store'])->name('payroll.transaction.store');
         });

         Route::prefix('holiday')->group(function () {

            Route::post('/store', [HolidayController::class, 'store'])->name('holiday.store');
            Route::get('/delete/{id}', [HolidayController::class, 'delete'])->name('holiday.delete');
            // Route::get('/detail/{id}' , [TransactionController::class, 'detail'])->name('payroll.transaction.detail');
            // Route::post('store', [TransactionController::class, 'store'])->name('payroll.transaction.store');
         });

         Route::prefix('perdin')->group(function () {
            Route::get('index', [PerdinController::class, 'index'])->name('perdin');
            Route::get('store', [PerdinController::class, 'store'])->name('perdin.store');
         });
      });

      Route::prefix('reduction')->group(function () {
         // Route::get('/index', [PayrollController::class, 'unit'])->name('payroll.unit');
         Route::put('/update', [ReductionController::class, 'update'])->name('reduction.update');
         Route::post('store', [ReductionController::class, 'store'])->name('reduction.store');
         Route::get('delete/{id}', [ReductionController::class, 'delete'])->name('reduction.delete');
      });
   });


   // Semua Role 

   Route::group(['middleware' => ['role:Administrator|BOD|HRD|HRD-Manager|HRD-Recruitment|HRD-Spv|Karyawan|Manager|Asst. Manager|Supervisor|Leader']], function () {

      Route::prefix('payroll/approval')->group(function () {
         Route::post('submit/master', [PayrollApprovalController::class, 'submit'])->name('payroll.submit.master.transaction');
         Route::post('publish/master', [PayrollApprovalController::class, 'publish'])->name('payroll.publish');


         Route::get('hrd', [PayrollApprovalController::class, 'hrd'])->name('payroll.approval.hrd');
         Route::post('approve/hrd', [PayrollApprovalController::class, 'approveHrd'])->name('payroll.approve.hrd');

         Route::get('manager-finance', [PayrollApprovalController::class, 'manfin'])->name('payroll.approval.manfin');
         Route::post('approve/manfin', [PayrollApprovalController::class, 'approveManfin'])->name('payroll.approve.manfin');

         Route::get('general-manager', [PayrollApprovalController::class, 'gm'])->name('payroll.approval.gm');
         Route::post('approve/gm', [PayrollApprovalController::class, 'approveGm'])->name('payroll.approve.gm');

         Route::get('bod', [PayrollApprovalController::class, 'bod'])->name('payroll.approval.bod');
         Route::post('approve/bod', [PayrollApprovalController::class, 'approveBod'])->name('payroll.approve.bod');

         Route::get('manhrd/history', [PayrollApprovalController::class, 'manhrdHistory'])->name('payroll.approval.manhrd.history');
         Route::get('manfin/history', [PayrollApprovalController::class, 'manfinHistory'])->name('payroll.approval.manfin.history');
         Route::get('gm/history', [PayrollApprovalController::class, 'gmHistory'])->name('payroll.approval.gm.history');
         Route::get('bod/history', [PayrollApprovalController::class, 'bodHistory'])->name('payroll.approval.bod.history');
      });

      Route::get('payroll/transaction/monthly/{id}', [TransactionController::class, 'monthly'])->name('payroll.transaction.monthly');

      Route::prefix('employee')->group(function () {
         Route::put('update', [EmployeeController::class, 'update'])->name('employee.update');
         Route::put('update/doc', [EmployeeController::class, 'updateDoc'])->name('employee.update.doc');
         Route::put('update/bio', [EmployeeController::class, 'updateBio'])->name('employee.update.bio');
         Route::put('update/picture', [EmployeeController::class, 'updatePicture'])->name('employee.update.picture');
         Route::get('remove/picture/{id}', [EmployeeController::class, 'removePicture'])->name('employee.remove.picture');
         Route::put('update/role', [EmployeeController::class, 'updateRole'])->name('employee.update.role');
         Route::put('reset/password/{id}', [EmployeeController::class, 'resetPassword'])->name('employee.reset.password');
      });

      // Quick PE All
      Route::prefix('qpe')->group(function () {
         Route::get('/', [QuickPEController::class, 'index'])->name('qpe');

         Route::get('draft', [QuickPEController::class, 'draft'])->name('qpe.draft');
         Route::get('verification', [QuickPEController::class, 'verification'])->name('qpe.verification');
         Route::get('done', [QuickPEController::class, 'done'])->name('qpe.done');
         Route::get('reject', [QuickPEController::class, 'reject'])->name('qpe.reject');

         Route::get('show/{id}', [QuickPEController::class, 'show'])->name('qpe.show');
         Route::get('report', [QuickPEController::class, 'report'])->name('qpe.report');
         Route::post('report/filter', [QuickPEController::class, 'reportFilter'])->name('qpe.report.filter');
         Route::get('report/unit/{id}/{semester}/{year}', [QuickPEController::class, 'reportUnit'])->name('qpe.report.unit');
         Route::get('report/department/{id}/{semester}/{year}', [QuickPEController::class, 'reportDepartment'])->name('qpe.report.department');

         Route::get('approval/{id}', [QuickPEController::class, 'approval'])->name('qpe.approval');
         Route::put('apply-many', [QuickPEController::class, 'applyMany'])->name('qpe.apply');
         Route::get('report', [QuickPEController::class, 'report'])->name('qpe.report');
         Route::post('report/filter', [QuickPEController::class, 'reportFilter'])->name('qpe.report.filter');
         Route::get('report/unit/{id}/{semester}/{year}', [QuickPEController::class, 'reportUnit'])->name('qpe.report.unit');
         Route::get('report/department/{id}/{semester}/{year}', [QuickPEController::class, 'reportDepartment'])->name('qpe.report.department');

         Route::patch('complain/{id}', [QuickPEController::class, 'complain'])->name('qpe.complain.patch');
         Route::patch('close-complain/{id}', [QuickPEController::class, 'closeComplain'])->name('qpe.closecomplain.patch');
      });
   });



   Route::group(['middleware' => ['role:Supervisor|Manager|Asst. Manager']], function () {
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
      Route::get('/index', [SpController::class, 'index'])->name('sp');
      Route::post('store', [SpController::class, 'store'])->name('sp.store');
      Route::get('detail/{id}', [SpController::class, 'detail'])->name('sp.detail');
      Route::put('update', [SpController::class, 'update'])->name('sp.update');
      Route::get('delete/{id}', [SpController::class, 'delete'])->name('sp.delete');
      Route::get('close/{id}', [SpController::class, 'close'])->name('sp.close');
      Route::post('export', [SpController::class, 'export'])->name('sp.export');

      Route::put('/submit/{id}', [SpApprovalController::class, 'submit'])->name('sp.submit');
      Route::put('/app/hrd/{id}', [SpApprovalController::class, 'appHrd'])->name('sp.app.hrd');
      Route::put('/reject/hrd', [SpApprovalController::class, 'rejectHrd'])->name('sp.reject.hrd');
      Route::put('/complete/hrd', [SpApprovalController::class, 'completeHrd'])->name('sp.complete.hrd');
      Route::put('/reject/user', [SpApprovalController::class, 'rejectUser'])->name('sp.reject.user');
      Route::put('/reject/manager', [SpApprovalController::class, 'rejectManager'])->name('sp.reject.manager');
      Route::put('/app/manager/{id}', [SpApprovalController::class, 'appManager'])->name('sp.app.manager');
      Route::put('/release/{id}', [SpApprovalController::class, 'release'])->name('sp.release');
      Route::put('/discuss/manager', [SpApprovalController::class, 'discussManager'])->name('sp.discuss.manager');
      Route::put('/app/employee/{id}', [SpApprovalController::class, 'appEmployee'])->name('sp.app.employee');
      Route::put('/complain/employee', [SpApprovalController::class, 'complainEmployee'])->name('sp.complain.employee');


      Route::put('/app/employee/{id}', [SpApprovalController::class, 'appEmployee'])->name('sp.app.employee');

      Route::put('/approved/{id}', [SpApprovalController::class, 'approved'])->name('sp.approved');

      Route::patch('/reject/{id}', [SpApprovalController::class, 'reject'])->name('sp.reject');

      Route::prefix('hrd')->group(function () {
         Route::post('/store', [SpController::class, 'hrdStore'])->name('sp.hrd.store');
         Route::get('create', [SpController::class, 'hrdCreate'])->name('sp.hrd.create');
         // Route::get('/approve/supervisor/{id}', [SpklController::class, 'approveSupervisor'])->name('spkl.approve.supervisor');
         // Route::get('/approve/manager/{id}', [SpklController::class, 'approveManager'])->name('spkl.approve.manager');
      });
   });

   // Role Campuran  

   Route::group(['middleware' => ['role:Administrator|HRD|HRD-Manager|HRD-Recruitment|HRD-Spv|Leader|Manager|Asst. Manager|Supervisor']], function () {
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
         Route::get('delete/{id}', [QuickPEController::class, 'delete'])->name('qpe.delete');

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



   Route::group(['middleware' => ['role:Manager|Asst. Manager']], function () {
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
      Route::get('employee/{unit}/{loc}/{gender}/{type}', [ExportController::class, 'employee'])->name('export.employee');
      Route::get('employee/excel/{unit}/{loc}/{gender}/{type}', [ExportController::class, 'employeeExcel'])->name('export.employee.excel');
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
