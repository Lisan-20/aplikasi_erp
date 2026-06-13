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
CREATE OR ALTER PROCEDURE [dbo].[sie_kinerja_unit_thn_sp]


@tahun1 as int


as

--INSERT INTO ct_sickness_thn (bln, thn, ko_wil)
--SELECT bln, thn, ko_wil
--FROM ct_sickness_thn_v where (thn = @tahun1);

update sie_kinerja_rs_unit set thn=@tahun1;
update sie_kinerja_rs_unit set tot_umum=0,jml_umum=0,jml_perusahaan=0,tot_perusahaan=0,jml_bpjs=0,tot_bpjs=0;
update sie_kinerja_rs_unit set tot_umum_LL=0,jml_umum_LL=0,jml_perusahaan_LL=0,tot_perusahaan_LL=0,jml_bpjs_LL=0,tot_bpjs_LL=0;

update sie_kinerja_rs_unit2_umum_v set tot_umum=jumlah,jml_umum=jml_pasien;
update sie_kinerja_rs_unit2_persh_v set tot_perusahaan=jumlah,jml_perusahaan=jml_pasien;
update sie_kinerja_rs_unit2_bpjs_v set tot_bpjs=jumlah,jml_bpjs=jml_pasien;

-- lalu
update sie_kinerja_rs_unit3_umum_v set tot_umum_LL=jumlah,jml_umum_LL=jml_pasien;
update sie_kinerja_rs_unit3_persh_v set tot_perusahaan_LL=jumlah,jml_perusahaan_LL=jml_pasien;
update sie_kinerja_rs_unit3_bpjs_v set tot_bpjs_LL=jumlah,jml_bpjs_LL=jml_pasien;

--update ct_sickness_thn set Achievement_1th='1.37';
--update ct_sickness_thn set Achievement_2th='1.34';

--update ct_sickness_jml_upd_thn_v set jml_pmt=jml_visit where id_status=1;
--update ct_sickness_jml_upd_thn_v set jml_kwt=jml_visit where id_status=2;
--update ct_sickness_thn set total=jml_kwt+jml_pmt;


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sie_kinerja_unit_thn_sp");
    }
};
