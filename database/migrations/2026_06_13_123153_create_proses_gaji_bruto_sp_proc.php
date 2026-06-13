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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[proses_gaji_bruto_sp]


@id_periode_gaji as int

as

insert into tc_gaji_pokok(
							id_mt_periode_gaji,
							periode_gaji,
							tahun,
							bulan,
							npp,
							nama_pegawai,
							gaji_pokok,
							--gg,
							--tg,
							input_id,
							input_tgl,
							status,
							status_tgl) select 
												id_periode_gaji,
												periode_gaji,
												tahun,
												bulan,
												npp,
												nama_pegawai,
												gaji_pokok,
												--gg,
												--tg,
												input_id,
												input_tgl,
												status,
												status_tgl from v_persiapan_gaji_bulanan where id_periode_gaji=@id_periode_gaji;
												
insert into tc_tunjangan(
									npp,
									id_dd_ket_tunjangan,
									ket_tunjangan,
									periode,
									tahun,
									ket_jenis_tunj_kel,
									jumlah_tunj_kel,
									input_id,
									input_tgl,
									status,
									status_tgl,
									id_mt_periode_gaji,nama_pegawai) select npp,
																id_kd_transaksi_det,
																nama_transaksi,
																bulan,
																tahun,
																keterangan,
																tunjangan,
																input_id,
																input_tgl,
																status,
																status_tgl,
																id_periode_gaji,nama_pegawai FROM v_persiapan_tunjangan_bulanan Where id_periode_gaji=@id_periode_gaji;


insert into tc_potongan(npp,
									nama_pegawai,
									ket_potongan,
									jumlah_pot_kel,
									input_id,
									input_tgl,
									status,
									status_tgl,
									periode,
									tahun,
									id_dd_ket_potongan,
									id_mt_periode_gaji) 
														select npp,		
																nama_pegawai,
																nama_transaksi,
																potongan,				
																input_id,
																input_tgl,
																status,
																status_tgl,
																bulan,
																tahun,
																id_kd_transaksi_det,
																id_periode_gaji FROM v_persiapan_potongan_bulanan Where id_periode_gaji=@id_periode_gaji;

UPDATE mt_periode_gaji set status_periode_gaji=0 WHERE id_periode_gaji=@id_periode_gaji and status_periode_gaji is null;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS proses_gaji_bruto_sp");
    }
};
