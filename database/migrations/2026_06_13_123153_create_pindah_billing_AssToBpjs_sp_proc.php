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
        DB::unprepared("CREATE proc [dbo].[pindah_billing_AssToBpjs_sp]
@no_registrasi as int,
@kode_kelompok_awal as int,
@kode_kelompok_skrg as int
AS

-- untuk billing selain ruangan & obat
--untuk tarif non rujukan
UPDATE v_pindah_billing_bpjs
SET bill_rs_trans=bill_rs*jumlah, bill_dr1_trans=bill_dr1*jumlah, bill_dr2_trans=bill_dr2*jumlah
WHERE no_registrasi=@no_registrasi;

--untuk tarif rujukan
UPDATE v_pindah_billing_bpjs_rujukan
SET bill_rs_trans=bill_rs_jatah, bill_dr1_trans=bill_dr1_jatah, bill_dr2_trans=bill_dr2_jatah
WHERE no_registrasi=@no_registrasi;


--untuk obat alkes
update tc_trans_pelayanan set bill_rs=bill_rs_jatah where jenis_tindakan in (7,9,11) and no_registrasi=@no_registrasi and (kode_tc_trans_kasir is null or kode_tc_trans_kasir=0)and bill_rs=0 and bill_rs<>bill_rs_jatah;

--untuk tindakan vk spt partus blm ada fungsi update-annya.
-- untuk tindakan bedah blm ada fungsi update-annya.");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS pindah_billing_AssToBpjs_sp");
    }
};
