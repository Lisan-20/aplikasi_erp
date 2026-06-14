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
        DB::statement("CREATE OR ALTER VIEW dbo.proses_penyusutan_asset_v3
AS
SELECT     kode_brg, kode_bagian, nama_brg, satuan_kecil, asset_type, tgl_perolehan, tgl_pemakaian, qty, metode_penyusutan, estimasi_penggunaan, harga_beli, nama_bagian, thn_peroleh, acc_d, acc_k, 
                      thn_penyusutan, satuan_besar, tahun, bulan, rate_harga, rate_harga / (estimasi_penggunaan * 12) AS nilai_penyusutan, status_asset, tgl_kadaluarsa, CAST(tahun AS varchar(4)) 
                      + '-' + RIGHT('0' + CAST(bulan AS VARCHAR(2)), 2) + '-01' AS Expr1
FROM         dbo.proses_penyusutan_asset_v2
WHERE     (tgl_kadaluarsa > CAST(tahun AS varchar(4)) + '-' + RIGHT('0' + CAST(bulan AS VARCHAR(2)), 2) + '-01')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [proses_penyusutan_asset_v3]");
    }
};
