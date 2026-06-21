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

CREATE OR ALTER PROCEDURE [dbo].[pm_tc_hasilpenunjang_temp_sp]
@no_registrasi as varchar(10)


as

truncate table pm_tc_hasilpenunjang_temp;

insert into pm_tc_hasilpenunjang_temp(kode_trans_pelayanan, hasil, keterangan,  no_registrasi, no_mr,nama_tindakan,tgl_transaksi,kode_penunjang, standar_hasil_wanita, standar_hasil_pria, nama_pemeriksaan

)
select kode_trans_pelayanan, hasil, keterangan, no_registrasi, no_mr,nama_tindakan,tgl_transaksi,kode_penunjang, standar_hasil_wanita, standar_hasil_pria, nama_pemeriksaan


from pm_tc_hasilpenunjang_new2_v where no_registrasi=@no_registrasi;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS pm_tc_hasilpenunjang_temp_sp");
    }
};
