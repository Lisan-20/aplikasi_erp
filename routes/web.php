<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformasiMedis1Controller;
use App\Http\Controllers\InformasiMedis2Controller;
use App\Http\Controllers\InformasiMedis3Controller;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LegacyController;
use App\Http\Controllers\ListingPasienController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PasienBaruController;
use App\Http\Controllers\PasienLamaController;
use App\Http\Controllers\PasienRawatInapController;
use App\Http\Controllers\PendaftaranLanjutan1Controller;
use App\Http\Controllers\PendaftaranLanjutan2Controller;
use App\Http\Controllers\PendaftaranLanjutan3Controller;
use App\Http\Controllers\PerjanjianController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\Registrasi\CariPasienController;
use App\Http\Controllers\RegistrasiKunjunganController;
use App\Http\Controllers\VerifikasiJknController;
use App\Http\Controllers\VerifikasiOnlineController;
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

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['web', 'check.permission'])->group(function () {
    Route::get('/modul', [ModuleController::class, 'index'])->name('modul.index');
    Route::post('/modul/{id}/enter', [ModuleController::class, 'enterModule'])->name('modul.enter');
    Route::get('/dashboard/{modul}', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/debug/menus/{modul}', function ($modul) {
        $c = new DashboardController;
        $r = $c->show($modul);

        return $r->toResponse(request())->getData();
    });

    // Registrasi Routes
    Route::prefix('registrasi')->group(function () {
        Route::get('/pasien-baru', [PasienBaruController::class, 'create'])->name('registrasi.pasien-baru');
        Route::post('/pasien-baru', [PasienBaruController::class, 'store'])->name('registrasi.pasien-baru.store');
        Route::get('/pasien-lama', [PasienLamaController::class, 'index'])->name('registrasi.pasien-lama');

        Route::get('/cari-pasien', [CariPasienController::class, 'index'])->name('registrasi.cari-pasien');

        Route::get('/rawat-jalan/form/{no_mr}', [RegistrasiKunjunganController::class, 'createPoli'])->name('registrasi.rawat-jalan.form');
        Route::post('/rawat-jalan/form/{no_mr}', [RegistrasiKunjunganController::class, 'storePoli'])->name('registrasi.rawat-jalan.store');
        Route::get('/igd/form/{no_mr}', [RegistrasiKunjunganController::class, 'createIgd'])->name('registrasi.igd.form');
        Route::post('/igd/form/{no_mr}', [RegistrasiKunjunganController::class, 'storeIgd'])->name('registrasi.igd.store');

        Route::get('/listing-poli', [ListingPasienController::class, 'listingPoli'])->name('registrasi.listing-poli');
        Route::get('/permintaan-ri', [ListingPasienController::class, 'permintaanRi'])->name('registrasi.permintaan-ri');
        Route::get('/pasien-rawat-inap', [PasienRawatInapController::class, 'index'])->name('registrasi.pasien-rawat-inap');

        Route::get('/rawat-inap/form/{no_mr}', [PendaftaranLanjutan3Controller::class, 'createPendaftaranRi']);
        Route::post('/rawat-inap/form/{no_mr}', [PendaftaranLanjutan3Controller::class, 'storePendaftaranRi']);
        Route::get('/edit-data', [PendaftaranLanjutan3Controller::class, 'editDataUmum']);
        Route::post('/edit-data', [PendaftaranLanjutan3Controller::class, 'updateDataUmum']);

        Route::get('/paket-poli/form/{no_mr}', [PendaftaranLanjutan2Controller::class, 'createPaketPoli']);
        Route::post('/paket-poli/form/{no_mr}', [PendaftaranLanjutan2Controller::class, 'storePaketPoli']);
        Route::get('/mcu/form/{no_mr}', [PendaftaranLanjutan2Controller::class, 'createMcu']);
        Route::post('/mcu/form/{no_mr}', [PendaftaranLanjutan2Controller::class, 'storeMcu']);

        Route::get('/penunjang-medis/form/{no_mr}', [PendaftaranLanjutan1Controller::class, 'createPenunjangMedis']);
        Route::post('/penunjang-medis/form/{no_mr}', [PendaftaranLanjutan1Controller::class, 'storePenunjangMedis']);
        Route::get('/igd-malam/form/{no_mr}', [PendaftaranLanjutan1Controller::class, 'createIgdMalam']);
        Route::post('/igd-malam/form/{no_mr}', [PendaftaranLanjutan1Controller::class, 'storeIgdMalam']);

        Route::get('/info-tarif-umum', [InformasiMedis3Controller::class, 'infoTarifUmum'])->name('registrasi.info-tarif-umum');
        Route::get('/paket-bedah', [InformasiMedis3Controller::class, 'paketBedah'])->name('registrasi.paket-bedah');
        Route::get('/paket-melahirkan', [InformasiMedis3Controller::class, 'paketMelahirkan'])->name('registrasi.paket-melahirkan');

        Route::get('/info-ruangan', [InformasiMedis2Controller::class, 'infoRuangan'])->name('registrasi.info-ruangan');
        Route::get('/info-ruangan-2', [InformasiMedis2Controller::class, 'infoRuangan2'])->name('registrasi.info-ruangan-2');
        Route::get('/harga-kamar', [InformasiMedis2Controller::class, 'hargaKamar'])->name('registrasi.harga-kamar');

        Route::get('/jadwal-dokter', [InformasiMedis1Controller::class, 'jadwalDokter'])->name('registrasi.jadwal-dokter');
        Route::get('/riwayat-pasien', [InformasiMedis1Controller::class, 'riwayatPasien'])->name('registrasi.riwayat-pasien');

        Route::get('/perjanjian-pasien', [PerjanjianController::class, 'perjanjianPasien'])->name('registrasi.perjanjian-pasien');
        Route::get('/daftar-perjanjian', [PerjanjianController::class, 'daftarPerjanjian'])->name('registrasi.daftar-perjanjian');

        Route::get('/listing-online', [VerifikasiOnlineController::class, 'index'])->name('registrasi.listing-online');
        Route::get('/listing-jkn', [VerifikasiJknController::class, 'index'])->name('registrasi.listing-jkn');
        Route::get('/listing-jkn/data', [VerifikasiJknController::class, 'data'])->name('registrasi.listing-jkn.data');

        // Legacy external URL viewer (for VClaim, His servers, etc.)
        Route::get('/legacy-ext', [LegacyController::class, 'showExternal'])->name('registrasi.legacy-ext');
    });

    Route::prefix('laporan')->group(function () {
        Route::get('/kinerja', [LaporanController::class, 'kinerjaIndex'])->name('laporan.kinerja');
        Route::get('/kinerja/cetak-registrasi', [LaporanController::class, 'cetakKinerjaRegistrasi'])->name('laporan.kinerja.cetak-registrasi');
        Route::get('/kinerja/cetak-batal', [LaporanController::class, 'cetakKinerjaBatal'])->name('laporan.kinerja.cetak-batal');
        Route::get('/kinerja/cetak-rujukan', [LaporanController::class, 'cetakKinerjaRujukan'])->name('laporan.kinerja.cetak-rujukan');
    });

    Route::prefix('poli')->group(function () {
        Route::get('/antrian-poli', [PoliController::class, 'antrianPoli'])->name('poli.antrian-poli');
    });

    // Legacy Route Catcher
    Route::get('/{legacy_dir}/{legacy_file}', [LegacyController::class, 'show'])
        ->where('legacy_dir', 'mod_.*')
        ->name('legacy.view');

});

Route::get('/', function () {
    return redirect()->route('login');
});
