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
        DB::statement("CREATE VIEW dbo.fr_his_v
AS
SELECT     dbo.fr_hisbebasluar_v.kode_trans_far, dbo.tbl_obat_racikan_v.kode_brg_racikan, dbo.fr_hisbebasluar_v.kode_brg, dbo.fr_hisbebasluar_v.nama_brg, 
                      dbo.fr_hisbebasluar_v.tgl_trans, dbo.fr_hisbebasluar_v.jumlah_tebus, dbo.fr_hisbebasluar_v.jumlah_retur, dbo.fr_hisbebasluar_v.petugas, 
                      dbo.fr_hisbebasluar_v.kode_bagian, dbo.fr_hisbebasluar_v.status_transaksi, dbo.tbl_obat_racikan_v.jumlah
FROM         dbo.tbl_obat_racikan_v INNER JOIN
                      dbo.fr_hisbebasluar_v ON dbo.tbl_obat_racikan_v.kode_trans_far = dbo.fr_hisbebasluar_v.kode_trans_far
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_his_v]");
    }
};
