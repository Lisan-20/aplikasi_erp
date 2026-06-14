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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_hasil_lis_v
AS
SELECT     lis_sysmax.dbo.reshd.ID, lis_sysmax.dbo.reshd.PID, lis_sysmax.dbo.reshd.APID, lis_sysmax.dbo.reshd.PNAME, lis_sysmax.dbo.reshd.ONO, 
                      lis_sysmax.dbo.reshd.LNO, lis_sysmax.dbo.reshd.REQUEST_DT, lis_sysmax.dbo.reshd.SOURCE_CD, lis_sysmax.dbo.reshd.SOURCE_NM, 
                      lis_sysmax.dbo.reshd.CLINICIAN_CD, lis_sysmax.dbo.reshd.PRIORITY, lis_sysmax.dbo.reshd.CLINICIAN_NM, lis_sysmax.dbo.reshd.VISITNO, 
                      lis_sysmax.dbo.reshd.FLAG_KIRIM, lis_sysmax.dbo.reshd.COMMENT, lis_sysmax.dbo.resdt.TEST_CD, lis_sysmax.dbo.resdt.DATA_TYP, 
                      lis_sysmax.dbo.resdt.TEST_NM, lis_sysmax.dbo.resdt.RESULT_FT, lis_sysmax.dbo.resdt.RESULT_VALUE, lis_sysmax.dbo.resdt.UNIT, 
                      lis_sysmax.dbo.resdt.FLAG, lis_sysmax.dbo.resdt.REF_RANGE, lis_sysmax.dbo.resdt.STATUS, lis_sysmax.dbo.resdt.TEST_COMMENT, 
                      lis_sysmax.dbo.resdt.VALIDATE_BY, lis_sysmax.dbo.resdt.VALIDATE_ON, lis_sysmax.dbo.resdt.DISP_SEQ, lis_sysmax.dbo.resdt.ORDER_TESTID, 
                      lis_sysmax.dbo.resdt.ORDER_TESTNM, lis_sysmax.dbo.resdt.TEST_GROUP, lis_sysmax.dbo.resdt.ITEM_PARENT
FROM         lis_sysmax.dbo.reshd INNER JOIN
                      lis_sysmax.dbo.resdt ON lis_sysmax.dbo.reshd.ONO = lis_sysmax.dbo.resdt.ONO
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_hasil_lis_v]");
    }
};
