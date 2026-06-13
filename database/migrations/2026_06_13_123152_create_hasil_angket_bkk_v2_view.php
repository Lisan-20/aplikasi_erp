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
        DB::statement("CREATE VIEW dbo.hasil_angket_bkk_v2
AS
SELECT     dbo.hasil_angket_bkk.id_jawaban, dbo.hasil_angket_bkk.bagian, dbo.hasil_angket_bkk.nama_pegawai, dbo.mt_bagian.kode_bagian, dbo.mt_bagian.nama_bagian
FROM         dbo.hasil_angket_bkk INNER JOIN
                      dbo.mt_bagian ON dbo.hasil_angket_bkk.bagian = dbo.mt_bagian.kode_bagian
GROUP BY dbo.hasil_angket_bkk.id_jawaban, dbo.hasil_angket_bkk.bagian, dbo.hasil_angket_bkk.nama_pegawai, dbo.mt_bagian.kode_bagian, dbo.mt_bagian.nama_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hasil_angket_bkk_v2]");
    }
};
