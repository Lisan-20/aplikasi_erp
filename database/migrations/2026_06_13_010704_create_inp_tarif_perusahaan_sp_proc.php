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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[inp_tarif_perusahaan_sp]
AS
BEGIN


insert into mt_master_tarif_detail_perusahaan(kode_master_tarif_detail,kode_perusahaan,kode_klas,
bill_rs,
bill_dr1,
bill_dr2,
kode_tgl_tarif,
kode_tarif,
total,
obat,
alkes,
alat_rs,
marketing,
bhp,
pendapatan_rs,
reagen,
paramedis,
flag_spec
)select kode_master_tarif_detail,kode_perusahaan,kode_klas,
bill_rs,
bill_dr1,
bill_dr2,
kode_tgl_tarif,
kode_tarif,
total,
obat,
alkes,
alat_rs,
marketing,
bhp,
pendapatan_rs,
reagen,
paramedis,
flag_spec  from tarif_perusahaan_v where  kode_tarif not in (select kode_tarif from mt_master_tarif_detail_perusahaan);
end");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_tarif_perusahaan_sp");
    }
};
