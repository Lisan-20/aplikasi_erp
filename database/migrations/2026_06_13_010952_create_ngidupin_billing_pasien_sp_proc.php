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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[ngidupin_billing_pasien_sp]
@no_registrasi as int
as
/*
update ngidupin_billing_pasien_v set status_pulang=0,tgl_keluar=null where no_mr=@no_mr;
update ngidupin_billing_pasien_v set status_selesai=1 where (kode_bagian  not like '05%' or kode_bagian not like '06%') and  no_mr=@no_mr;
update ngidupin_billing_pasien_v set bill_rs=harga_r,jumlah=0 where jenis_tindakan=1 and kode_bagian not in('030501','030901') and  no_mr=@no_mr and tgl_pindah is null;
delete tc_trans_pelayanan where jenis_tindakan=2 and kode_bagian like '03%' and no_mr=@no_mr;
*/
update ngidupin_billing_pasien_v set status_pulang=0,tgl_keluar=null where no_registrasi=@no_registrasi;
update tc_trans_pelayanan set status_selesai=1 where (kode_bagian  not like '05%' or kode_bagian not like '06%') and  no_registrasi=@no_registrasi AND (kode_tc_trans_kasir is null or kode_tc_trans_kasir =0);
update ngidupin_billing_pasien_v set bill_rs=harga_r,bill_rs_jatah=harga_r,jumlah=0 where jenis_tindakan=1 and kode_bagian not in('030501','030901') and  no_registrasi=@no_registrasi and tgl_pindah is null;
delete tc_trans_pelayanan where jenis_tindakan=2 and kode_bagian like '03%' and no_registrasi=@no_registrasi;
--pasien bpjs murni
delete tc_trans_jkn where no_registrasi=@no_registrasi;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ngidupin_billing_pasien_sp");
    }
};
