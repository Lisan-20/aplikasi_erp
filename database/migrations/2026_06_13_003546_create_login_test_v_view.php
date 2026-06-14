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
        DB::statement("CREATE OR ALTER VIEW dbo.login_test_v
AS
SELECT     id_calon, tgl_lahir, REPLACE(CONVERT(varchar, tgl_lahir, 103), '/', '') AS tgl_lhr, nama_pegawai, kode_bagian
FROM         dbo.mt_karyawan_calon
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [login_test_v]");
    }
};
