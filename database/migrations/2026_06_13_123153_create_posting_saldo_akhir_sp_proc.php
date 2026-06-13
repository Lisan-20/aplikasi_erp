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








CREATE proc [dbo].[posting_saldo_akhir_sp]
as
declare @tahun int
declare @bulan int
set @tahun = 0
set @bulan = 0
select @tahun =(select tahun from tbl_proses_posting where flag is null);
select @bulan =(select bulan from tbl_proses_posting where flag is null);
update master_hist_bl set saldo_akhir = saldo_awal_d.saldo from saldo_awal_d inner join master_hist_bl on saldo_awal_d.acc_no=master_hist_bl.acc_no and saldo_awal_d.ko_wil=master_hist_bl.ko_wil where master_hist_bl.tahun=@tahun and master_hist_bl.bulan=@bulan;
update master_hist_bl set saldo_akhir = saldo_awal_k.saldo from saldo_awal_k inner join master_hist_bl on saldo_awal_k.acc_no=master_hist_bl.acc_no and saldo_awal_k.ko_wil=master_hist_bl.ko_wil where master_hist_bl.tahun=@tahun and master_hist_bl.bulan=@bulan



");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS posting_saldo_akhir_sp");
    }
};
