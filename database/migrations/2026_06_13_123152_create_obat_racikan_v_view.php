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
        DB::statement("CREATE VIEW dbo.obat_racikan_v
AS
SELECT     dbo.fr_tc_far.tgl_trans, dbo.tbl_obat_racikan_v.nama_brg, dbo.tbl_obat_racikan_v.kode_brg_racikan, dbo.tbl_obat_racikan_v.harga, 
                      dbo.fr_mt_profit_margin.nama_pelayanan, dbo.tbl_obat_racikan_v.user_id, dbo.fr_tc_far.kode_bagian, dbo.tbl_obat_racikan_v.jumlah_kirim, 
                      dbo.fr_tc_far.kode_profit
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.tbl_obat_racikan_v ON dbo.fr_tc_far.kode_trans_far = dbo.tbl_obat_racikan_v.kode_trans_far INNER JOIN
                      dbo.fr_mt_profit_margin ON dbo.fr_tc_far.kode_profit = dbo.fr_mt_profit_margin.kode_profit
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [obat_racikan_v]");
    }
};
