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
        DB::statement("CREATE OR ALTER VIEW dbo.pembedahan_RL_36_v
AS
SELECT     dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.kode_bagian, COUNT(dbo.tc_trans_pelayanan.nama_tindakan) AS jumlah, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, 
                      MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, dbo.mt_master_tarif.referensi, dbo.tc_trans_kasir.status_batal, dbo.tingkatan_3_ok_v.nama_tarif, dbo.tingkatan_4_ok_v.nama_tarif AS [4], 
                      dbo.tc_trans_kasir.tgl_jam, dbo.tingkatan_4_ok_v.kode_tarif
FROM         dbo.tingkatan_4_ok_v INNER JOIN
                      dbo.mt_master_tarif ON dbo.tingkatan_4_ok_v.kode_tarif = dbo.mt_master_tarif.referensi INNER JOIN
                      dbo.tingkatan_3_ok_v ON dbo.tingkatan_4_ok_v.referensi = dbo.tingkatan_3_ok_v.kode_tarif LEFT OUTER JOIN
                      dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi ON dbo.mt_master_tarif.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif
GROUP BY dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.kode_bagian, YEAR(dbo.tc_trans_kasir.tgl_jam), MONTH(dbo.tc_trans_kasir.tgl_jam), dbo.mt_master_tarif.referensi, 
                      dbo.tc_trans_kasir.status_batal, dbo.tingkatan_3_ok_v.nama_tarif, dbo.tingkatan_4_ok_v.nama_tarif, dbo.tc_trans_kasir.tgl_jam, dbo.tingkatan_4_ok_v.kode_tarif
HAVING      (dbo.mt_master_tarif.tingkatan >= 3) AND (dbo.mt_master_tarif.kode_bagian = '030901') AND (dbo.tc_trans_kasir.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pembedahan_RL_36_v]");
    }
};
