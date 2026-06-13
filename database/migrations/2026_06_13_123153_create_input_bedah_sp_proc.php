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
        DB::unprepared("CREATE proc [dbo].[input_bedah_sp]

@kode_klas int,
@no_kunjungan int,
@kode_tarif int,
@no_registrasi int,
@no_mr char(6),
@kode_kelompok as int,
@kode_perusahaan as int,
@tgl_transaksi as datetime,
@cito as int
--@dr_bedah as int

as

DECLARE @MaxKd INT
DECLARE @Data INT

SET @MaxKd = (select max(kode_trans_pelayanan) from tc_trans_pelayanan)--dbo.KodeTransfar(@kode_trans_far)--
SET @Data = (select count(kode_tarif) from tarif_bedah_baru_2016_v where kode_tarif=@kode_tarif and kode_klas=@kode_klas)

WHILE (@Data>0)
BEGIN
IF (@kode_kelompok=1)
	BEGIN
		PRINT @Data
		PRINT @MaxKd
		SET @MaxKd = @MaxKd+1
		
		INSERT INTO tc_trans_pelayanan
					(kode_trans_pelayanan,
					no_registrasi,
					no_mr,
					kode_kelompok,
					kode_perusahaan,
					tgl_transaksi,
					jenis_tindakan,
					nama_tindakan,
					bill_rs,
					bill_dr1,
					bill_rs_jatah,
					diskon_rs_jatah,
					kode_tarif,
					kode_klas,
					jumlah,
					no_urut,
					kode_bagian,
					kode_bagian_asal,
					no_kunjungan,
					cito,
					status_selesai
					) 
		SELECT	@MaxKd + row_number() over(order by @MaxKd),
					@no_registrasi,
					@no_mr,
					@kode_kelompok as kode_kelompok,
					@kode_perusahaan as kode_perusahaan,
					@tgl_transaksi as tgl_transaksi,
					'4' as jenis_tindakan,
					CAST(nama_tarif+'-'+detail as varchar (100)) as nama_tindakan,
					bill_rs,
					bill_dr1,
					'0' as bill_rs_jatah,
					'0' as diskon_rs_jatah,
					kode_tarif,
					kode_klas,
					'1' as jumlah,
					no_urut,
					kode_bagian,
					kode_bagian as kode_bagian_asal,
					@no_kunjungan as no_kunjungan,
					@cito as cito,
					'1' as status_selesai
					
		FROM tarif_bedah_baru_2016_v Where kode_tarif=@kode_tarif and kode_klas=@kode_klas
		
	END
	
	IF (@kode_kelompok=3 OR @kode_kelompok=5)
	BEGIN
		PRINT @Data
		PRINT @MaxKd
		SET @MaxKd = @MaxKd+1
		
		INSERT INTO tc_trans_pelayanan
					(kode_trans_pelayanan,
					no_registrasi,
					no_mr,
					kode_kelompok,
					kode_perusahaan,
					tgl_transaksi,
					jenis_tindakan,
					nama_tindakan,
					bill_rs,
					bill_dr1,
					bill_rs_jatah,
					diskon_rs_jatah,
					kode_tarif,
					kode_klas,
					jumlah,
					no_urut,
					kode_bagian,
					kode_bagian_asal,
					no_kunjungan,
					cito,
					status_selesai
					) 
		SELECT	@MaxKd + row_number() over(order by @MaxKd),
					@no_registrasi,
					@no_mr,
					@kode_kelompok as kode_kelompok,
					@kode_perusahaan as kode_perusahaan,
					@tgl_transaksi as tgl_transaksi,
					'4' as jenis_tindakan,
					CAST(nama_tarif+'-'+detail as varchar (100)) as nama_tindakan,
					bill_rs,
					bill_dr1,
					'0' as bill_rs_jatah,
					'0' as diskon_rs_jatah,
					kode_tarif,
					kode_klas,
					'1' as jumlah,
					no_urut,
					kode_bagian,
					kode_bagian as kode_bagian_asal,
					@no_kunjungan as no_kunjungan,
					@cito as cito,
					'1' as status_selesai
					
		FROM tarif_bedah_baru_2016_v Where kode_tarif=@kode_tarif and kode_klas=@kode_klas
		
	END
	IF (@kode_kelompok=8 OR @kode_kelompok=9 OR @kode_kelompok=10 OR @kode_kelompok=11 OR @kode_kelompok=12 OR @kode_kelompok=13)
	BEGIN
		PRINT @Data
		PRINT @MaxKd
		SET @MaxKd = @MaxKd+1
		
		INSERT INTO tc_trans_pelayanan
					(kode_trans_pelayanan,
					no_registrasi,
					no_mr,
					kode_kelompok,
					kode_perusahaan,
					tgl_transaksi,
					jenis_tindakan,
					nama_tindakan,
					bill_rs,
					bill_dr1,
					bill_rs_jatah,
					diskon_rs_jatah,
					kode_tarif,
					kode_klas,
					jumlah,
					no_urut,
					kode_bagian,
					kode_bagian_asal,
					no_kunjungan,
					cito,
					status_selesai
					) 
		SELECT	@MaxKd + row_number() over(order by @MaxKd),
					@no_registrasi,
					@no_mr,
					@kode_kelompok as kode_kelompok,
					@kode_perusahaan as kode_perusahaan,
					@tgl_transaksi as tgl_transaksi,
					'4' as jenis_tindakan,
					CAST(nama_tarif+'-'+detail as varchar (100)) as nama_tindakan,
					bill_rs_bpjs,
					bill_dr1_bpjs,
					'0' as bill_rs_jatah,
					'0' as diskon_rs_jatah,
					kode_tarif,
					kode_klas,
					'1' as jumlah,
					no_urut,
					kode_bagian,
					kode_bagian as kode_bagian_asal,
					@no_kunjungan as no_kunjungan,
					@cito as cito,
					'1' as status_selesai
					
		FROM tarif_bedah_baru_2016_v Where kode_tarif=@kode_tarif and kode_klas=@kode_klas
		
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
        DB::unprepared("DROP PROCEDURE IF EXISTS input_bedah_sp");
    }
};
