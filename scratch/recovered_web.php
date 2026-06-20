The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasienBaruController;
use App\Http\Controllers\PasienLamaController;
use App\Http\Controllers\RegistrasiKunjunganController;
use App\Http\Controllers\LegacyController;
use App\Http\Controllers\PasienRawatInapController;
use App\Http\Controllers\PendaftaranLanjutan2Controller;
use App\Http\Controllers\PendaftaranLanjutan3Controller;
use App\Http\Controllers\PendaftaranLanjutan1Controller;
use App\Http\Controllers\ConsentController;
use App\Http\Controllers\Kasir\PosController;
use App\Http\Controllers\Laporan\LaporanKasirController;
use App\Http\Controllers\Pengadaan\PengadaanController;
use App\Http\Controllers\Manajemen\AccPurchasingController;
use App\Http\Controllers\Gudang\PermintaanPembelianController;
use App\Http\Controllers\Gudang\PenerimaanBarangController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ModulController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SubMenuController;
use App\Http\Controllers\Admin\ModularController;
use App\Http\Controllers\AdminPrivilegesController;
use App\Http\Controllers\Master\SupplierController;
use App\Http\Controllers\Master\BarangController;

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/{modul}', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/api/dashboard/kasir', [DashboardController::class, 'getKasirMetrics']);
    Route::get('/debug/menus/{modul}', function($modul) {
        $c = new DashboardController();
        $r = $c->show($modul);
        return $r->toResponse(request())->getData();
    });

    // Registrasi Routes
    Route::prefix('registrasi')->group(function() {
        Route::get('/pasien-baru', [PasienBaruController::class, 'create'])->name('registrasi.pasien-baru');
        Route::post('/pasien-baru', [PasienBaruController::class, 'store'])->name('registrasi.pasien-baru.store');
        Route::get('/pasien-lama', [PasienLamaController::class, 'index'])->name('registrasi.pasien-lama');
        
        Route::get('/cari-pasien', [\App\Http\Controllers\Registrasi\CariPasienController::class, 'index'])->name('registrasi.cari-pasien');
        
        Route::get('/rawat-jalan/form/{no_mr}', [RegistrasiKunjunganController::class, 'createPoli'])->name('registrasi.rawat-jalan.form');
        Route::post('/rawat-jalan/form/{no_mr}', [RegistrasiKunjunganController::class, 'storePoli'])->name('registrasi.rawat-jalan.store');
        Route::get('/igd/form/{no_mr}', [RegistrasiKunjunganController::class, 'createIgd'])->name('registrasi.igd.form');
        Route::post('/igd/form/{no_mr}', [RegistrasiKunjunganController::class, 'storeIgd'])->name('registrasi.igd.store');

        Route::get('/listing-poli', [\App\Http\Controllers\ListingPasienController::class, 'listingPoli'])->name('registrasi.listing-poli');
        Route::get('/permintaan-ri', [\App\Http\Controllers\ListingPasienController::class, 'permintaanRi'])->name('registrasi.permintaan-ri');
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

        Route::get('/info-tarif-umum', [\App\Http\Controllers\InformasiMedis3Controller::class, 'infoTarifUmum'])->name('registrasi.info-tarif-umum');
        Route::get('/paket-bedah', [\App\Http\Controllers\InformasiMedis3Controller::class, 'paketBedah'])->name('registrasi.paket-bedah');
        Route::get('/paket-melahirkan', [\App\Http\Controllers\InformasiMedis3Controller::class, 'paketMelahirkan'])->name('registrasi.paket-melahirkan');

        Route::get('/info-ruangan', [\App\Http\Controllers\InformasiMedis2Controller::class, 'infoRuangan'])->name('registrasi.info-ruangan');
        Route::get('/info-ruangan-2', [\App\Http\Controllers\InformasiMedis2Controller::class, 'infoRuangan2'])->name('registrasi.info-ruangan-2');
        Route::get('/harga-kamar', [\App\Http\Controllers\InformasiMedis2Controller::class, 'hargaKamar'])->name('registrasi.harga-kamar');

        Route::get('/jadwal-dokter', [\App\Http\Controllers\InformasiMedis1Controller::class, 'jadwalDokter'])->name('registrasi.jadwal-dokter');
        Route::get('/riwayat-pasien', [\App\Http\Controllers\InformasiMedis1Controller::class, 'riwayatPasien'])->name('registrasi.riwayat-pasien');

        Route::get('/perjanjian-pasien', [\App\Http\Controllers\PerjanjianController::class, 'perjanjianPasien'])->name('registrasi.perjanjian-pasien');
        Route::get('/daftar-perjanjian', [\App\Http\Controllers\PerjanjianController::class, 'daftarPerjanjian'])->name('registrasi.daftar-perjanjian');

        Route::get('/listing-online', [\App\Http\Controllers\VerifikasiOnlineController::class, 'index'])->name('registrasi.listing-online');
        Route::get('/listing-jkn', [\App\Http\Controllers\VerifikasiJknController::class, 'index'])->name('registrasi.listing-jkn');
        Route::get('/listing-jkn/data', [\App\Http\Controllers\VerifikasiJknController::class, 'data'])->name('registrasi.listing-jkn.data');

        // Legacy external URL viewer (for VClaim, His servers, etc.)
        Route::get('/legacy-ext', [\App\Http\Controllers\LegacyController::class, 'showExternal'])->name('registrasi.legacy-ext');
    });

    // Registrasi Routes
    Route::prefix('registrasi')->group(function() {
        Route::get('/pasien-baru', [PasienBaruController::class, 'create'])->name('registrasi.pasien-baru');
        Route::post('/pasien-baru', [PasienBaruController::class, 'store'])->name('registrasi.pasien-baru.store');
        Route::get('/pasien-lama', [PasienLamaController::class, 'index'])->name('registrasi.pasien-lama');
        
        Route::get('/cari-pasien', [\App\Http\Controllers\Registrasi\CariPasienController::class, 'index'])->name('registrasi.cari-pasien');
        
        Route::get('/rawat-jalan/form/{no_mr}', [RegistrasiKunjunganController::class, 'createPoli'])->name('registrasi.rawat-jalan.form');
        Route::post('/rawat-jalan/form/{no_mr}', [RegistrasiKunjunganController::class, 'storePoli'])->name('registrasi.rawat-jalan.store');
        Route::get('/igd/form/{no_mr}', [RegistrasiKunjunganController::class, 'createIgd'])->name('registrasi.igd.form');
        Route::post('/igd/form/{no_mr}', [RegistrasiKunjunganController::class, 'storeIgd'])->name('registrasi.igd.store');

        Route::get('/listing-poli', [\App\Http\Controllers\ListingPasienController::class, 'listingPoli'])->name('registrasi.listing-poli');
        Route::get('/permintaan-ri', [\App\Http\Controllers\ListingPasienController::class, 'permintaanRi'])->name('registrasi.permintaan-ri');
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

        Route::get('/info-tarif-umum', [\App\Http\Controllers\InformasiMedis3Controller::class, 'infoTarifUmum'])->name('registrasi.info-tarif-umum');
        Route::get('/paket-bedah', [\App\Http\Controllers\InformasiMedis3Controller::class, 'paketBedah'])->name('registrasi.paket-bedah');
        Route::get('/paket-melahirkan', [\App\Http\Controllers\InformasiMedis3Controller::class, 'paketMelahirkan'])->name('registrasi.paket-melahirkan');

        Route::get('/info-ruangan', [\App\Http\Controllers\InformasiMedis2Controller::class, 'infoRuangan'])->name('registrasi.info-ruangan');
        Route::get('/info-ruangan-2', [\App\Http\Controllers\InformasiMedis2Controller::class, 'infoRuangan2'])->name('registrasi.info-ruangan-2');
        Route::get('/harga-kamar', [\App\Http\Controllers\InformasiMedis2Controller::class, 'hargaKamar'])->name('registrasi.harga-kamar');

        Route::get('/jadwal-dokter', [\App\Http\Controllers\InformasiMedis1Controller::class, 'jadwalDokter'])->name('registrasi.jadwal-dokter');
        Route::get('/riwayat-pasien', [\App\Http\Controllers\InformasiMedis1Controller::class, 'riwayatPasien'])->name('registrasi.riwayat-pasien');

        Route::get('/perjanjian-pasien', [\App\Http\Controllers\PerjanjianController::class, 'perjanjianPasien'])->name('registrasi.perjanjian-pasien');
        Route::get('/daftar-perjanjian', [\App\Http\Controllers\PerjanjianController::class, 'daftarPerjanjian'])->name('registrasi.daftar-perjanjian');

        Route::get('/listing-online', [\App\Http\Controllers\VerifikasiOnlineController::class, 'index'])->name('registrasi.listing-online');
        Route::get('/listing-jkn', [\App\Http\Controllers\VerifikasiJknController::class, 'index'])->name('registrasi.listing-jkn');
        Route::get('/listing-jkn/data', [\App\Http\Controllers\VerifikasiJknController::class, 'data'])->name('registrasi.listing-jkn.data');

        // Legacy external URL viewer (for VClaim, His servers, etc.)
        Route::get('/legacy-ext', [\App\Http\Controllers\LegacyController::class, 'showExternal'])->name('registrasi.legacy-ext');
    });

    Route::prefix('poli')->group(function () {
        Route::get('/antrian-poli', [\App\Http\Controllers\PoliController::class, 'antrianPoli'])->name('poli.antrian-poli');

        Route::get('/general-consent', [ConsentController::class, 'generalConsent'])->name('poli.general-consent');
        Route::get('/pasien-dashboard/{no_mr}', [\App\Http\Controllers\PasienPoliController::class, 'dashboard'])->name('poli.pasien-dashboard');
        
        Route::get('/entry-pasien-luar', [\App\Http\Controllers\PasienLuarController::class, 'entryLuar'])->name('poli.entry-pasien-luar');
        Route::post('/entry-pasien-luar', [\App\Http\Controllers\PasienLuarController::class, 'storeLuar'])->name('poli.entry-pasien-luar.store');
    });

    Route::prefix('kasir')->name('kasir.')->group(function () {
        Route::get('/pos', [PosController::class, 'index'])->name('pos');
        Route::get('/api/barang-nm', [PosController::class, 'searchBarang'])->name('api.barang');
        Route::get('/api/recommendations', [PosController::class, 'getRecommendations'])->name('api.recommendations');
        Route::post('/checkout', [PosController::class, 'checkout'])->name('checkout');
        Route::get('/struk/{no_registrasi}', [PosController::class, 'printStruk'])->name('struk');
        
        // Riwayat Kasir
        Route::get('/riwayat', [PosController::class, 'getRiwayat'])->name('riwayat');
        Route::delete('/batal/{no_registrasi}', [PosController::class, 'batalTransaksi'])->name('batal');
        Route::get('/detail/{no_registrasi}', [PosController::class, 'getTransaksiDetail'])->name('detail');
        Route::post('/retur-parsial/{no_registrasi}', [PosController::class, 'returParsial'])->name('retur');
    });

    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/kasir', [LaporanKasirController::class, 'index'])->name('kasir');
        Route::get('/kasir/print', [LaporanKasirController::class, 'print'])->name('kasir.print');
        
        Route::get('/kinerja', [\App\Http\Controllers\LaporanController::class, 'kinerjaIndex'])->name('kinerja');
        Route::get('/kinerja/cetak-registrasi', [\App\Http\Controllers\LaporanController::class, 'cetakKinerjaRegistrasi'])->name('kinerja.cetak-registrasi');
        Route::get('/kinerja/cetak-batal', [\App\Http\Controllers\LaporanController::class, 'cetakKinerjaBatal'])->name('kinerja.cetak-batal');
        Route::get('/kinerja/cetak-rujukan', [\App\Http\Controllers\LaporanController::class, 'cetakKinerjaRujukan'])->name('kinerja.cetak-rujukan');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/user/search-pegawai', [UserController::class, 'searchPegawai'])->name('user.search-pegawai');

        Route::get('/modul', [ModulController::class, 'index'])->name('modul');
        Route::post('/modul', [ModulController::class, 'store'])->name('modul.store');
        Route::put('/modul/{id}', [ModulController::class, 'update'])->name('modul.update');
        Route::delete('/modul/{id}', [ModulController::class, 'destroy'])->name('modul.destroy');
        Route::post('/modul/sort', [ModulController::class, 'sort'])->name('modul.sort');

        Route::get('/menu', [MenuController::class, 'index'])->name('menu');
        Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
        Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
        Route::post('/menu/sort', [MenuController::class, 'sort'])->name('menu.sort');

        Route::get('/submenu', [SubMenuController::class, 'index'])->name('submenu');
        Route::post('/submenu', [SubMenuController::class, 'store'])->name('submenu.store');
        Route::put('/submenu/{id}', [SubMenuController::class, 'update'])->name('submenu.update');
        Route::delete('/submenu/{id}', [SubMenuController::class, 'destroy'])->name('submenu.destroy');
        Route::post('/submenu/sort', [SubMenuController::class, 'sort'])->name('submenu.sort');

        Route::get('/modular', [ModularController::class, 'index'])->name('modular');
        Route::post('/modular', [ModularController::class, 'store'])->name('modular.store');
        Route::put('/modular/{id}', [ModularController::class, 'update'])->name('modular.update');
        Route::delete('/modular/{id}', [ModularController::class, 'destroy'])->name('modular.destroy');
        Route::post('/modular/sort', [ModularController::class, 'sort'])->name('modular.sort');

        Route::get('/privileges', [AdminPrivilegesController::class, 'index'])->name('privileges');
        Route::post('/privileges/group', [AdminPrivilegesController::class, 'storeGroup'])->name('privileges.group.store');
        Route::put('/privileges/group/{id}', [AdminPrivilegesController::class, 'updateGroup'])->name('privileges.group.update');
        Route::delete('/privileges/group/{id}', [AdminPrivilegesController::class, 'destroyGroup'])->name('privileges.group.destroy');
        Route::get('/privileges/matrix', [AdminPrivilegesController::class, 'matrix'])->name('privileges.matrix');
        Route::post('/privileges/matrix', [AdminPrivilegesController::class, 'updateMatrix'])->name('privileges.matrix.update');
    });

    Route::prefix('master')->name('master.')->group(function () {
        Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
        Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
        Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

        Route::get('/barang', [BarangController::class, 'index'])->name('barang');
        Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
        Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    });

    Route::prefix('manajemen')->name('manajemen.')->group(function () {
        Route::get('/acc-purchasing', [AccPurchasingController::class, 'index']);
        Route::post('/acc-purchasing/{id}/approve', [AccPurchasingController::class, 'approve']);
    });

    Route::prefix('pengadaan')->name('pengadaan.')->group(function () {
        Route::get('/po', [PengadaanController::class, 'index'])->name('po.index');
        Route::get('/po/create', [PengadaanController::class, 'create'])->name('po.create');
        Route::post('/po', [PengadaanController::class, 'store'])->name('po.store');
        Route::get('/api/search-supplier', [PengadaanController::class, 'searchSupplier'])->name('api.search-supplier');
        Route::get('/api/search-pr', [PengadaanController::class, 'searchPR'])->name('api.search-pr');
        Route::get('/api/search-barang', [PengadaanController::class, 'searchBarang'])->name('api.search-barang');
    });

    Route::prefix('gudang')->name('gudang.')->group(function () {
        Route::get('/permintaan-pembelian', [PermintaanPembelianController::class, 'index']);
        Route::get('/permintaan-pembelian/create', [PermintaanPembelianController::class, 'create'])->name('permintaan-pembelian.create');
        Route::post('/permintaan-pembelian', [PermintaanPembelianController::class, 'store'])->name('permintaan-pembelian.store');

        Route::get('/penerimaan', [PenerimaanBarangController::class, 'index'])->name('penerimaan.index');
        Route::get('/penerimaan/create', [PenerimaanBarangController::class, 'create'])->name('penerimaan.create');
        Route::post('/penerimaan', [PenerimaanBarangController::class, 'store'])->name('penerimaan.store');
        Route::get('/api/search-po', [PenerimaanBarangController::class, 'searchPo'])->name('api.search-po');
    });

    // Helper API
    Route::get('/api/search-barang-nm', [PenerimaanBarangController::class, 'searchBarangNm'])->name('api.search-barang-nm');

    // Legacy Route Catcher
    Route::get('/{legacy_dir}/{legacy_file}', [LegacyController::class, 'show'])
        ->where('legacy_dir', 'mod_.*')
        ->name('legacy.view');

});

Route::get('/', function () {
    return redirect()->route('login');
});

