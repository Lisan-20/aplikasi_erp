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
        DB::statement("CREATE VIEW dbo.tgl_lahir
AS
SELECT     dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.tgl_lhr, dbo.xx_den.tgl_lhr AS tgl_lhr_upd
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.xx_den ON dbo.mt_master_pasien.nama_pasien = dbo.xx_den.nama_pasien
WHERE     (dbo.mt_master_pasien.tgl_lhr IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tgl_lahir]");
    }
};
