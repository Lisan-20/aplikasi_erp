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
        DB::unprepared("-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE OR ALTER PROCEDURE [dbo].[semi_jurnal_ALL_sp]
	-- Add the parameters for the stored procedure here
	
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
    exec update_kode_bagian_rj_sp;--update kode bagian kasir yg kosong
	exec semi_jurnal_partik_RJ_sp;
	
	
-- semi jurnal	rawat inap
	exec inp_tran_kasir_RI_sp;
	exec semi_jurnal_partik_RI_sp;
	
	
	-- obat bebas
	--exec semi_jurnal_obat_bebas_sp; --dp(29/peb/2016)
	exec semi_jurnal_jual_obat_bebas_sp;
	--update harga beli
	exec upd_billing_sp;
	update upd_harga_film_rad_v set harga_beli=harga_beli_rekap;
	update upd_harga_beli_film_rad set kode_barang=kode_brg;
	update upd_harga_beli_film_rad set harga_beli=harga_beli_pm;
	update upd_harga_beli_film_rad set vol=volume;
	
	--upd cogs hrg beli
	update upd_harga_beli_racikan_v set harga_beli=harga_beli_trans;
    update upd_harga_beli_tran_sed set harga_beli_tran = harga_beli*jumlah;
    update upd_harga_beli_bhp_v set harga_beli=harga;
    
    update upd_harga_beli_racikan_bebas_v set harga_beli=harga_beli_trans;
    update upd_harga_beli_tran_sed_bebas set harga_beli_tran = harga_beli*jumlah;
    update upd_harga_beli_bhp_bebas_v set harga_beli=harga;
	-- untuk fee dokter bpjs
	--update upd_persen_dr set persen_dr=persen;
	--exec inp_tc_fee_dokter_bpjs_sp 1;
END
--catatan
--untuk pembelian bebas,karyawan semi jurnalnya terpisah
--tapi jurnalnya jadi satu dgn jurnal rawat jalan");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS semi_jurnal_ALL_sp");
    }
};
