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
        DB::statement("CREATE VIEW dbo.th_icd9_pasien_v
AS
SELECT     dbo.mt_master_icd9cm.nama_icd AS nama_icd9, dbo.th_icd9_pasien.kode_icd9, dbo.th_icd9_pasien.no_registrasi, dbo.th_icd9_pasien.tgl_jam
FROM         dbo.th_icd9_pasien INNER JOIN
                      dbo.mt_master_icd9cm ON dbo.th_icd9_pasien.kode_icd9 = dbo.mt_master_icd9cm.icd_9
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_icd9_pasien_v]");
    }
};
