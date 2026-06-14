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
        DB::statement("CREATE OR ALTER VIEW dbo.v_bill_bpjs
AS
SELECT     kode_plafon, jenis_tindakan, persen, kode_bagian, keterangan, id_jenis_layanan
FROM         dbo.mt_plafon_bpjs_detail
WHERE     (id_jenis_layanan NOT IN (5, 6, 1))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_bill_bpjs]");
    }
};
