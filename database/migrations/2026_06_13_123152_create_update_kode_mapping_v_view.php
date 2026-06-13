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
        DB::statement("CREATE OR ALTER VIEW dbo.update_kode_mapping_v
AS
SELECT kode_mapping_transaksi,
  ROW_NUMBER() OVER(ORDER BY kode_bagian ASC) AS Row,
  kode_bagian FROM mapping_transaksi 


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kode_mapping_v]");
    }
};
