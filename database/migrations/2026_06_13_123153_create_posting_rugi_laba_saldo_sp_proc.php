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



create PROCEDURE [dbo].[posting_rugi_laba_saldo_sp]
AS
declare @tahun int
declare @bulan int
set @tahun = 0
set @bulan = 0
select @tahun =(select tahun from tbl_proses_posting where flag is null);
select @bulan=(select bulan from tbl_proses_posting where flag is null);

BEGIN
update  master_hist_bl set mutasi_d=0 where (acc_no IN ('2200000','2210000','2210100','2210101','2210200','2210201','2210300','2210301','2210400','2210401')) and tahun=@tahun and master_hist_bl.bulan=@bulan;
update  master_hist_bl set mutasi_d=0 where (acc_no IN ('2200000','2210000','2210100','2210101','2210200','2210201','2210300','2210301','2210400','2210401')) and tahun=@tahun and master_hist_bl.bulan=@bulan;
update  master_hist_bl set mutasi_k=0 where (acc_no IN ('2200000','2210000','2210100','2210101','2210200','2210201','2210300','2210301','2210400','2210401')) and tahun=@tahun and master_hist_bl.bulan=@bulan;
update  master_hist_bl set mutasi_k=0 where (acc_no IN ('2200000','2210000','2210100','2210101','2210200','2210201','2210300','2210301','2210400','2210401')) and tahun=@tahun and master_hist_bl.bulan=@bulan;
END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS posting_rugi_laba_saldo_sp");
    }
};
