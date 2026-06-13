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
        DB::unprepared("create proc [dbo].[th_tc_bedah_kirim_sp]
as

DECLARE @Data INT

SET @Data = (select COUNT(RowNum) from kirim_th_tc_bedah_v where flag_kirim_th is null)

IF (@Data=0)
BEGIN
UPDATE kirim_th_tc_bedah_v SET flag_kirim_th=NULL;
END

DELETE from th_tc_rencana_operasi;

INSERT INTO th_tc_rencana_operasi (no_registrasi, no_mr, nama_pasien, tgl_rencana, jenis_op,kode_booking, RowNum) SELECT TOP(16) no_registrasi, no_mr, nama_pasien, tgl_rencana, jenis_op,kode_booking, RowNum FROM kirim_th_tc_bedah_v where flag_kirim_th is null order by RowNum ASC;

update tc_rencana_operasi set flag_kirim_th=1 Where no_registrasi in (select no_registrasi from th_tc_rencana_operasi);

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS th_tc_bedah_kirim_sp");
    }
};
