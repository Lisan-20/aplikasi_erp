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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_sangsi_v
AS
SELECT     dbo.mt_karyawan.npp, dbo.mt_karyawan.nama_pegawai, dbo.tc_hukuman.id_hrdd_hukuman, dbo.tc_hukuman.no_sk_hukuman, dbo.tc_hukuman.tgl_sk_hukuman, 
                      dbo.tc_hukuman.pemberi_hukuman, dbo.tc_hukuman.input_id, dbo.tc_hukuman.status, dbo.tc_hukuman.id_tc_hukuman, dbo.dd_hukuman.hukuman
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.tc_hukuman ON dbo.mt_karyawan.npp = dbo.tc_hukuman.npp INNER JOIN
                      dbo.dd_hukuman ON dbo.tc_hukuman.id_hrdd_hukuman = dbo.dd_hukuman.id_dd_hukuman
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_sangsi_v]");
    }
};
