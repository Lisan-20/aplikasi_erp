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
        DB::statement("CREATE VIEW dbo.fee_pasien_perina_sc_v
AS
SELECT     dbo.mt_klasifikasi_insentif.kode_klasifikasi, dbo.mt_klasifikasi_insentif.nama_klasifikasi, dbo.pasien_perina_sc_v.bulan, dbo.pasien_perina_sc_v.tahun, 
                      COUNT(dbo.pasien_perina_sc_v.no_mr) AS jumlah_pasien, dbo.mt_klasifikasi_insentif.plafon, COUNT(dbo.pasien_perina_sc_v.no_mr) 
                      * dbo.mt_klasifikasi_insentif.plafon AS fee, dbo.mt_klasifikasi_insentif.id_mt_kategori_ins_det
FROM         dbo.pasien_perina_sc_v INNER JOIN
                      dbo.mt_klasifikasi_insentif ON dbo.pasien_perina_sc_v.kode_klasifikasi = dbo.mt_klasifikasi_insentif.kode_klasifikasi
GROUP BY dbo.mt_klasifikasi_insentif.kode_klasifikasi, dbo.mt_klasifikasi_insentif.nama_klasifikasi, dbo.pasien_perina_sc_v.bulan, dbo.pasien_perina_sc_v.tahun, 
                      dbo.mt_klasifikasi_insentif.plafon, dbo.mt_klasifikasi_insentif.id_mt_kategori_ins_det
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_pasien_perina_sc_v]");
    }
};
