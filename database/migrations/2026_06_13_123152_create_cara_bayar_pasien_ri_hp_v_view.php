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
        DB::statement("CREATE VIEW dbo.cara_bayar_pasien_ri_hp_v
AS
SELECT     kode_tc_trans_kasir, no_registrasi, jenis_tindakan, jumlah, nama_tindakan, kode_bagian
FROM         dbo.tc_trans_pelayanan
WHERE     (nama_tindakan LIKE 'ruang%') AND (jenis_tindakan = 1) AND (NOT (kode_bagian IN ('031301', '030901')))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cara_bayar_pasien_ri_hp_v]");
    }
};
