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
        DB::statement("CREATE VIEW dbo.upd_asisten_v
AS
SELECT     no_mr, no_registrasi, kode_dokter1, nama_tindakan, kode_paramedis
FROM         dbo.tc_trans_pelayanan
WHERE     (kode_dokter1 LIKE '5027130812%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_asisten_v]");
    }
};
