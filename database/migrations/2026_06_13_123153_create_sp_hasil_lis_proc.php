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
        DB::unprepared("CREATE proc [dbo].[sp_hasil_lis]

 @ONO as varchar(20)
as

begin

INSERT INTO dbo.reshd(ID,
						PID,
						APID,
						PNAME,
						ONO,
						LNO,
						REQUEST_DT,
						SOURCE_CD,
						SOURCE_NM,
						CLINICIAN_CD,
						CLINICIAN_NM,
						PRIORITY,
						COMMENT,
						VISITNO,
						FLAG_KIRIM)
				SELECT ID,
						PID,
						APID,
						PNAME,
						ONO,
						LNO,
						REQUEST_DT,
						SOURCE_CD,
						SOURCE_NM,
						CLINICIAN_CD,
						CLINICIAN_NM,
						PRIORITY,
						COMMENT,
						VISITNO,
						FLAG_KIRIM
FROM lis_sysmax.dbo.reshd
WHERE ONO =@ONO AND (FLAG_KIRIM IS NULL OR FLAG_KIRIM=0);

INSERT INTO dbo.resdt (ID,
						ONO,
						SEQNO,
						TEST_CD,
						TEST_NM,
						DATA_TYP,
						RESULT_VALUE,
						RESULT_FT,
						UNIT,
						FLAG,
						REF_RANGE,
						STATUS,
						TEST_COMMENT,
						VALIDATE_BY,
						VALIDATE_ON,
						DISP_SEQ,
						ORDER_TESTID,
						ORDER_TESTNM,
						TEST_GROUP,
						ITEM_PARENT,
						FLAG_KIRIM)
				SELECT 	ID,
						ONO,
						SEQNO,
						TEST_CD,
						TEST_NM,
						DATA_TYP,
						RESULT_VALUE,
						RESULT_FT,
						UNIT,
						FLAG,
						REF_RANGE,
						STATUS,
						TEST_COMMENT,
						VALIDATE_BY,
						VALIDATE_ON,
						DISP_SEQ,
						ORDER_TESTID,
						ORDER_TESTNM,
						TEST_GROUP,
						ITEM_PARENT,
						FLAG_KIRIM
FROM lis_sysmax.dbo.resdt
WHERE ONO =@ONO AND (FLAG_KIRIM IS NULL OR FLAG_KIRIM=0);

UPDATE lis_sysmax.dbo.reshd set FLAG_KIRIM=1 WHERE ONO=@ONO;
UPDATE lis_sysmax.dbo.resdt set FLAG_KIRIM=1 WHERE ONO=@ONO;

end");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_hasil_lis");
    }
};
