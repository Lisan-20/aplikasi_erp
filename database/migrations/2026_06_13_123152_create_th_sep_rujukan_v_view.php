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
        DB::statement("CREATE OR ALTER VIEW dbo.th_sep_rujukan_v
AS
SELECT     dbo.th_sep_rujukan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.th_sep_rujukan.no_rujukan, dbo.th_sep_rujukan.tgl_rujukan, dbo.th_sep_rujukan.jumlah_sep, dbo.th_sep_rujukan.no_kartu, 
                      dbo.mt_master_pasien.tlp_almt_ttp
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.th_sep_rujukan ON dbo.mt_master_pasien.no_mr = dbo.th_sep_rujukan.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_sep_rujukan_v]");
    }
};
