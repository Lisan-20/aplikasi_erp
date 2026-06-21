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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[pindah_billing_persh_sp]
@no_registrasi as int,
@kode_kelompok_awal as int,
@kode_kelompok_skrg as int
AS

-- untuk billing selain ruangan & obat
UPDATE v_pindah_billing_umum_persh
SET bill_rs_trans=bill_rs, bill_dr1_trans=bill_dr1, bill_dr2_trans=bill_dr2
WHERE no_registrasi=@no_registrasi;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS pindah_billing_persh_sp");
    }
};
