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
        DB::statement("CREATE VIEW dbo.v_cek_bagian_kasir
AS
SELECT     kode_tc_trans_kasir, kode_bagian, seri_kuitansi, tgl_jam, no_registrasi
FROM         dbo.tc_trans_kasir
WHERE     (kode_bagian = '')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_cek_bagian_kasir]");
    }
};
