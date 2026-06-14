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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_barang_union_v
AS
SELECT     nama_brg, kode_brg, satuan_kecil
FROM         mt_barang
UNION
SELECT     nama_brg, kode_brg, satuan_kecil
FROM         mt_barang_nm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_barang_union_v]");
    }
};
