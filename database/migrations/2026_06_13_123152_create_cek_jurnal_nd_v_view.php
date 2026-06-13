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
        DB::statement("CREATE VIEW dbo.cek_jurnal_nd_v
AS
SELECT     no_registrasi, tgl_jam, kode, jumlah
FROM         dbo.tran_kasir
WHERE     (kode = 4)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_jurnal_nd_v]");
    }
};
