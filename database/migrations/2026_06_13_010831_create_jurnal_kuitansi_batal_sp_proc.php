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
CREATE OR ALTER PROCEDURE [dbo].[jurnal_kuitansi_batal_sp]
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	--SET NOCOUNT ON;

    -- Insert statements for procedure here
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,kode_dr,kode_barang,referensi) select acc_no,tx_nominal,tx_uraian,tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'9' as no_jurnal,'1' as no_det_jurnal,no_bukti,kode_bagian,no_induk,'9' as kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,kode_dr,kode_barang,referensi from jurnal_kuitansi_batal_v where tx_tipe='K' and flag_b is null;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,kode_dr,kode_barang,referensi) select acc_no,tx_nominal,tx_uraian,tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'9' as no_jurnal,'2' as no_det_jurnal,no_bukti,kode_bagian,no_induk,'9' as kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,kode_dr,kode_barang,referensi from jurnal_kuitansi_batal_v where tx_tipe='D' and flag_b is null;
	update jurnal_kuitansi_batal_v set flag_b=1 where flag_b is null;
end");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_kuitansi_batal_sp");
    }
};
