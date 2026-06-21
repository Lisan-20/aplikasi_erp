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
        DB::statement("CREATE OR ALTER VIEW dbo.tanggapan_v
AS
SELECT     TOP (100) PERCENT dbo.tanggapan.id_topik, dbo.tanggapan.isi_tanggapan, dbo.tanggapan.tgl_tanggapan, dbo.tanggapan.username, dbo.dd_user.email
FROM         dbo.tanggapan LEFT OUTER JOIN
                      dbo.dd_user ON dbo.tanggapan.username = dbo.dd_user.username
WHERE     (dbo.tanggapan.id_topik = '1') AND (dbo.tanggapan.publish = 'Y')
ORDER BY dbo.tanggapan.id_tanggapan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tanggapan_v]");
    }
};
