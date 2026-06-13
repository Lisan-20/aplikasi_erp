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
        DB::statement("CREATE VIEW dbo.pemeliharaan_brg_detail_v
AS
SELECT     dbo.pemeliharaan_brg_v.kode_brg, dbo.pemeliharaan_brg_v.nama_brg, dbo.pemeliharaan_brg_v.nama_bagian, dbo.tc_pemeliharaan_alat.tgl_pemeliharaan, dbo.tc_pemeliharaan_alat.keluhan, 
                      dbo.tc_pemeliharaan_alat.solusi, dbo.tc_pemeliharaan_alat.catatan, dbo.tc_pemeliharaan_alat.tgl_rencana, dbo.tc_pemeliharaan_alat.id_pemeliharaan, dbo.pemeliharaan_brg_v.kode_bagian
FROM         dbo.pemeliharaan_brg_v INNER JOIN
                      dbo.tc_pemeliharaan_alat ON dbo.pemeliharaan_brg_v.kode_depo_stok = dbo.tc_pemeliharaan_alat.kode_depo_stok_nm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pemeliharaan_brg_detail_v]");
    }
};
