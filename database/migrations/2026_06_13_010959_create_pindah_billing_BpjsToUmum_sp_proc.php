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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[pindah_billing_BpjsToUmum_sp]
@no_registrasi as int,
@kode_kelompok_awal as int,
@kode_kelompok_skrg as int
AS
--untuk pindah billing dari asuransi ke umum
-- untuk billing selain ruangan & obat
--untuk tarif nonrujukan
UPDATE v_pindah_billing_umum_persh
SET bill_rs_trans=bill_rs*jumlah, bill_dr1_trans=bill_dr1*jumlah, bill_dr2_trans=bill_dr2*jumlah
WHERE no_registrasi=@no_registrasi;

--untuk tarif rujukan ga diupdate;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS pindah_billing_BpjsToUmum_sp");
    }
};
