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



CREATE PROCEDURE [dbo].[posting_saldo_awal_sp]
as
declare @bln int
declare @thn int

set @bln=0
set @thn=0
set @bln=(select bulan from tbl_proses_posting where flag is null)
set @thn=(select tahun from tbl_proses_posting where flag is null)
UPDATE master_hist_bl SET saldo_awal=saldo_awal.saldo_akhir from saldo_awal inner join master_hist_bl on master_hist_bl.acc_no=saldo_awal.acc_no and master_hist_bl.ko_wil=saldo_awal.ko_wil where saldo_awal.bulan=@bln-1 and master_hist_bl.bulan=@bln and master_hist_bl.tahun=@thn and saldo_awal.tahun=@thn;


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS posting_saldo_awal_sp");
    }
};
