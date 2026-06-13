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
        DB::statement("CREATE OR ALTER VIEW dbo.update_propinsi_v
AS
SELECT     TOP (100) PERCENT propinsi_1.KDPROPINSI, propinsi_1.NAMAPROPINSI, dbo.dc_propinsi.kode_propinsi, CAST(propinsi_1.KDPROPINSI AS int) AS kode
FROM         SERVER.dbmds2.dbo.propinsi AS propinsi_1 INNER JOIN
                      dbo.dc_propinsi ON propinsi_1.NAMAPROPINSI = dbo.dc_propinsi.nama_propinsi COLLATE Latin1_General_CI_AS
ORDER BY propinsi_1.NAMAPROPINSI
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_propinsi_v]");
    }
};
