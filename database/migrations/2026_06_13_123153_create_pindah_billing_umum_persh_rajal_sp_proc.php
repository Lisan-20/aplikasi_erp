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
        DB::unprepared("CREATE proc [dbo].[pindah_billing_umum_persh_rajal_sp]
@no_registrasi as int,
@kode_kelompok_awal as int,
@kode_kelompok_skrg as int
AS

-- untuk billing selain ruangan & obat
UPDATE v_pindah_billing_umum_persh_rajal
SET bill_rs_trans=bill_rs*jumlah, bill_dr1_trans=bill_dr1*jumlah, bill_dr2_trans=bill_dr2*jumlah
WHERE no_registrasi=@no_registrasi;


--untuk billing obat ruangan & resep dri apotik
UPDATE v_pindah_billing_obat
SET bill_rs=bill_rs_jatah
WHERE no_registrasi=@no_registrasi;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS pindah_billing_umum_persh_rajal_sp");
    }
};
