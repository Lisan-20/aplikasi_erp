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
        DB::unprepared("CREATE proc [dbo].[proses_penyusutan_asset_sp]
--@tahun as int,
--@bulan as int,
@no_induk as int


as
-- input ke tabel 

insert into tc_penyusutan_asset(bln,
thn,
kode_barang,
kode_bagian,
asset_type,
nominal_penyusutan,
no_induk,
acc_d,
acc_k,
qty
)
select bulan as bln,tahun as thn,kode_brg as kode_barang,kode_bagian,asset_type,nilai_penyusutan as nominal_penyusutan,@no_induk as no_induk,acc_d,acc_k,qty
from proses_penyusutan_asset_v3 where  acc_d is not NULL ; ---and estimasi_penggunaan<=thn_penyusutan bulan=@bulan and tahun=@tahun and

update proses_penyusutan_asset_v3 set status_asset=1 where acc_d is not NULL ;--bulan=@bulan and tahun=@tahun and

update tbl_proses_penyusutan set tgl_proses=getdate() where flag is null ;
update tbl_proses_penyusutan set flag=1 where flag is null;
insert into tbl_proses_penyusutan (bulan, tahun) select bulan+1,tahun from tbl_proses_penyusutan where tgl_proses =getdate();
--update tbl_proses_posting set tahun = year(getdate()) where flag is null;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS proses_penyusutan_asset_sp");
    }
};
