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
        DB::statement("CREATE VIEW dbo.tc_penggunaan_obat_ri_v
AS
SELECT     dbo.tc_penggunaan_obat_ri_det.kode_brg, dbo.tc_penggunaan_obat_ri_det.nama_brg, dbo.tc_penggunaan_obat_ri_det.jumlah AS jumlah_pakai, dbo.tc_penggunaan_obat_ri_det.kode_trans_far, 
                      dbo.tc_penggunaan_obat_ri_det.kd_tr_resep, dbo.tc_penggunaan_obat_ri_det.jumlah, dbo.tc_penggunaan_obat_ri.id_user, dbo.tc_penggunaan_obat_ri.ttd, dbo.tc_penggunaan_obat_ri.ttd_nama, 
                      dbo.tc_penggunaan_obat_ri.no_registrasi, dbo.tc_penggunaan_obat_ri.no_kunjungan, dbo.tc_penggunaan_obat_ri.no_mr, dbo.tc_penggunaan_obat_ri.tgl_penggunaan, dbo.mt_barang.satuan_kecil, 
                      dbo.mt_karyawan.nama_pegawai AS perawat, dbo.tc_penggunaan_obat_ri.id_penggunaan, dbo.tc_penggunaan_obat_ri_det.intruksi, dbo.tc_penggunaan_obat_ri_det.int_penggunaan, 
                      dbo.tc_penggunaan_obat_ri_det.int_waktu_pakai
FROM         dbo.tc_penggunaan_obat_ri_det INNER JOIN
                      dbo.tc_penggunaan_obat_ri ON dbo.tc_penggunaan_obat_ri_det.id_penggunaan = dbo.tc_penggunaan_obat_ri.id_penggunaan INNER JOIN
                      dbo.mt_barang ON dbo.tc_penggunaan_obat_ri_det.kode_brg = dbo.mt_barang.kode_brg LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_penggunaan_obat_ri.id_user = dbo.mt_karyawan.no_induk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_penggunaan_obat_ri_v]");
    }
};
