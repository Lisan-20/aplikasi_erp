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
        DB::unprepared("CREATE PROCEDURE [dbo].[ver_sit_umum_sp]
@kode_dokter as int,
@kode_bagian as int,
@biaya_dr1 as int,
@id_jadwal as int

as
-- dokter IGD
if (@kode_bagian='020101')
BEGIN
insert into fee_dr_sitting_temp(kode_dr,kode_bagian,tgl_praktek,nama_tindakan,jumlah,id_jadwal,kode_jadwal)
select kode_dokter,'020101' as kode_bagian,tgl_praktek,'Sitting Fee' as nama_tindakan,@biaya_dr1 as jumlah,id_jadwal,kode_jadwal
from tc_jadwal_dokter where @kode_dokter=@kode_dokter and id_jadwal=@id_jadwal;
update tc_jadwal_dokter set flag_ver=1 where kode_dokter=@kode_dokter and id_jadwal=@id_jadwal;
END

-- dokter poli umum
if (@kode_bagian='012201')
BEGIN
insert into fee_dr_sitting_temp(kode_dr,kode_bagian,tgl_praktek,nama_tindakan,jumlah,id_jadwal,kode_jadwal)
select kode_dokter,'012201' as kode_bagian,tgl_praktek,'Sitting Fee' as nama_tindakan,@biaya_dr1 as jumlah,id_jadwal,kode_jadwal
from tc_jadwal_dokter where @kode_dokter=@kode_dokter and id_jadwal=@id_jadwal;
update tc_jadwal_dokter set flag_ver=1 where kode_dokter=@kode_dokter and id_jadwal=@id_jadwal;
END

-- dokter bangsal
if (@kode_bagian='030001')
BEGIN
insert into fee_dr_sitting_temp(kode_dr,kode_bagian,tgl_praktek,nama_tindakan,jumlah,id_jadwal,kode_jadwal)
select kode_dokter,'030001' as kode_bagian,tgl_praktek,'Sitting Fee' as nama_tindakan,@biaya_dr1 as jumlah,id_jadwal,kode_jadwal
from tc_jadwal_dokter where @kode_dokter=@kode_dokter and id_jadwal=@id_jadwal;
update tc_jadwal_dokter set flag_ver=1 where kode_dokter=@kode_dokter and id_jadwal=@id_jadwal;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ver_sit_umum_sp");
    }
};
