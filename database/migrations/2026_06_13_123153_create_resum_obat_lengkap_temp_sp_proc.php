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

create proc [dbo].[resum_obat_lengkap_temp_sp]
@no_registrasi as varchar(20)


as

truncate table resum_obat_lengkap_temp;

insert into resum_obat_lengkap_temp(nama_tindakan, kode_bagian, no_registrasi, no_mr, kode_trans_far, kode_barang, jml_pakai, jml_takar, takaran, penggunaan,tgl_transaksi)
select nama_tindakan, kode_bagian, no_registrasi, no_mr, kode_trans_far, kode_barang, jml_pakai, jml_takar, takaran, penggunaan, tgl_transaksi

from resum_obat_lengkap5_v where no_registrasi=@no_registrasi;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS resum_obat_lengkap_temp_sp");
    }
};
