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
        DB::statement("CREATE VIEW dbo.jurnal_gizi_1_v
AS
SELECT     no_registrasi, jenis_tindakan, kode_klas, kode_tc_trans_kasir, kode_bagian, kode_kelompok
FROM         dbo.tc_trans_pelayanan
WHERE     (nama_tindakan LIKE 'Ruang%') AND (jenis_tindakan = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_gizi_1_v]");
    }
};
