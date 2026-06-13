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
        DB::statement("CREATE VIEW dbo.v_fee_dokter_bpjs_tindakan
AS
SELECT     dbo.tc_trans_pelayanan.kode_bagian, COUNT(dbo.tc_trans_pelayanan.kode_dokter1) AS jumlah_tindakan, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_jkn.id_jenis_layanan, 
                      dbo.tc_trans_jkn.persen_bpjs, dbo.tc_trans_jkn.plafon, dbo.tc_trans_kasir.tgl_jam
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.tc_trans_jkn ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_trans_jkn.no_registrasi AND 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_jkn.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_kasir.no_mr, 
                      dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_jkn.id_jenis_layanan, dbo.tc_trans_jkn.persen_bpjs, dbo.tc_trans_jkn.plafon, dbo.tc_trans_kasir.tgl_jam
HAVING      (dbo.tc_trans_pelayanan.kode_bagian LIKE '03%') AND (dbo.tc_trans_pelayanan.kode_dokter1 > '0') AND (dbo.tc_trans_pelayanan.jenis_tindakan <> 4) AND 
                      (dbo.tc_trans_pelayanan.bill_dr1 > 0) AND (NOT (dbo.tc_trans_kasir.kode_bagian IN ('030901'))) AND (dbo.tc_trans_pelayanan.kode_kelompok = 9) AND 
                      (dbo.tc_trans_jkn.id_jenis_layanan = 6)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_fee_dokter_bpjs_tindakan]");
    }
};
