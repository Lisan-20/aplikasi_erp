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
        DB::statement("CREATE OR ALTER VIEW dbo.update_pasien_bpjs_katarak
AS
SELECT     dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.no_ktp, dbo.mt_master_pasien.no_askes, dbo.mt_master_pasien.nik, dbo.pasien_katarak_2016.[NO BPJS], 
                      dbo.pasien_katarak_2016.[NO# MR]
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.pasien_katarak_2016 ON dbo.mt_master_pasien.no_mr = dbo.pasien_katarak_2016.[NO# MR]
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_pasien_bpjs_katarak]");
    }
};
