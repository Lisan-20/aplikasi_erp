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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_hasil_so
AS
SELECT     dbo.tbl_detail_so.*, dbo.tbl_hasil_so.so AS so_ok
FROM         dbo.tbl_detail_so INNER JOIN
                      dbo.tbl_hasil_so ON dbo.tbl_detail_so.kode_brg = dbo.tbl_hasil_so.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_hasil_so]");
    }
};
