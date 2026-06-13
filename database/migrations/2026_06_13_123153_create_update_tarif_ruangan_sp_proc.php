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

CREATE OR ALTER PROCEDURE [dbo].[update_tarif_ruangan_sp]
AS
BEGIN
 
declare @kode_bagian_cari varchar(6);
declare @persen int;

update mt_master_tarif_ruangan set harga_r=harga_r*@persen/100 where kode_bagian='@kode_bagian_cari' and harga_r>0;
END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS update_tarif_ruangan_sp");
    }
};
