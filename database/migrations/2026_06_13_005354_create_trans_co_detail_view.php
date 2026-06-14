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
        DB::statement("CREATE OR ALTER VIEW dbo.trans_co_detail
AS
SELECT     id, no_pesanan, kode_produk, nama_produk, satuan, harga, diskon, qty, kirim, ganti
FROM         OPENQUERY(logistik, 'select *from trans_co_detail') AS trans_co_detail
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [trans_co_detail]");
    }
};
