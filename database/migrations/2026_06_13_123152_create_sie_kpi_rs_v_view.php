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
        DB::statement("CREATE OR ALTER VIEW dbo.sie_kpi_rs_v
AS
SELECT     dbo.dd_sie_kpi.id_group, dbo.dd_group_sie.nama_group, dbo.dd_sie_kpi.id_goup_sasaran, dbo.dd_sie_sasaran.nama_sasaran, dbo.dd_sie_kpi.id_kpi, 
                      dbo.dd_sie_kpi.nama_kpi, dbo.dd_sie_kpi.satuan
FROM         dbo.dd_sie_kpi INNER JOIN
                      dbo.dd_group_sie ON dbo.dd_sie_kpi.id_group = dbo.dd_group_sie.id_group INNER JOIN
                      dbo.dd_sie_sasaran ON dbo.dd_sie_kpi.id_goup_sasaran = dbo.dd_sie_sasaran.id_goup_sasaran
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sie_kpi_rs_v]");
    }
};
