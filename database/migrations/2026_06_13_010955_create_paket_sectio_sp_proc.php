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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[paket_sectio_sp]
@kode_paket as int,
@kode_trans_pelayanan as int,
@no_kunjungan as int,
@no_mr as varchar,
@no_registrasi as int,
@kode_kelompok as int,
@kode_perusahaan as int,
@tgl_transaksi as datetime,
@jenis_tindakan as int,
@nama_tindakan as varchar,
@nama_pasien_layan as varchar,
@jumlah as int,
@kode_profit as varchar,
@kode_barang as varchar,
@kode_bagian_asal as varchar,
@kode_klas as int,
@no_kamar as varchar,
@no_bed as varchar,
@kode_penunjang as varchar
as 


insert into tc_trans_pelayanan(
kode_trans_pelayanan,
no_kunjungan,
no_registrasi,
no_mr,
nama_pasien_layan,
kode_kelompok,
kode_perusahaan,
tgl_transaksi,
jenis_tindakan,
nama_tindakan,
bill_rs,
/*bill_dr1,
bill_dr2,
bill_dr3,
bill_rs_jatah,
bill_dr1_jatah,
bill_dr2_jatah,
lain_lain,
kode_dokter1,
kode_dokter2,
kode_dokter3,*/
jumlah,
kode_barang,
/*kode_master_tarif_detail,
kode_master_tarif_detail_jatah,
kd_tr_resep,
kode_trans_far,*/
kode_tarif,
kode_bagian,
kode_bagian_asal,
kode_klas,
no_kamar,
no_bed,
kode_penunjang,
kode_profit) select kode_trans_pelayanan=@kode_trans_pelayanan,
no_kunjungan=@no_kunjungan,
no_registrasi=@no_registrasi,
no_mr=@no_mr,
nama_pasien_layan=@nama_pasien_layan,
kode_kelompok=@kode_kelompok,
kode_perusahaan=@kode_perusahaan,
tgl_transaksi=@tgl_transaksi,
jenis_tindakan=@jenis_tindakan,
nama_tindakan=@nama_tindakan,
bill_rs,
/*bill_dr1,
bill_dr2,
bill_dr3,
bill_rs_jatah,
bill_dr1_jatah,
bill_dr2_jatah,
lain_lain,
kode_dokter1,
kode_dokter2,
kode_dokter3,*/
jumlah=@jumlah,
kode_barang=@kode_barang,
/*kode_master_tarif_detail,
kode_master_tarif_detail_jatah,
kd_tr_resep,
kode_trans_far,*/
kode_tarif,
kode_bagian,
kode_bagian_asal=@kode_bagian_asal,
kode_klas=@kode_klas,
no_kamar=@no_kamar,
no_bed=@no_bed,
kode_penunjang=@kode_penunjang,
kode_profit=@kode_profit
from v_tarif_paket_sectio Where kode_paket=@kode_paket;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS paket_sectio_sp");
    }
};
