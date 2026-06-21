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
        DB::unprepared("CREATE OR ALTER PROCEDURE ver_rj_auto_sp

as

UPDATE tc_trans_kasir SET tgl_ver=GETDATE(),flag_jurnal=0,user_ver=0 where kode_tc_trans_kasir in(select kode_tc_trans_kasir from proses_ver_rj_v);
UPDATE tc_trans_pelayanan SET tgl_ver=GETDATE(),flag_jurnal=0 where kode_tc_trans_kasir in(select kode_tc_trans_kasir from proses_ver_rj_v);
--UPDATE pl_tc_poli SET status_periksa=2,no_induk=0 where status_selesai<>2 and no_kunjungan in(select no_kunjungan from proses_ver_rj_v);
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ver_rj_auto_sp");
    }
};
