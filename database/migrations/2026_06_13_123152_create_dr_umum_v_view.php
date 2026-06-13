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
        DB::statement("CREATE VIEW dbo.dr_umum_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_jkn.id_jenis_layanan, dbo.tc_trans_jkn.kode_bagian, 
                      dbo.mt_karyawan.kode_spesialisasi, dbo.tc_trans_pelayanan.jenis_tindakan
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_trans_pelayanan.kode_dokter1 = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.tc_trans_jkn ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_jkn.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_jkn.id_jenis_layanan = 6) AND (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0) AND (dbo.tc_trans_pelayanan.jenis_tindakan = 4) AND 
                      (dbo.mt_karyawan.kode_spesialisasi = 1) AND (dbo.tc_trans_pelayanan.nama_tindakan LIKE 'visit%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dr_umum_v]");
    }
};
