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
        DB::statement("CREATE OR ALTER VIEW dbo.penempatan_bagian_v
AS
SELECT     dbo.tc_penempatan.npp, dbo.tc_penempatan.id_tc_penempatan, dbo.tc_penempatan.kode_bagian_baru AS kode_bagian, dbo.tc_penempatan.tgl_akhir, 
                      dbo.mt_bagian.nama_bagian
FROM         dbo.tc_penempatan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_penempatan.kode_bagian_baru = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_penempatan.tgl_akhir IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penempatan_bagian_v]");
    }
};
