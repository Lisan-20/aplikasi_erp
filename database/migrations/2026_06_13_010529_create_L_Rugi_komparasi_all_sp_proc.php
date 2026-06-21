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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[L_Rugi_komparasi_all_sp]

@bln as int,
@thn as int

as

truncate table L_Rugi_all_temp;
truncate table L_Rugi_all_fix_temp;
truncate table L_Rugi_bag_fix_temp;

insert into L_Rugi_all_temp(acc_no, debet, kredit, bulan, tahun, tx_tipe, referensi)
select acc_no, debet, kredit, bulan, tahun, tx_tipe, referensi
from L_Rugi_all_union_v where bulan=@bln and tahun in (@thn-1,@thn);

--DECLARE @bln AS INT = 1;
--WHILE @bln < 13
--BEGIN

insert into L_Rugi_all_fix_temp(acc_no, acc_nama, bulan, tahun)
select acc_no, acc_nama, @bln, @thn
from mt_account;

insert into L_Rugi_bag_fix_temp(acc_no, acc_nama, bulan, tahun, kode_bagian)
select acc_no, acc_nama, @bln, @thn, kode_bagian
from upd_L_Rugi_bag_fix_v group by acc_no, acc_nama, kode_bagian;
--rupiah beban
update upd_L_Rugi_all_fix_temp_ok_v set rupiah=rupiah_upd  where tahun=@thn;
update upd_L_Rugi_all_fix_temp_ok_v set rupiah_ll=rupiah_upd  where tahun=@thn-1;
update upd_L_Rugi_all_fix_temp_ok_v set rupiah_sel=isnull(rupiah,0)-isnull(rupiah_ll,0);
--rupiah pendapatan
update upd_L_Rugi_bag_ok_fix_v set rupiah=rupiah_upd  where bulan=@bln and tahun=@thn;
update upd_L_Rugi_bag_ok_fix_v set rupiah_ll=rupiah_upd  where bulan=@bln and tahun=@thn-1;
update upd_L_Rugi_bag_ok_fix_v set rupiah_sel=isnull(rupiah,0)-isnull(rupiah_ll,0);
--vol pendapatan
update upd_L_Rugi_all_vol_ok_v set vol=vol_up  where bulan=@bln and tahun=@thn;
update upd_L_Rugi_all_vol_ok_v set vol_ll=vol_up  where bulan=@bln and tahun=@thn-1;
update upd_L_Rugi_all_vol_ok_v set vol_sel=isnull(vol,0)-isnull(vol_ll,0);
--ratio pendapatan
update upd_L_Rugi_sel_pend2_v set ratio=ratio_up  where bulan=@bln and tahun=@thn;
update upd_L_Rugi_sel_pend2_v set ratio_ll=ratio_ll_up  where bulan=@bln and tahun=@thn;
update upd_L_Rugi_sel_pend2_v set ratio_sel=isnull(ratio,0)-isnull(ratio_ll,0);
--ratio beban unit
update upd_L_Rugi_sel_biaya2_v set ratio=ratio_up  where bulan=@bln and tahun=@thn;
update upd_L_Rugi_sel_biaya2_v set ratio_ll=ratio_ll_up  where bulan=@bln and tahun=@thn;
update upd_L_Rugi_sel_biaya2_v set ratio_sel=isnull(ratio,0)-isnull(ratio_ll,0);
--ratio beban umum & adm
update upd_L_Rugi_sel_biaya3_v set ratio=ratio_up  where bulan=@bln and tahun=@thn;
update upd_L_Rugi_sel_biaya3_v set ratio_ll=ratio_ll_up  where bulan=@bln and tahun=@thn;
update upd_L_Rugi_sel_biaya3_v set ratio_sel=isnull(ratio,0)-isnull(ratio_ll,0);


--SET @bln = @bln + 1;
--END;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS L_Rugi_komparasi_all_sp");
    }
};
