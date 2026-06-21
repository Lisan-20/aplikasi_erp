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
        DB::statement("CREATE OR ALTER VIEW dbo.topik_v
AS
SELECT     dbo.topik.id_topik, dbo.topik.isi_topik, dbo.topik.tgl_topik, dbo.topik.username, dbo.dd_user.email, dbo.topik.dibaca
FROM         dbo.topik LEFT OUTER JOIN
                      dbo.dd_user ON dbo.topik.username = dbo.dd_user.username
WHERE     (dbo.topik.id_topik = 1) AND (dbo.topik.publish = 'Y')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [topik_v]");
    }
};
