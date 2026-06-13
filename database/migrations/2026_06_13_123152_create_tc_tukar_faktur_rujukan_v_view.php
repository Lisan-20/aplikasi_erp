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
        DB::statement("CREATE VIEW dbo.tc_tukar_faktur_rujukan_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan AS nama_pasien, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_pelayanan.bill_rs_rujukan, 
                      dbo.tc_trans_pelayanan.id_dd_rujuk_rs, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.flag_hutang, dbo.dd_rujuk_rs.nama_rs_rujuk, 
                      dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.status_batal
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.dd_rujuk_rs ON dbo.tc_trans_pelayanan.id_dd_rujuk_rs = dbo.dd_rujuk_rs.id_dd_rujuk_rs
WHERE     (dbo.tc_trans_pelayanan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_tukar_faktur_rujukan_v]");
    }
};
