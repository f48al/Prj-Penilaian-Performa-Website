<?php

// use App\Http\Controllers\Auth\RegisterController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\Auth\ResetPassword;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DraftKpiIndividuController;
use App\Http\Controllers\PenilaianPribadiController;
use App\Http\Controllers\ReviewPenyusunanController;
use App\Http\Controllers\FormPenyusunanKpiController;
use App\Http\Controllers\PenilaianBawahanController;
use App\Http\Controllers\ReviewPenilaianController;

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

// untuk keperluan testing, akan dihapus pada tahap production
// Route::name('test')->group(function() {
//     Route::view('test', 'Pages.old.inbox');
// });

Route::middleware('guest')->group(function() {
    Route::get('/', [LoginController::class, 'index'])->name('login-form');
    Route::post('/', [LoginController::class, 'authenticate'])->name('login');

    Route::get('/lupa-password', [ResetPassword::class, 'index'])->name('lupa-password');
    Route::post('/lupa-password', [ResetPassword::class, 'sendResetLinkEmail'])->name('lupa-password-send');
    Route::get('/reset-password/{token}', [ResetPassword::class, 'resetPasswordForm'])->name('password.reset');
    Route::post('/reset-password/{token}', [ResetPassword::class, 'resetPasswordPost'])->name('password.reset.post');

    // Route::get('/daftar', [RegisterController::class, 'index'])->name('register-form');
    // Route::post('/daftar', [RegisterController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function() {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/{triwulan}/{year}/kinerja', [HomeController::class, 'kinerja'])->name('home-kinerja');
    Route::post('/homeUpload', [HomeController::class, 'upload'])->name('home-upload');

    Route::name('add-kpi.')->group(function() {
        Route::get('/addKPI/{year?}', [DraftKpiIndividuController::class, 'index'])->name('index');
        Route::get('/editKPI/{id}', [DraftKpiIndividuController::class, 'edit'])->name('edit');
        Route::patch('/editKPI/{id}', [DraftKpiIndividuController::class, 'update'])->name('update');
        Route::delete('/deleteKPI/{id}', [DraftKpiIndividuController::class, 'destroy'])->name('destroy');

        Route::get('/addKPIform', [DraftKpiIndividuController::class, 'create'])->name('form');
        Route::post('/addKPIform', [DraftKpiIndividuController::class, 'store'])->name('store');
        Route::post('/addKPIform-excel', [DraftKpiIndividuController::class, 'import'])->name('excel');
    });

    Route::name('penyusunan-kpi.')->group(function() {
        Route::get('/penyusunanKPI/{year?}', [FormPenyusunanKpiController::class, 'index'])->name('index');
        Route::get('/penyusunanForm/edit/{dkpiid}', [FormPenyusunanKpiController::class, 'edit'])->name('edit');
        Route::put('/penyusunanForm/edit/{idPenyusunanKPI}', [FormPenyusunanKpiController::class, 'update'])->name('update');
        Route::get('/penyusunanForm/{profile_id}/{year}', [FormPenyusunanKpiController::class, 'create'])->name('form');
        Route::get('/penyusunanForm/{idPenyusunanKPI}', [FormPenyusunanKpiController::class, 'show'])->name('show');
        Route::post('/penyusunanKPI', [FormPenyusunanKpiController::class, 'store'])->name('store');
    });

    Route::name('review-penyusunan.')->group(function() {
        Route::get('/revPenyusunan/{year?}', [ReviewPenyusunanController::class, 'index'])->name('index');
        Route::get('/revPenyusunan/edit/{idPenyusunanKPI}', [ReviewPenyusunanController::class, 'update'])->name('update');
    });

    Route::name('penilaian-pribadi.')->middleware('role:Karyawan')->group(function() {
        Route::get('/penilaianPribadi/{year?}', [PenilaianPribadiController::class, 'index'])->name('index');
        Route::get('/penilaianPribadi/create/{idPenyusunanKPI}/{triwulan}', [PenilaianPribadiController::class, 'create'])->name('create');
        Route::post('/penilaianPribadi/create/{triwulan}', [PenilaianPribadiController::class, 'store'])->name('store');
    });

    Route::name('penilaian-bawahan.')->group(function() {
        Route::get('/penilaianBawahan/{year?}', [PenilaianBawahanController::class, 'index'])->name('index');
        Route::get('/penilaianBawahan/create/{idPenyusunanKPI}/{triwulan}', [PenilaianBawahanController::class, 'create'])->name('create');
        Route::post('penilaianBawahan/create/{triwulan}', [PenilaianBawahanController::class, 'store'])->name('store');
    });

    Route::name('review-penilaian.')->group(function() {
        Route::get('/revPenilaian/{year?}', [ReviewPenilaianController::class, 'index'])->name('index');
        Route::get('/revPenilaian/show/{idPenyusunanKPI}/{triwulan}', [ReviewPenilaianController::class, 'show'])->name('show');
        Route::get('/revPenilaian/edit/{idPenyusunanKPI}/{triwulan}', [ReviewPenilaianController::class, 'update'])->name('update');
    });

    Route::name('inbox.')->group(function() {
        Route::get('/inbox', [InboxController::class, 'index'])->name('index');
    });
});
