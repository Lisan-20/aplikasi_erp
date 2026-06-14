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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rl3_lab_v2
AS
SELECT     dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.kode_bagian, COUNT(dbo.mt_master_tarif.nama_tarif) AS jumlah, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, dbo.mt_master_tarif.nama_tarif, 
                      MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, dbo.tc_trans_kasir.status_batal, dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.jenis_tindakan, dbo.tc_trans_kasir.tgl_jam
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_master_tarif.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_trans_kasir.no_registrasi
GROUP BY dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.kode_bagian, YEAR(dbo.tc_trans_kasir.tgl_jam), dbo.mt_master_tarif.nama_tarif, MONTH(dbo.tc_trans_kasir.tgl_jam), 
                      dbo.tc_trans_kasir.status_batal, dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.jenis_tindakan, dbo.tc_trans_kasir.tgl_jam
HAVING      (dbo.mt_master_tarif.tingkatan > 3) AND (dbo.mt_master_tarif.kode_bagian = '050101') AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.mt_master_tarif.jenis_tindakan = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rl3_lab_v2]");
    }
};
