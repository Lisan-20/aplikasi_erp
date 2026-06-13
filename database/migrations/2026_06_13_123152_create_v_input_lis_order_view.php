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
        DB::statement("CREATE OR ALTER VIEW dbo.v_input_lis_order
AS
SELECT     dbo.LIS_ORDER_V.MESSAGE_DT, dbo.LIS_ORDER_V.ORDER_CONTROL, dbo.LIS_ORDER_V.PID, dbo.LIS_ORDER_V.PNAME, 
                      dbo.LIS_ORDER_V.ADDRESS, dbo.LIS_ORDER_V.PTYPE, dbo.LIS_ORDER_V.BIRTH_DT, dbo.LIS_ORDER_V.SEX, dbo.LIS_ORDER_V.ONO, 
                      dbo.LIS_ORDER_V.REQUEST_DT, dbo.LIS_ORDER_V.SOURCE, dbo.LIS_ORDER_V.CLINICIAN, dbo.LIS_ORDER_V.ROOM_NO, 
                      dbo.LIS_ORDER_V.PRIORITY, dbo.LIS_ORDER_V.COMMENT, dbo.LIS_ORDER_V.VISITNO, dbo.LIS_ORDER_V.ORDER_TESTID, 
                      dbo.LIS_ORDER_V.FLAG_STATUS, dbo.LIS_ORDER_V.FLAG_EDIT, dbo.LIS_ORDER.MESSAGE_DT AS Expr1, 
                      dbo.LIS_ORDER.ORDER_CONTROL AS Expr2, dbo.LIS_ORDER.PID AS Expr3, dbo.LIS_ORDER.PNAME AS Expr4, dbo.LIS_ORDER.ADDRESS AS Expr5, 
                      dbo.LIS_ORDER.PTYPE AS Expr6, dbo.LIS_ORDER.BIRTH_DT AS Expr7, dbo.LIS_ORDER.SEX AS Expr8, dbo.LIS_ORDER.ONO AS Expr9, 
                      dbo.LIS_ORDER.REQUEST_DT AS Expr10, dbo.LIS_ORDER.SOURCE AS Expr11, dbo.LIS_ORDER.CLINICIAN AS Expr12, 
                      dbo.LIS_ORDER.ROOM_NO AS Expr13, dbo.LIS_ORDER.PRIORITY AS Expr14, dbo.LIS_ORDER.COMMENT AS Expr15, 
                      dbo.LIS_ORDER.VISITNO AS Expr16, dbo.LIS_ORDER.ORDER_TESTID AS Expr17, dbo.LIS_ORDER.FLAG_STATUS AS Expr18, 
                      dbo.LIS_ORDER.FLAG_EDIT AS Expr19, dbo.LIS_ORDER.KIRIM
FROM         dbo.LIS_ORDER_V RIGHT OUTER JOIN
                      dbo.LIS_ORDER ON dbo.LIS_ORDER_V.ID = dbo.LIS_ORDER.ID
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_input_lis_order]");
    }
};
