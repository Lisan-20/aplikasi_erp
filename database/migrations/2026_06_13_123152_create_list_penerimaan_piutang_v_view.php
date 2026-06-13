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
        DB::statement("CREATE VIEW dbo.list_penerimaan_piutang_v
AS
SELECT     a.id_trans_piutang, a.kode_perusahaan, a.total, a.no_bukti, a.keterangan, b.id_trans_piutang_bayar, b.no_kuitansi_bayar, b.jumlah_bayar, b.tgl_bayar, b.id_bd_tc_trans, c.nama_perusahaan
FROM         dbo.transaksi_piutang AS a INNER JOIN
                      dbo.transaksi_piutang_bayar AS b ON b.id_trans_piutang = a.id_trans_piutang LEFT OUTER JOIN
                      dbo.mt_perusahaan AS c ON a.kode_perusahaan = c.kode_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [list_penerimaan_piutang_v]");
    }
};
