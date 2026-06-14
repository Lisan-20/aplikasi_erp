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







CREATE OR ALTER PROCEDURE [dbo].[posting_sp]
as
set nocount on
--delete from master_hist_bl where tahun=year(getdate()) and bulan=month(getdate());
exec posting_account_sp ;-- untuk posting pertama x dan ada saldo awal jangan diaktifkan 
exec posting_saldo_awal_sp ;-- untuk posting pertama x jangan diaktifkan
--update saldo_awal_update_tahun_baru set saldo_awal=saldo_akhir --- BUAT ISI SALDO AWAL TAHUN
exec posting_mutasi_sp; -- untuk posting mutasi_d & mutasi_k
exec posting_saldo_akhir_sp ;-- untuk posting saldo_akhir
exec posting_rugi_laba_saldo_sp;
update tbl_proses_posting set tgl_posting=getdate() where flag is null ;
update tbl_proses_posting set flag=1 where flag is null;
--insert into tbl_proses_posting (bulan) select bulan+1 from tbl_proses_posting where tgl_posting =getdate();
--update tbl_proses_posting set tahun = year(getdate()) where flag is null;




");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS posting_sp");
    }
};
