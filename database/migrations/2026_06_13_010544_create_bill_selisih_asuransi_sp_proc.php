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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[bill_selisih_asuransi_sp]
@no_registrasi as int

as
set nocount on
update tc_trans_pelayanan set bill_rs_p=0,bill_dr_p=0,bill_rs_selisih=0,bill_dr1_selisih=0 where no_registrasi=@no_registrasi;

update bill_selisih_ruangan_v set bill_rs_p=harga_jatah ,bill_rs_selisih = bill_rs_jatah-harga_jatah where no_registrasi=@no_registrasi;

update bill_selisih_v 
set bill_rs_p=bill_rs_mt ,bill_dr_p=bill_dr1_mt ,bill_rs_selisih = bill_rs_jatah-bill_rs_mt ,bill_dr1_selisih = bill_dr1_jatah-bill_dr1_mt
where no_registrasi=@no_registrasi;

update bill_selisih_ok_vk_v
set bill_rs_p=0.3*total,bill_dr_p=0.7*total ,bill_rs_selisih = bill_rs-(0.3*total),bill_dr1_selisih = bill_dr1-(0.7*total)
where no_registrasi=@no_registrasi and no_urut in (1,2,3,11);

update bill_selisih_ok_vk_v
set bill_rs_p=total,bill_dr_p=0 ,bill_rs_selisih = bill_rs-(total),bill_dr1_selisih = 0
where no_registrasi=@no_registrasi and no_urut not in (1,2,3,11);");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS bill_selisih_asuransi_sp");
    }
};
