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
        DB::statement("CREATE VIEW dbo.tc_trans_kasir_status_mr_v
AS
SELECT     dbo.tc_trans_kasir.*, dbo.mt_bagian.nama_bagian, dbo.mt_bagian.validasi, dbo.tc_registrasi.tgl_jam_masuk
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_kasir.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.mt_bagian.validasi = '030001')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_trans_kasir_status_mr_v]");
    }
};
