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
        DB::statement("CREATE VIEW dbo.resum_obat_lengkap_temp_v2
AS
SELECT     dbo.resum_obat_lengkap_temp.id, dbo.resum_obat_lengkap_temp.nama_tindakan AS nm_brg, dbo.resum_obat_lengkap_temp.kode_bagian, dbo.resum_obat_lengkap_temp.no_registrasi, 
                      dbo.resum_obat_lengkap_temp.no_mr, dbo.resum_obat_lengkap_temp.kode_trans_far, dbo.resum_obat_lengkap_temp.kode_barang, dbo.resum_obat_lengkap_temp.jml_pakai, 
                      dbo.resum_obat_lengkap_temp.jml_takar, dbo.resum_obat_lengkap_temp.takaran, dbo.resum_obat_lengkap_temp.penggunaan, dbo.resum_obat_lengkap_temp.tgl_transaksi, 
                      dbo.mt_barang.nama_brg AS nama_tindakan
FROM         dbo.resum_obat_lengkap_temp INNER JOIN
                      dbo.mt_barang ON dbo.resum_obat_lengkap_temp.kode_barang = dbo.mt_barang.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [resum_obat_lengkap_temp_v2]");
    }
};
