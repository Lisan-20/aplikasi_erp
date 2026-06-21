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
        DB::statement("CREATE OR ALTER VIEW dbo.bedah_upload_v
AS
SELECT     kode_tarif, UPPER(nama_tarif) AS nama_tarif, referensi
FROM         dbo.mt_master_tarif
WHERE     (kode_bagian = '030901') AND (tingkatan = 5)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bedah_upload_v]");
    }
};
