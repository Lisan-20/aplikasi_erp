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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[kirim_apotik_ok_sp]

--@kd_tr_resep int,
@kode_trans_far int,
@kode_kelompok int,
@kode_perusahaan int

as
--DECLARE @kd_tr_resep INT
DECLARE @MaxKd INT
DECLARE @Data INT

--SET @MaxKd = 1
--SET @kode_trans_far = 0
SET @MaxKd = (select max(kode_trans_pelayanan) from tc_trans_pelayanan)--dbo.KodeTransfar(@kode_trans_far)--
SET @Data = (select count(kode_trans_far) from fr_tc_far_detail where kode_trans_far=@kode_trans_far)
--SET @kd_tr_resep = (select kd_tr_resep from fr_tc_far_detail where kode_trans_far=@kode_trans_far)

WHILE (@Data>0)
BEGIN
	BEGIN
		PRINT @Data
		PRINT @MaxKd
		SET @MaxKd = @MaxKd+1
		--SET @kd_tr_resep = (select kd_tr_resep from fr_tc_far_detail where kode_trans_far=@kode_trans_far)
		INSERT INTO tc_trans_pelayanan
					(kode_trans_pelayanan,
					no_registrasi,
					no_mr,
					nama_pasien_layan,
					kode_kelompok,
					kode_perusahaan,
					tgl_transaksi,
					jenis_tindakan,
					nama_tindakan,
					bill_rs,
					diskon_rs,
					bill_rs_jatah,
					diskon_rs_jatah,
					lain_lain,
					kode_dokter1,
					kode_klas,
					--kode_poli,
					jumlah,
					kode_barang,
					kode_trans_far,
					kode_bagian,
					kode_bagian_asal,
					kode_profit,
					kd_tr_resep,
					no_kunjungan,
					status_selesai,
					obat_cover_persh,
					harga_beli,
					profit_2_persen,
					no_reg_resep
					) 
		SELECT	@MaxKd + row_number() over(order by @MaxKd),
					no_registrasi,
					no_mr,
					nama_pasien as nama_pasien_layan,
					@kode_kelompok as kode_kelompok,
					@kode_perusahaan as kode_perusahaan,
					tgl_trans as tgl_transaksi,
					'11' as jenis_tindakan,
					nama_brg as nama_tindakan,
					biaya_tebus as bill_rs,
					diskon as diskon_rs,
					'0' as bill_rs_jatah,
					'0' as diskon_rs_jatah,
					harga_r as lain_lain,
					kode_dokter as kode_dokter1,
					kode_klas,
					--'0' as kode_poli,
					jumlah_tebus as jumlah,
					kode_brg as kode_barang,
					kode_trans_far,
					kode_bagian,
					kode_bagian_asal,
					kode_profit,
					kd_tr_resep,
					no_kunjungan,
					'2' as status_selesai,
					obat_cover_persh,
					harga_beli,
					profit_2_persen,
					no_reg_resep
		FROM kirim_far_ke_transpel_v Where kode_trans_far=@kode_trans_far
		
	END
IF(@Data = @Data)
	BREAK;

END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS kirim_apotik_ok_sp");
    }
};
