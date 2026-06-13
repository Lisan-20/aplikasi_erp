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
        DB::statement("CREATE VIEW dbo.v_cek_obat_retur_2
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_rs_jatah, 
                      dbo.tc_trans_pelayanan.lain_lain, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kode_trans_far, 
                      dbo.tc_trans_pelayanan.kd_tr_resep, dbo.tc_trans_pelayanan.status_kredit
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.flag_jurnal = 0) AND (dbo.tc_trans_pelayanan.kode_bagian = '060101') AND (dbo.tc_trans_pelayanan.jenis_tindakan = 11) AND 
                      (dbo.tc_trans_pelayanan.status_kredit = 0 OR
                      dbo.tc_trans_pelayanan.status_kredit IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_cek_obat_retur_2]");
    }
};
