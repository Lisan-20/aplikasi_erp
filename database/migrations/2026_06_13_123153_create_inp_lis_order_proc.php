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
        DB::unprepared("
CREATE proc [dbo].[inp_lis_order]
 @ONO as int

as

begin
INSERT INTO LIS_ORDER_V (MESSAGE_DT,	ORDER_CONTROL,	PID,	PNAME,	ADDRESS,	PTYPE,	BIRTH_DT,	SEX,	ONO,	REQUEST_DT,	SOURCE,	CLINICIAN,	ROOM_NO,	PRIORITY,	COMMENT,	VISITNO,	ORDER_TESTID)
SELECT MESSAGE_DT,	ORDER_CONTROL,	PID,	PNAME,	ADDRESS,	PTYPE,	BIRTH_DT,	SEX,	ONO,	REQUEST_DT,	SOURCE,	CLINICIAN,	ROOM_NO,	PRIORITY,	COMMENT,	VISITNO,	ORDER_TESTID
FROM LIS_ORDER Where ONO=@ONO; 

UPDATE LIS_ORDER set KIRIM=1 WHERE ONO=@ONO;

end
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_lis_order");
    }
};
