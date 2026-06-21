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
        DB::statement("CREATE OR ALTER VIEW dbo.coba_view
AS
SELECT     lis_sysmax.dbo.reshd.ID, lis_sysmax.dbo.reshd.PID, lis_sysmax.dbo.reshd.APID, lis_sysmax.dbo.reshd.PNAME, lis_sysmax.dbo.reshd.ONO, 
                      lis_sysmax.dbo.resdt.TEST_GROUP, lis_sysmax.dbo.resdt.TEST_NM, lis_sysmax.dbo.resdt.RESULT_VALUE, lis_sysmax.dbo.resdt.UNIT, 
                      lis_sysmax.dbo.resdt.REF_RANGE, lis_sysmax.dbo.reshd.LNO, lis_sysmax.dbo.reshd.REQUEST_DT, lis_sysmax.dbo.reshd.SOURCE_CD, 
                      lis_sysmax.dbo.reshd.CLINICIAN_CD, lis_sysmax.dbo.reshd.CLINICIAN_NM, lis_sysmax.dbo.reshd.PRIORITY, lis_sysmax.dbo.reshd.COMMENT, 
                      lis_sysmax.dbo.reshd.VISITNO, lis_sysmax.dbo.reshd.FLAG_KIRIM, lis_sysmax.dbo.reshd.SOURCE_NM, lis_sysmax.dbo.resdt.DISP_SEQ
FROM         lis_sysmax.dbo.reshd INNER JOIN
                      lis_sysmax.dbo.resdt ON lis_sysmax.dbo.reshd.ONO = lis_sysmax.dbo.resdt.ONO
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [coba_view]");
    }
};
