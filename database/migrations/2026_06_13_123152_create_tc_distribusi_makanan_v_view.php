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
        DB::statement("CREATE VIEW dbo.tc_distribusi_makanan_v
AS
SELECT     dbo.tc_distribusi_makanan.id_dis, dbo.tc_distribusi_makanan.tgl_dis, dbo.tc_distribusi_makanan.id_user, dbo.tc_distribusi_makanan.id_gol, dbo.mt_golongan_gizi.nama_golongan
FROM         dbo.tc_distribusi_makanan INNER JOIN
                      dbo.mt_golongan_gizi ON dbo.tc_distribusi_makanan.id_gol = dbo.mt_golongan_gizi.id_gol
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_distribusi_makanan_v]");
    }
};
