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
        DB::statement("CREATE VIEW dbo.fee_pasien_sc_paket_v
AS
SELECT     dbo.mt_klasifikasi_insentif.kode_klasifikasi, dbo.mt_klasifikasi_insentif.nama_klasifikasi, dbo.pasien_sc_paket_v.bulan_plg AS bulan, 
                      dbo.pasien_sc_paket_v.tahun_plg AS tahun, COUNT(dbo.pasien_sc_paket_v.no_mr) AS jumlah_pasien, dbo.mt_klasifikasi_insentif.plafon, 
                      COUNT(dbo.pasien_sc_paket_v.no_mr) * dbo.mt_klasifikasi_insentif.plafon AS fee, dbo.mt_klasifikasi_insentif.id_mt_kategori_ins_det
FROM         dbo.pasien_sc_paket_v INNER JOIN
                      dbo.mt_klasifikasi_insentif ON dbo.pasien_sc_paket_v.kode_klasifikasi = dbo.mt_klasifikasi_insentif.kode_klasifikasi
GROUP BY dbo.pasien_sc_paket_v.bulan_plg, dbo.pasien_sc_paket_v.tahun_plg, dbo.mt_klasifikasi_insentif.plafon, dbo.mt_klasifikasi_insentif.nama_klasifikasi, 
                      dbo.mt_klasifikasi_insentif.kode_klasifikasi, dbo.mt_klasifikasi_insentif.id_mt_kategori_ins_det
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_pasien_sc_paket_v]");
    }
};
