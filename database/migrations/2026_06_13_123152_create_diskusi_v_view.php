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
        DB::statement("CREATE VIEW dbo.diskusi_v
AS
SELECT     dbo.kategori_forum.id_kategori, dbo.kategori_forum.nama_kategori, COUNT(dbo.topik.id_topik) AS jml_topik, dbo.kategori_forum.kategori_seo
FROM         dbo.kategori_forum LEFT OUTER JOIN
                      dbo.topik ON dbo.topik.id_kategori = dbo.kategori_forum.id_kategori
GROUP BY dbo.kategori_forum.id_kategori, dbo.kategori_forum.nama_kategori, dbo.kategori_forum.kategori_seo
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [diskusi_v]");
    }
};
