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






CREATE OR ALTER PROCEDURE [dbo].[posting_account_sp]
as
declare @tahun int
declare @bulan int
set @tahun = 0
set @bulan = 0
select @tahun = (select tahun from tbl_proses_posting where flag is null);
select @bulan = (select bulan from tbl_proses_posting where flag is null)
insert into master_hist_bl(acc_no,tahun,bulan,mutasi_d,mutasi_k,saldo_awal,level,acc_type,saldo_akhir) select acc_no,@tahun as tahun,@bulan as bulan,0 as mutasi_d,0 as mutasi_k,0 as saldo_awal,level_coa  as level,acc_type,0 as saldo_akhir from posting_account_v order by acc_no;
--update master_hist_bl set tahun=@tahun where tahun=year(getdate());
--update master_hist_bl set bulan=@bulan where bulan=month(getdate())

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS posting_account_sp");
    }
};
