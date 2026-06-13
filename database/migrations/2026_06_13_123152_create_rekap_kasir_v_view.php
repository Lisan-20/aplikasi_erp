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
        DB::statement("CREATE VIEW dbo.rekap_kasir_v
AS
SELECT DISTINCT 
                      TOP (100) PERCENT a.seri_kuitansi, a.no_kuitansi, a.nama_pasien, a.tunai, a.debet, a.kredit, a.nk_karyawan, a.nk_perusahaan, a.nk_askes, a.no_debet, a.no_kredit, a.keterangan, a.nk, a.nd, 
                      a.potongan, c.no_mr AS no_mr_um, d.nama_pegawai, a.tgl_jam, YEAR(a.tgl_jam) AS thn, MONTH(a.tgl_jam) AS bln, DAY(a.tgl_jam) AS tgl, a.status_batal
FROM         dbo.tc_trans_kasir AS a LEFT OUTER JOIN
                      dbo.ks_tc_trans_um AS c ON a.kode_tc_trans_kasir = c.kode_tc_trans_kasir LEFT OUTER JOIN
                      dbo.mt_karyawan AS d ON a.no_induk = d.no_induk
WHERE     (a.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rekap_kasir_v]");
    }
};
