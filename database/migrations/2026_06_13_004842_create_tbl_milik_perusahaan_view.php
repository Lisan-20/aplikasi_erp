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
        DB::statement("CREATE OR ALTER VIEW dbo.tbl_milik_perusahaan
AS
SELECT     dbo.tbl_milik_detail.kode_perusahaan, dbo.tbl_milik_detail.kode_kepesertaan, dbo.tbl_milik_detail.kode_milik, dbo.tbl_milik.nama_milik
FROM         dbo.tbl_milik INNER JOIN
                      dbo.tbl_milik_detail ON dbo.tbl_milik.kode_milik = dbo.tbl_milik_detail.kode_milik
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tbl_milik_perusahaan]");
    }
};
