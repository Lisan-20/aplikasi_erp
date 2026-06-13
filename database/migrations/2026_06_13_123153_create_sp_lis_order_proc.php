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
        DB::unprepared("CREATE proc [dbo].[sp_lis_order]

 @ONO as varchar
as

begin
DELETE LIS_ORDER WHERE (MESSAGE_DT IS NULL);
DELETE lis_sysmax.dbo.LIS_ORDER WHERE (MESSAGE_DT IS NULL);

INSERT INTO lis_sysmax.dbo.LIS_ORDER (MESSAGE_DT,	ORDER_CONTROL,	PID,	PNAME,	ADDRESS,	PTYPE,	BIRTH_DT,	SEX,	ONO,	REQUEST_DT,	SOURCE,	CLINICIAN,	ROOM_NO,	PRIORITY,	COMMENT,	VISITNO,	ORDER_TESTID)
SELECT MESSAGE_DT,	ORDER_CONTROL,	PID,	PNAME,	ADDRESS,	PTYPE,	BIRTH_DT,	SEX,	ONO,	REQUEST_DT,	SOURCE,	CLINICIAN,	ROOM_NO,	PRIORITY,	COMMENT,	VISITNO,	ORDER_TESTID
FROM LIS_ORDER Where ONO=@ONO; 

UPDATE lis_sysmax.dbo.LIS_ORDER set KIRIM=1 WHERE ONO=@ONO;

DELETE LIS_ORDER WHERE (MESSAGE_DT IS NULL);
DELETE lis_sysmax.dbo.LIS_ORDER WHERE (MESSAGE_DT IS NULL);

end");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_lis_order");
    }
};
