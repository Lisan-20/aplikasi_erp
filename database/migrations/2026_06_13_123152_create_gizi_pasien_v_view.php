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
        DB::statement("CREATE VIEW dbo.gizi_pasien_v
AS
SELECT     dbo.ri_cari_pasien_v.no_mr, dbo.ri_cari_pasien_v.nama_pasien, dbo.ri_cari_pasien_v.bag_pas, dbo.ri_cari_pasien_v.kode_ruangan, 
                      dbo.ri_cari_pasien_v.nama_bagian, dbo.ri_cari_pasien_v.nama_klas, dbo.tc_sensus_gizi.diet, dbo.tc_sensus_gizi.perubahan_diet, 
                      dbo.tc_sensus_gizi.tgl, dbo.ri_cari_pasien_v.tgl_masuk
FROM         dbo.ri_cari_pasien_v INNER JOIN
                      dbo.tc_sensus_gizi ON dbo.ri_cari_pasien_v.no_mr = dbo.tc_sensus_gizi.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [gizi_pasien_v]");
    }
};
