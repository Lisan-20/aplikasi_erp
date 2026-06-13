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
        DB::statement("CREATE VIEW dbo.lap_bulanan_vk_v
AS
SELECT        dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, 
                         dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_pelayanan.kode_bagian
FROM            dbo.tc_trans_pelayanan INNER JOIN
                         dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE        (dbo.tc_trans_pelayanan.jenis_tindakan = 4) AND (dbo.tc_trans_pelayanan.kode_bagian = '030501')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_bulanan_vk_v]");
    }
};
