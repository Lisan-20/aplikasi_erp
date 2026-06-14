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
        DB::unprepared("CREATE OR ALTER PROCEDURE inp_tarif_sktm_sp
as

insert into mt_master_tarif_detail_sktm(kode_master_tarif_detail,
kode_klas,
bill_rs,
bill_dr1,
bill_dr2,
kode_tgl_tarif,
kode_tarif,
total,
obat,
alkes,
adm,
bhp,
keterangan,
bill_dr3,
kamar_tindakan,
paramedis,
bill_rs_spesialis,
bill_dr1_spesialis,
bill_dr2_spesialis,
pendapatan_rs,
pendapatan_rs_spesialis,
total_spesialis,
bill_rs_rujukan,
sewa_alat
) select
kode_master_tarif_detail,
kode_klas,
bill_rs,
bill_dr1,
bill_dr2,
kode_tgl_tarif,
kode_tarif,
total,
obat,
alkes,
adm,
bhp,
keterangan,
bill_dr3,
kamar_tindakan,
paramedis,
bill_rs_spesialis,
bill_dr1_spesialis,
bill_dr2_spesialis,
pendapatan_rs,
pendapatan_rs_spesialis,
total_spesialis,
bill_rs_rujukan,
sewa_alat
from mt_master_tarif_detail where kode_master_tarif_detail not in (select kode_master_tarif_detail from mt_master_tarif_detail_sktm);
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_tarif_sktm_sp");
    }
};
