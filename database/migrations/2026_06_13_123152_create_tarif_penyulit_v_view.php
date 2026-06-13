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
        DB::statement("CREATE VIEW dbo.tarif_penyulit_v
AS
SELECT     dbo.tbl_penyulit.*, dbo.mt_master_tarif.kode_tarif
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.tbl_penyulit ON dbo.mt_master_tarif.referensi = dbo.tbl_penyulit.referensi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tarif_penyulit_v]");
    }
};
