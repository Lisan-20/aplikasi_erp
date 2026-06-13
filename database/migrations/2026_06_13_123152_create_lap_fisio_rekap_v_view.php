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
        DB::statement("CREATE VIEW dbo.lap_fisio_rekap_v
AS
SELECT     dbo.tc_registrasi.no_mr, dbo.tc_registrasi.no_registrasi, dbo.mt_master_pasien.nama_pasien, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.status_batal, 
                      dbo.mt_bagian.nama_bagian, dbo.mt_bagian.id_mt_bagian, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.status_batal AS Expr1, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_master_pasien.no_mr = dbo.tc_trans_pelayanan.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian
GROUP BY dbo.tc_registrasi.no_mr, dbo.tc_registrasi.no_registrasi, dbo.mt_master_pasien.nama_pasien, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.status_batal, 
                      dbo.mt_bagian.nama_bagian, dbo.mt_bagian.id_mt_bagian, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1
HAVING      (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.jenis_tindakan = 3) AND (dbo.tc_trans_pelayanan.kode_bagian = '050301') AND 
                      (NOT (dbo.tc_trans_pelayanan.nama_tindakan LIKE 'konsul%')) AND (dbo.tc_trans_pelayanan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_fisio_rekap_v]");
    }
};
