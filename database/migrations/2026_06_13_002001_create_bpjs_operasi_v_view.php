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
        DB::statement("CREATE OR ALTER VIEW dbo.bpjs_operasi_v
AS
SELECT DISTINCT 
                      dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.mt_master_tarif.nama_tarif
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.kode_tarif IN
                          (SELECT     kode_tarif
                            FROM          dbo.mt_master_tarif AS mt_master_tarif_1
                            WHERE      (kode_bagian IN ('030501', '030901')) AND (tingkatan = 5))) AND (dbo.tc_registrasi.kode_kelompok IN (8, 9, 10))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bpjs_operasi_v]");
    }
};
