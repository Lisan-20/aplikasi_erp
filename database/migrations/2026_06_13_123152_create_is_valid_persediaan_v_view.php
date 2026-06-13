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
        DB::statement("CREATE VIEW dbo.is_valid_persediaan_v
AS
SELECT     dbo.jurnal_pengiriman_unit_kredit_v.id_tc_permintaan_inst, jurnal_pengiriman_unit_kredit_v_1.jumlah_penerimaan AS minta, 
                      dbo.jurnal_pengiriman_unit_kredit_v.jumlah_penerimaan AS kirim
FROM         dbo.jurnal_pengiriman_unit_kredit_v INNER JOIN
                      dbo.jurnal_pengiriman_unit_kredit_v AS jurnal_pengiriman_unit_kredit_v_1 ON 
                      dbo.jurnal_pengiriman_unit_kredit_v.id_tc_permintaan_inst = jurnal_pengiriman_unit_kredit_v_1.id_tc_permintaan_inst AND 
                      dbo.jurnal_pengiriman_unit_kredit_v.jumlah_penerimaan = jurnal_pengiriman_unit_kredit_v_1.jumlah_penerimaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [is_valid_persediaan_v]");
    }
};
