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
        DB::unprepared("CREATE proc [dbo].[ngidupin_pasien_rajal_sp]
@no_kunjungan as int,
@kode_kelompok as int
as
if (@kode_kelompok=1)
begin
update pl_tc_poli set status_periksa=0 where no_kunjungan in (select no_kunjungan from ngidupin_billing_poli_v) and no_kunjungan=@no_kunjungan;
end
if (@kode_kelompok>1)
begin
update pl_tc_poli set status_periksa=0 where no_kunjungan in (select no_kunjungan from ngidupin_billing_poli_v where (kode_tc_trans_kasir is null or kode_tc_trans_kasir= 0)) and no_kunjungan=@no_kunjungan;
end
update tc_kunjungan set tgl_keluar=null,status_keluar=0 where no_kunjungan in (select no_kunjungan from ngidupin_billing_poli_v) and no_kunjungan=@no_kunjungan;
update tc_trans_pelayanan set status_selesai=1 where no_kunjungan in (select no_kunjungan from ngidupin_billing_poli_v) and kode_bagian like '01%' and no_kunjungan=@no_kunjungan;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ngidupin_pasien_rajal_sp");
    }
};
