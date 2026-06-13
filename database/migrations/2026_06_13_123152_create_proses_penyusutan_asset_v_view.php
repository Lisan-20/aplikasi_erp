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
        DB::statement("CREATE VIEW dbo.proses_penyusutan_asset_v
AS
SELECT     kode_brg, kode_bagian, nama_brg, satuan_kecil, asset_type, tgl_perolehan, tgl_pemakaian, qty, estimasi_penggunaan, metode_penyusutan, rate AS xx, harga_beli, nama_bagian, thn_peroleh, 
                      acc_d, acc_k, tahun - thn_peroleh AS thn_penyusutan, satuan_besar, tahun, bulan, harga_beli * 10 / 100 AS rate_harga2, 10 AS rate, residu, (harga_beli - residu) * MONTH(tgl_perolehan) 
                      / 12 AS rate_harga, harga_beli AS Expr1, status_asset, tgl_kadaluarsa
FROM         dbo.mt_depo_asset_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [proses_penyusutan_asset_v]");
    }
};
