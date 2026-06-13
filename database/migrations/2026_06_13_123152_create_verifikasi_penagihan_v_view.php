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
        DB::statement("CREATE VIEW dbo.verifikasi_penagihan_v
AS
SELECT     dbo.tc_tagih.no_invoice_tagih, dbo.tc_tagih.jenis_tagih, dbo.tc_tagih.tgl_tagih AS tgl, dbo.tc_tagih.jumlah_tagih AS jumlah, dbo.tc_tagih.diskon, 
                      dbo.tc_tagih.nama_tertagih, dbo.tc_tagih.id_tertagih, dbo.tc_tagih.id_dd_user AS petugas, dbo.tc_tagih.tgl_input, dbo.tc_tagih.tgl_jt_tempo, dbo.tc_tagih.tgl_ver, 
                      dbo.tc_tagih.status_ver, dbo.tc_tagih.id_tc_tagih, dbo.mt_perusahaan.nama_perusahaan, dbo.mt_perusahaan.kode_perusahaan
FROM         dbo.tc_tagih INNER JOIN
                      dbo.mt_perusahaan ON dbo.tc_tagih.id_tertagih = dbo.mt_perusahaan.kode_perusahaan
WHERE     (YEAR(dbo.tc_tagih.tgl_tagih) >= 2016) AND (dbo.tc_tagih.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [verifikasi_penagihan_v]");
    }
};
