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

CREATE PROCEDURE [dbo].[inp_tarif_ruangan_perusahaan_sp]
AS
BEGIN

insert into mt_master_tarif_ruangan_perusahaan (kd_tarif_r_persh,
kode_bagian,
kode_klas,
harga_r,
jumlah_k,
jumlah_tt,
harga_r_l,
keterangan,
kode_tgl_tarif,kode_perusahaan
) select kd_tarif_r as kd_tarif_r_persh,
kode_bagian,
kode_klas,
harga_r,
jumlah_k,
jumlah_tt,
harga_r_l,
keterangan,
kode_tgl_tarif,kode_perusahaan
 from mt_tarif_ruangan_persh_v where kd_tarif_r not in (select kd_tarif_r_persh as  kd_tarif_r from mt_master_tarif_ruangan_perusahaan );
 end");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_tarif_ruangan_perusahaan_sp");
    }
};
