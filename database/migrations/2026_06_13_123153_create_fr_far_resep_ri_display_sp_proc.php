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
        DB::unprepared("create proc [dbo].[fr_far_resep_ri_display_sp]
--@no_registrasi as varchar(50)


as

truncate table fr_far_resep_ri_display;

insert into fr_far_resep_ri_display(kode_brg, nama_brg, satuan_kecil

)
select  kode_brg, nama_brg, satuan_kecil


from pasien_masih_rawat_obat3_v  --where no_registrasi=@no_registrasi;

update pasien_masih_rawat_obat4_v set jml_bag1=jumlah --500002 PU 1
update pasien_masih_rawat_obat5_v set jml_bag2=jumlah --500003 PU 2
update pasien_masih_rawat_obat6_v set jml_bag3=jumlah --500004 PU 3
update pasien_masih_rawat_obat7_v set jml_bag4=jumlah --500001 NIFAS
update pasien_masih_rawat_obat8_v set jml_bag5=jumlah --500005 PU ANAK
update pasien_masih_rawat_obat9_v set jml_bag6=jumlah --030501 VK
update pasien_masih_rawat_obat10_v set jml_bag7=jumlah --030601 PERINA
update pasien_masih_rawat_obat11_v set jml_bag8=jumlah --031001 ICU
update pasien_masih_rawat_obat12_v set jml_bag9=jumlah --032001 NICU
update pasien_masih_rawat_obat13_v set jml_bag10=jumlah --034001 HCU
update pasien_masih_rawat_obat14_v set jml_bag11=jumlah --033001 PICU


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS fr_far_resep_ri_display_sp");
    }
};
