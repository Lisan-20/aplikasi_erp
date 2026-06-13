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
        DB::statement("CREATE VIEW dbo.pm_hasil_lis_ok_v
AS
SELECT     TOP (100) PERCENT dbo.reshd.ID, dbo.reshd.PID, dbo.reshd.APID, dbo.reshd.PNAME, dbo.reshd.ONO, dbo.reshd.LNO, dbo.reshd.REQUEST_DT, 
                      dbo.reshd.SOURCE_CD, dbo.reshd.SOURCE_NM, dbo.reshd.CLINICIAN_CD, dbo.reshd.PRIORITY, dbo.reshd.CLINICIAN_NM, dbo.reshd.VISITNO, 
                      dbo.reshd.FLAG_KIRIM, dbo.reshd.COMMENT, dbo.resdt.TEST_CD, dbo.resdt.DATA_TYP, dbo.resdt.TEST_NM, dbo.resdt.RESULT_FT, 
                      dbo.resdt.RESULT_VALUE, dbo.resdt.UNIT, dbo.resdt.FLAG, dbo.resdt.REF_RANGE, dbo.resdt.STATUS, dbo.resdt.TEST_COMMENT, 
                      dbo.resdt.VALIDATE_BY, dbo.resdt.VALIDATE_ON, dbo.resdt.DISP_SEQ, dbo.resdt.ORDER_TESTID, dbo.resdt.ORDER_TESTNM, 
                      dbo.resdt.TEST_GROUP, dbo.resdt.ITEM_PARENT
FROM         dbo.reshd INNER JOIN
                      dbo.resdt ON dbo.reshd.ONO = dbo.resdt.ONO
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_hasil_lis_ok_v]");
    }
};
