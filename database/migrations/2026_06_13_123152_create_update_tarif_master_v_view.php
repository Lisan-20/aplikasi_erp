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
        DB::statement("CREATE VIEW dbo.update_tarif_master_v
AS
SELECT     dbo.mt_tarif_v.*, dbo.tbl_update_tarif.kode_bagian_update, dbo.tbl_update_tarif.persen
FROM         dbo.tbl_update_tarif INNER JOIN
                      dbo.mt_tarif_v ON dbo.tbl_update_tarif.kode_bagian_update = dbo.mt_tarif_v.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_tarif_master_v]");
    }
};
