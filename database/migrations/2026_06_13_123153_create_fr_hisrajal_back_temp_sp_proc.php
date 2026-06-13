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
        DB::unprepared("create proc [dbo].[fr_hisrajal_back_temp_sp]
@no_mr as varchar(10),
@kode_dokter as int,
@kode_bag as varchar(10)

as

truncate table fr_tc_far_his_temp;

insert into fr_tc_far_his_temp(kode_trans_far, tgl_trans, kd_tr_resep, nama_brg, kode_brg, jumlah_pesan, jumlah_tebus, sisa, harga_beli, harga_jual, harga_r, status_kirim, kode_profit, status_transaksi, no_mr, kode_dokter, kode_bagian, 
                        kode_bagian_asal, kode_pesan_resep, no_registrasi, no_kunjungan, dokter_pengirim, nama_pasien, alamat_pasien, telpon_pasien, no_resep, jumlah_retur, harga_r_retur, status_retur, biaya_tebus, racik, satuan_kecil
)
select kode_trans_far, tgl_trans, kd_tr_resep, nama_brg, kode_brg, jumlah_pesan, jumlah_tebus, sisa, harga_beli, harga_jual, harga_r, status_kirim, kode_profit, status_transaksi, no_mr, kode_dokter, kode_bagian, 
                        kode_bagian_asal, kode_pesan_resep, no_registrasi, no_kunjungan, dokter_pengirim, nama_pasien, alamat_pasien, telpon_pasien, no_resep, jumlah_retur, harga_r_retur, status_retur, biaya_tebus, racik, satuan_kecil

from fr_hisrajal_back1_v where no_mr=@no_mr and kode_dokter=@kode_dokter and kode_bagian_asal=@kode_bag;
/*
truncate table fr_tc_far_temp;

insert into fr_tc_far_temp(kode_trans_far, kode_pesan_resep, no_resep, kode_profit, kode_bagian, tgl_trans, kode_bagian_asal, no_mr, no_kunjungan, kode_dokter, no_registrasi
)
select kode_trans_far, kode_pesan_resep, no_resep, kode_profit, kode_bagian, tgl_trans, kode_bagian_asal, no_mr, no_kunjungan, kode_dokter, no_registrasi

from  OPENQUERY(SVR_BACK, 'select * from fr_tc_far') AS derivedtbl_1  where no_mr=@no_mr and kode_dokter=@kode_dokter and kode_bagian_asal=@kode_bag;


truncate table fr_tc_far_detail_temp;

insert into fr_tc_far_detail_temp(kd_tr_resep, kode_trans_far, jumlah_pesan, jumlah_tebus, sisa, jumlah_retur, harga_r_retur, kode_brg, harga_beli, harga_jual, harga_r, biaya_tebus, 
                          racik, takaran, penggunaan, instruksi, jml_pakai, jml_takar, jml_konversi, tgl_input, 
                         alasan_retur, profit_2_persen, instruksi_tambahan

)
select kd_tr_resep, kode_trans_far, jumlah_pesan, jumlah_tebus, sisa, jumlah_retur, harga_r_retur, kode_brg, harga_beli, harga_jual, harga_r, biaya_tebus,
                        racik, takaran, penggunaan, instruksi, jml_pakai, jml_takar, jml_konversi, tgl_input, 
                         alasan_retur, profit_2_persen, instruksi_tambahan

from OPENQUERY(SVR_BACK, 'select * from fr_tc_far_detail') AS derivedtbl_2 where kode_trans_far in (select kode_trans_far from fr_tc_far_temp);
*/");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS fr_hisrajal_back_temp_sp");
    }
};
