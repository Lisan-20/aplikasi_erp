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
        DB::statement("CREATE VIEW dbo.pasien_rsbh_v
AS
SELECT     no_mr, nama_pasien, CAST(tgl_lahir AS datetime) AS tgl_lahir, jk, alamat_pasien, no_telepon, pekerjaan, nama_ortu
FROM         dbo.pasien_rsbh
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_rsbh_v]");
    }
};
