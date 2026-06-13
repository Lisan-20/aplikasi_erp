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
        DB::statement("CREATE VIEW dbo.tc_hasil_ekg_v
AS
SELECT     no_kunjungan AS Expr2, kesimpulan, nama_file, id_ekg, no_registrasi
FROM         dbo.tc_hasil_ekg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_hasil_ekg_v]");
    }
};
