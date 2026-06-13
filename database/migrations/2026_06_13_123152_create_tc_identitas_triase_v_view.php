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
        DB::statement("CREATE VIEW dbo.tc_identitas_triase_v
AS
SELECT     nama_pasien, umur, id, id_triase, alamat, tgl_input, warna, kat_triase, user_id, keluhan_utama, jen_kel
FROM         dbo.tc_identitas_triase
GROUP BY nama_pasien, umur, id, id_triase, alamat, tgl_input, warna, kat_triase, user_id, keluhan_utama, jen_kel
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_identitas_triase_v]");
    }
};
