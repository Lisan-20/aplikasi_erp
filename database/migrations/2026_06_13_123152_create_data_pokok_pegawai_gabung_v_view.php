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
        DB::statement("CREATE VIEW dbo.data_pokok_pegawai_gabung_v
AS
SELECT     nama_pegawai, kode_bagian, id_status, alamat, tlp, no_mr, nama_jabatan, nama_bagian, nama_bagian_gaji, npp, no_induk
FROM         data_pokok_pegawai_v
UNION
SELECT     nama_pegawai, kode_bagian, id_status, alamat, tlp, no_mr, nama_jabatan, nama_bagian, nama_bagian_gaji, npp, no_induk
FROM         data_pokok_pegawai_outsourcing_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [data_pokok_pegawai_gabung_v]");
    }
};
