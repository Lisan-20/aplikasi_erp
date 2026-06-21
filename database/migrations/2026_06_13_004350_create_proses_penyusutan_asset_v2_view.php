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
        DB::statement("CREATE OR ALTER VIEW dbo.proses_penyusutan_asset_v2
AS
SELECT     kode_brg, kode_bagian, nama_brg, satuan_kecil, asset_type, tgl_perolehan, tgl_pemakaian, qty, metode_penyusutan, estimasi_penggunaan, harga_beli, nama_bagian, thn_peroleh, acc_d, acc_k, 
                      NULLIF (thn_penyusutan, 0) AS thn_penyusutan, satuan_besar, tahun, bulan, NULLIF (rate_harga, 0) AS rate_harga, residu, status_asset, tgl_kadaluarsa
FROM         dbo.proses_penyusutan_asset_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [proses_penyusutan_asset_v2]");
    }
};
