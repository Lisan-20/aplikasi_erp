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
        DB::statement("CREATE VIEW dbo.lap_jasa_kirim_v
AS
SELECT        dbo.tc_registrasi.no_mr, dbo.tc_registrasi.no_registrasi, dbo.mt_master_pasien.nama_pasien, dbo.dc_asal_pasien.asal_pasien, dbo.dc_sub_asal_pasien.detail, dbo.tc_registrasi.kode_bagian_masuk, 
                         dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.id_dc_asal_pasien, dbo.tc_registrasi.id_dc_sub_asal_pasien, dbo.tc_registrasi.status_batal
FROM            dbo.tc_registrasi INNER JOIN
                         dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr LEFT OUTER JOIN
                         dbo.dc_sub_asal_pasien ON dbo.tc_registrasi.id_dc_sub_asal_pasien = dbo.dc_sub_asal_pasien.id_dc_sub_asal_pasien LEFT OUTER JOIN
                         dbo.dc_asal_pasien ON dbo.tc_registrasi.id_dc_asal_pasien = dbo.dc_asal_pasien.id_dc_asal_pasien
WHERE        (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_jasa_kirim_v]");
    }
};
