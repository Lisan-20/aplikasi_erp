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
        DB::unprepared("CREATE PROC [dbo].[sp_update_hasil_lis]
 @kode_penunjang VARCHAR(20)

AS
BEGIN

UPDATE a
SET a.hasil = b.hasil, a.nilai_rujuk = b.nilai_rujuk, a.satuan = b.satuan, a.keterangan = b.keterangan, a.status_lis = b.status_lis, a.type_hasil = b.type_hasil
FROM dbAmanda.dbo.order_lis2 a
INNER JOIN db_MedLis.dbo.order_lis2 b
    ON a.kode_penunjang = b.kode_penunjang and a.kode_mt_hasilpm = b.kode_mt_hasilpm
WHERE a.kode_penunjang = @kode_penunjang

END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_update_hasil_lis");
    }
};
