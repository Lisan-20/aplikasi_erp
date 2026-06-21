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
        DB::statement("CREATE OR ALTER VIEW dbo.ref_man_det_ok_v
AS
SELECT     dbo.ref_man_ok_v.no_urut_periodik AS id_tc_ref, dbo.ref_man_det_v.kode_brg, 1 AS jumlah_besar, dbo.ref_man_det_v.satuan_besar, 
                      dbo.ref_man_det_v.[content] AS rasio, NULL AS status_batal, 2 AS pilih_satuan, dbo.ref_man_ok_v.user_id, 
                      dbo.ref_man_det_v.satuan_kecil AS satuan, dbo.ref_man_det_v.hna AS harga_satuan_netto, dbo.ref_man_ok_v.tgl_ref
FROM         dbo.ref_man_det_v INNER JOIN
                      dbo.ref_man_ok_v ON dbo.ref_man_det_v.kodesupplier = dbo.ref_man_ok_v.kodesupplier
WHERE     (dbo.ref_man_det_v.hna > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ref_man_det_ok_v]");
    }
};
