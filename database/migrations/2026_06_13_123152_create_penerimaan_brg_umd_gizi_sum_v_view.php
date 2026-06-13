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
        DB::statement("CREATE VIEW dbo.penerimaan_brg_umd_gizi_sum_v
AS
SELECT     no_bukti, tgl_transaksi, namasupplier, COUNT(kode_brg) AS sisa_pesan, id_trans_umd, kode_permohonan, jumlah_sdh_terima, status_kirim
FROM         dbo.penerimaan_brg_umd_gizi_v
GROUP BY no_bukti, tgl_transaksi, namasupplier, id_trans_umd, kode_permohonan, jumlah_sdh_terima, status_kirim
HAVING      (COUNT(kode_brg) > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penerimaan_brg_umd_gizi_sum_v]");
    }
};
