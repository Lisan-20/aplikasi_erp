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
        DB::statement("CREATE VIEW dbo.kasir_v
AS
SELECT     dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, 
                      dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.tambahan, dbo.tc_trans_kasir.potongan, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, dbo.tc_trans_kasir.no_debet, 
                      dbo.tc_trans_kasir.kredit, dbo.tc_trans_kasir.no_kredit, dbo.tc_trans_kasir.cetak_kartu, dbo.tc_trans_kasir.nd, dbo.tc_trans_kasir.nk, dbo.tc_trans_kasir.nk_karyawan, 
                      dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.nk_askes, dbo.tc_trans_kasir.kode_perusahaan, dbo.tc_trans_pelayanan.kode_kelompok
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, 
                      dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.tambahan, dbo.tc_trans_kasir.potongan, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, dbo.tc_trans_kasir.no_debet, 
                      dbo.tc_trans_kasir.kredit, dbo.tc_trans_kasir.no_kredit, dbo.tc_trans_kasir.cetak_kartu, dbo.tc_trans_kasir.nd, dbo.tc_trans_kasir.nk, dbo.tc_trans_kasir.nk_karyawan, 
                      dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.nk_askes, dbo.tc_trans_kasir.kode_perusahaan, dbo.tc_trans_pelayanan.kode_kelompok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kasir_v]");
    }
};
