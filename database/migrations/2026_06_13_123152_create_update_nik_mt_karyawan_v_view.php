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
        DB::statement("CREATE VIEW dbo.update_nik_mt_karyawan_v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.pasprsh.MR, dbo.pasprsh.NOPEG, dbo.mt_master_pasien.nik, dbo.pasprsh.NMPEG, 
                      dbo.mt_master_pasien.nama_karyawan
FROM         dbo.pasprsh INNER JOIN
                      dbo.mt_master_pasien ON dbo.pasprsh.MR = dbo.mt_master_pasien.no_mr
WHERE     (dbo.mt_master_pasien.nik IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_nik_mt_karyawan_v]");
    }
};
