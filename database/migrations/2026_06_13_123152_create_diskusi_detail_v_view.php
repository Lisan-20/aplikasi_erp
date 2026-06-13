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
        DB::statement("CREATE VIEW dbo.diskusi_detail_v
AS
SELECT     dbo.topik.id_topik, COUNT(dbo.tanggapan.id_tanggapan) AS jml_tanggapan, dbo.topik.subjek, dbo.topik.id_kategori, dbo.topik.dibaca, dbo.topik.username
FROM         dbo.topik LEFT OUTER JOIN
                      dbo.tanggapan ON dbo.topik.id_topik = dbo.tanggapan.id_topik
WHERE     (dbo.topik.publish = 'Y')
GROUP BY dbo.topik.id_topik, dbo.topik.subjek, dbo.topik.id_kategori, dbo.topik.dibaca, dbo.topik.username
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [diskusi_detail_v]");
    }
};
