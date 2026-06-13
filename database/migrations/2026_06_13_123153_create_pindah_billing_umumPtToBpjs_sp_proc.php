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
        DB::unprepared("CREATE proc [dbo].[pindah_billing_umumPtToBpjs_sp]
@no_registrasi as int,
@kode_kelompok_awal as int,
@kode_kelompok_skrg as int
AS

--untuk billing selain ruangan & obat
--untuk tarif nonrujukan
UPDATE v_pindah_billing_bpjs
SET bill_rs_trans=bill_rs_bpjs*jumlah, bill_dr1_trans=bill_dr1_bpjs*jumlah, bill_dr2_trans=bill_dr2_bpjs*jumlah
WHERE no_registrasi=@no_registrasi;

--untuk tarif rujukan
if (@kode_kelompok_awal=1)
	UPDATE v_pindah_billing_bpjs_rujukan
	SET bill_rs_trans=bill_rs, bill_dr1_trans=bill_dr1, bill_dr2_trans=bill_dr2
	WHERE no_registrasi=@no_registrasi;


--untuk billing ruangan
UPDATE v_pindah_billing_ruangan
SET bill_rs_jatah=harga_r
WHERE no_registrasi=@no_registrasi;

UPDATE v_pindah_billing_ruangan_fix
SET bill_rs_jatah=harga_r * jumlah
WHERE no_registrasi=@no_registrasi;

--untuk obat ruangan ga perlu diupdate

--untuk tindakan vk spt partus blm ada fungsi update-annya.
-- untuk tindakan bedah blm ada fungsi update-annya.");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS pindah_billing_umumPtToBpjs_sp");
    }
};
