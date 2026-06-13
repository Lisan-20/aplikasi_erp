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
        DB::statement("CREATE VIEW dbo.harga_brg_terbaru_v
AS
SELECT     tgl, kode_brg, jumlah_besar, isi, satuan, harga, kodesupplier, pilih_satuan, discount
FROM         dbo.harga_ref_v
UNION
SELECT     tgl, kode_brg, jumlah_besar, isi, satuan, harga, kodesupplier, pilih_satuan, discount
FROM         harga_po_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [harga_brg_terbaru_v]");
    }
};
