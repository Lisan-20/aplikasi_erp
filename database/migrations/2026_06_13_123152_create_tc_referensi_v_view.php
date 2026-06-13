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
        DB::statement("CREATE VIEW dbo.tc_referensi_v
AS
SELECT     dbo.tc_referensi.id_tc_ref, dbo.tc_referensi.kode_ref, dbo.tc_referensi.no_urut_periodik, dbo.tc_referensi.tgl_ref, dbo.tc_referensi.tgl_inp, dbo.tc_referensi.user_id, 
                      dbo.tc_referensi.status_batal, dbo.tc_referensi.kodesupplier, dbo.mt_supplier.namasupplier
FROM         dbo.tc_referensi INNER JOIN
                      dbo.mt_supplier ON dbo.tc_referensi.kodesupplier = dbo.mt_supplier.kodesupplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_referensi_v]");
    }
};
