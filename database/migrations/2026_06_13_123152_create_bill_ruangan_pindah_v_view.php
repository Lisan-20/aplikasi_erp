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
        DB::statement("CREATE VIEW dbo.bill_ruangan_pindah_v
AS
SELECT     dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.mt_master_tarif_ruangan.harga_jkn * dbo.tc_trans_pelayanan.jumlah AS harga_kamar_jkn, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, 
                      dbo.tc_trans_pelayanan.kode_klas, dbo.tc_trans_pelayanan.tgl_pindah, dbo.tc_trans_pelayanan.status_batal
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_ruangan ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_master_tarif_ruangan.kode_bagian AND 
                      dbo.tc_trans_pelayanan.kode_klas = dbo.mt_master_tarif_ruangan.kode_klas
WHERE     (dbo.tc_trans_pelayanan.tgl_pindah IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bill_ruangan_pindah_v]");
    }
};
