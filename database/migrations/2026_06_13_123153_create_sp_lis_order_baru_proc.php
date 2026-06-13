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
        DB::unprepared("CREATE proc [dbo].[sp_lis_order_baru]

 @kode_penunjang as varchar(20)
as

begin

INSERT INTO db_MedLis.dbo.order_lab (kode_penunjang, asal_lab, no_registrasi, no_kunjungan, no_rm, tgl_order, nama_pas, jenis_kel, tgl_lahir, usia, alamat, kode_dok_kirim, 
                      nama_dok_kirim, kode_ruang, nama_ruang, kode_cara_bayar, cara_bayar, ket_klinis, kode_test, test, Harga, waktu_kirim, prioritas, jns_rawat, dok_jaga, status, NIK, 
                      batal, Jumlah_test)

SELECT kode_penunjang, asal_lab, no_registrasi, no_kunjungan, no_rm, tgl_order, nama_pas, jenis_kel, tgl_lahir, usia, alamat, kode_dok_kirim, 
                      nama_dok_kirim, kode_ruang, nama_ruang, kode_cara_bayar, cara_bayar, ket_klinis, kode_test, test, Harga, waktu_kirim, prioritas, jns_rawat, dok_jaga, status, NIK, 
                      batal, Jumlah_test

FROM order_lab_ten Where kode_penunjang=@kode_penunjang; 

update pm_tc_penunjang Set flag_lis=1 Where kode_penunjang=@kode_penunjang; 

end");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_lis_order_baru");
    }
};
