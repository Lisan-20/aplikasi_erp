<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE OR ALTER VIEW dbo.upd_harga_beli_film_rad
AS
SELECT     dbo.tran_sed.no_registrasi, dbo.tran_sed.no_kunjungan, dbo.tran_sed.no_mr, dbo.tran_sed.seri_kuitansi, dbo.tran_sed.no_kuitansi, dbo.tran_sed.tx_nominal, 
                      dbo.tran_sed.jumlah, dbo.tran_sed.jenis_tindakan, dbo.tran_sed.kode, dbo.tran_sed.kode_tc_trans_kasir, dbo.tran_sed.nama_tindakan, dbo.tran_sed.tgl_jam, 
                      dbo.tran_sed.kode_bagian, dbo.tran_sed.kode_trans_pelayanan, dbo.tran_sed.vol, dbo.tran_sed.harga_beli, dbo.pm_tc_obalkes.harga_beli AS harga_beli_pm, 
                      dbo.pm_tc_obalkes.volume, dbo.pm_tc_obalkes.kode_brg, dbo.tran_sed.kode_barang
FROM         dbo.tran_sed INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tran_sed.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan INNER JOIN
                      dbo.pm_tc_obalkes ON dbo.tc_trans_pelayanan.kode_tarif = dbo.pm_tc_obalkes.kode_tarif AND 
                      dbo.tc_trans_pelayanan.kode_penunjang = dbo.pm_tc_obalkes.kode_penunjang
WHERE     (dbo.tran_sed.kode <> 4) AND (dbo.tran_sed.harga_beli IS NULL) OR
                      (dbo.tran_sed.kode <> 4) AND (dbo.tran_sed.vol IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_harga_beli_film_rad]");
    }
};
