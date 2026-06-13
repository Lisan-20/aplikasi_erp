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
        DB::statement("CREATE VIEW dbo.LIS_ORDER_V
AS
SELECT     ID, MESSAGE_DT, ORDER_CONTROL, PID, PNAME, ADDRESS, PTYPE, BIRTH_DT, SEX, ONO, REQUEST_DT, SOURCE, CLINICIAN, ROOM_NO, 
                      PRIORITY, COMMENT, VISITNO, ORDER_TESTID, FLAG_STATUS, FLAG_EDIT
FROM         OPENQUERY(lis_sysmax, 'select * from LIS_ORDER') AS LIS_ORDER
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [LIS_ORDER_V]");
    }
};
