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
        DB::statement("CREATE VIEW dbo.upd_id_tc_permohonan_nm
AS
SELECT     dbo.tc_permohonan_nm.id_tc_permohonan, dbo.tc_permohonan_nm_import.kode_permohonan, dbo.tc_permohonan_nm_import.id_tc_permohonan AS ID
FROM         dbo.tc_permohonan_nm_import INNER JOIN
                      dbo.tc_permohonan_nm ON dbo.tc_permohonan_nm_import.kode_permohonan = dbo.tc_permohonan_nm.kode_permohonan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_id_tc_permohonan_nm]");
    }
};
