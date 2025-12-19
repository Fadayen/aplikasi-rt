<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardControllerAdmin;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\DetikNewsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TagihanController;



Route::middleware('web')->group(function () {

    Route::get('/', fn () => redirect('/berita'));

    
    // BERITA (warga bisa lihat)
        Route::prefix('berita')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('berita.index');
        Route::get('/create', [BeritaController::class, 'create'])->name('berita.create');
        Route::post('/', [BeritaController::class, 'store'])->name('berita.store');
        Route::get('/{id}', [BeritaController::class, 'show'])->name('berita.show');
        Route::post('/{id}/komentar', [BeritaController::class, 'komentar'])->name('berita.komentar');
    });

    // AGENDA (warga bisa lihat)
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
    
    Route::get('/berita-detik', [DetikNewsController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | AUTH
    |--------------------------------------------------------------------------
    */
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'loginProcess']);
        
        Route::get('/register', [AuthController::class, 'register'])->name('register.warga');
        Route::post('/register', [AuthController::class, 'registerProcess'])
        ->name('register.warga.process');
    });
    
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

    /*
    |--------------------------------------------------------------------------
    | AREA LOGIN + HARUS DI-APPROVE
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth', 'approved'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Dashboard Admin
        Route::get('/dashboard/admin', [DashboardControllerAdmin::class, 'index'])
            ->name('dashboard.admin')
            ->middleware('admin');

        // Dashboard Warga
        Route::get('/dashboard/warga', [DashboardController::class, 'warga'])
            ->name('dashboard.warga');


        /*
        |--------------------------------------------------------------------------
        | PROFILE
        |--------------------------------------------------------------------------
        */
        Route::get('/profile', fn () => view('profile'))->name('profile');


        /*
        |--------------------------------------------------------------------------
        | WARGA — READ ONLY
        |--------------------------------------------------------------------------
        */

        // DATA WARGA (jika warga boleh lihat)
        Route::get('/data-warga', [WargaController::class, 'index'])
            ->name('warga.index');
        Route::get('/data-warga/{id}', [WargaController::class, 'detail']);


        // SURAT — warga hanya bisa ajukan dan lihat status
        Route::prefix('surat')->group(function () {
            Route::get('/', [SuratController::class, 'index'])->name('surat.index');
            Route::get('/pengajuan', [SuratController::class, 'create'])->name('surat.create');
            Route::post('/pengajuan', [SuratController::class, 'store'])->name('surat.store');
            Route::put('/surat/{id}', [SuratController::class, 'update'])->name('surat.update');
            Route::get('/surat/download/{id}', [SuratController::class, 'download'])
     ->name('surat.download');
        });


        // KEUANGAN (read only)
        Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');

        // INVENTARIS — READ ONLY
