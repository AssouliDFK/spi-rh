<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BackPanel\AdminController;
use App\Http\Controllers\BackPanel\EmployeController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});
// Route::resource('/companies', 'CompanyController');
Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/email/verify', function () {
                                            return view('auth.verify-email');
                                          })->middleware('auth')->name('verification.notice');
use Illuminate\Foundation\Auth\EmailVerificationRequest;
 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

use Illuminate\Http\Request;
 
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// tested user send email
Route::get('/pingMailSending', [TestController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','role:admin'])->group(function () {
    // all admin middleware must declared here
        Route::get('admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');

        Route::post('admin/create', [AdminController::class, 'storeAdmin'])->name('admin.storeAdmin');

        Route::get('admin/create',[AdminController::class,'create'])->name('admin.create');
        // Route::post('admin/dashboard',[AdminController::class,'store'])->name('admin.store');
        Route::get('/action',[AdminController::class,'action'])->name('action');


        Route::get('/employee/{id}', [EmployeController::class,'show'])->name('employee.showDetails');
        Route::get('admin/create/employe',[AdminController::class,'createEmploye'])->name('admin.createEmploye');
        Route::get('admin/create/company',[CompanyController::class,'create'])->name('admin.createCompany');
        Route::post('admin/store/company',[CompanyController::class,'store'])->name('company.save');

        Route::get('/employee/delete/{id}', [EmployeController::class,'delete'])->name('employee.delete');
        Route::post('/assign-company/{employee}',[EmployeController::class,'assignCompany'])->name('employee.assignCompany');

        Route::post('admin/dashboard',[AdminController::class,'storeEmploye'])->name('admin.storeEmploye');
       

// Route::post('/admin/administrators', 'AdminAdminController@store')->name('admin.create');

});

Route::middleware(['auth','role:employe'])->group(function () {
    // all admin middleware must declared here
Route::get('employe/dashboard',[EmployeController::class,'dashboard'])->name('employe.dashboard');

});