Route::prefix('inventaris')->group(function () {
    Route::get('/', [InventarisController::class, 'index'])->name('inventaris.index');
    Route::get('/detail/{id}', [InventarisController::class, 'show'])->name('inventaris.show');
});

        // Tagihan (read only)
        Route::middleware(['auth'])->group(function () {

    Route::get('/tagihan', [PaymentController::class, 'index'])
    ->name('tagihan.index');

Route::get('/payment/{id}', [PaymentController::class, 'create'])
    ->name('payment.form');

Route::post('/payment/{id}', [PaymentController::class, 'upload'])
    ->name('payment.upload');


});


        /*
        |--------------------------------------------------------------------------
        | ADMIN — CRUD AREA
        |--------------------------------------------------------------------------
        */
        Route::middleware('admin')->group(function () {

            // APPROVE USER
            Route::post('/admin/users/{id}/approve', [DashboardControllerAdmin::class, 'approve'])
                ->name('admin.users.approve');

            Route::delete('/admin/users/{id}/decline', [DashboardControllerAdmin::class, 'decline'])
                ->name('admin.users.decline');

            /*
            |--------------------------------------------------------------------------
            | DATA WARGA — ADMIN CRUD
            |--------------------------------------------------------------------------
            */

            Route::middleware('admin')->group(function () {
                Route::get('/data-warga/{id}/edit', [WargaController::class, 'edit']);
                Route::put('/data-warga/{id}', [WargaController::class, 'update']);
                Route::delete('/data-warga/{id}', [WargaController::class, 'destroy']);
            });

            /*
            |--------------------------------------------------------------------------
            | SURAT — ADMIN CRUD
            |--------------------------------------------------------------------------
            */
            Route::prefix('surat')->group(function () {
                Route::get('/{id}/validasi', [SuratController::class, 'validasi']);
            });
                Route::post('/surat/upload/{id}', [SuratController::class, 'uploadFile'])->name('surat.upload');
                Route::delete('/surat/{id}', [SuratController::class, 'destroy'])->name('surat.destroy');
                Route::get('/surat/{id}/edit', [SuratController::class, 'edit'])->name('surat.edit');
            /*
            |--------------------------------------------------------------------------
            | AGENDA — CRUD
            |--------------------------------------------------------------------------
            */
            Route::prefix('agenda')->group(function () {
                Route::get('/create', [AgendaController::class, 'create'])->name('agenda.create');
                Route::post('/store', [AgendaController::class, 'store'])->name('agenda.store');
                Route::get('/{id}/edit', [AgendaController::class, 'edit'])->name('agenda.edit');
                Route::post('/{id}/update', [AgendaController::class, 'update'])->name('agenda.update');
                Route::delete('/delete/{id}', [AgendaController::class, 'destroy'])->name('agenda.delete');
            });


            /*
            |--------------------------------------------------------------------------
            | BERITA — CRUD
            |--------------------------------------------------------------------------
            */
            Route::prefix('admin/berita')->middleware('admin')->group(function () {
            Route::get('/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
            Route::put('/{id}', [BeritaController::class, 'update'])->name('berita.update');
            Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
});



            /*
            |--------------------------------------------------------------------------
            | KEUANGAN — CRUD
            |--------------------------------------------------------------------------
            */
            Route::prefix('keuangan')->group(function () {
                Route::get('/create', [KeuanganController::class, 'create']);
                Route::post('/store', [KeuanganController::class, 'store']);
                Route::get('/{id}/edit', [KeuanganController::class, 'edit']);
                Route::post('/{id}/update', [KeuanganController::class, 'update']);
                Route::delete('/delete/{id}', [KeuanganController::class, 'destroy']);
            });


            /*
            |--------------------------------------------------------------------------
            | INVENTARIS — CRUD
            |--------------------------------------------------------------------------
            */
            Route::middleware('admin')->prefix('inventaris')->group(function () {
    Route::get('/create', [InventarisController::class, 'create'])->name('inventaris.create');
    Route::post('/store', [InventarisController::class, 'store'])->name('inventaris.store');
    Route::get('/{id}/edit', [InventarisController::class, 'edit'])->name('inventaris.edit');
    Route::put('/{id}', [InventarisController::class, 'update'])->name('inventaris.update');
    Route::delete('/delete/{id}', [InventarisController::class, 'destroy'])->name('inventaris.destroy');
});

            /*
            |--------------------------------------------------------------------------
            | TAGIHAN — CRUD
            |--------------------------------------------------------------------------
            */
            Route::prefix('tagihan')->group(function () {

            Route::get('/admin/payment', [PaymentController::class, 'admin'])->name('payment.admin');
            Route::get('/create/{user_id}', [TagihanController::class, 'create'])->name('tagihan.create');
            Route::post('/store', [TagihanController::class, 'store'])->name('tagihan.store');
            Route::post('/admin/payment/verify/{id}', [DashboardControllerAdmin::class, 'verify'])
    ->name('payment.verify');
Route::post('/admin/payment/reject/{id}', [DashboardControllerAdmin::class, 'reject'])
    ->name('payment.reject');
    Route::delete('/tagihan/{id}', [TagihanController::class, 'destroy'])
    ->name('tagihan.destroy');
                Route::post('/kirim-massal', [TagihanController::class, 'kirimMassal'])
    ->name('tagihan.massal');
Route::post('/kirim-perwarga', [TagihanController::class, 'kirimPerWarga'])
        ->name('tagihan.kirim.perwarga');

});

        }); // END ADMIN

    }); // END AUTH + APPROVED

});
