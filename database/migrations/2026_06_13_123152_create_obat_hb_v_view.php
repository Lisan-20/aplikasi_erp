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
        DB::statement("CREATE VIEW dbo.obat_hb_v
AS
SELECT     dbo.tc_bpako_hemodialisa.no_registrasi, dbo.tc_bpako_hemodialisa.no_mr, dbo.tc_bpako_hemodialisa.kode_brg, 
                      dbo.tc_bpako_hemodialisa.nama_brg, dbo.tc_bpako_hemodialisa.jumlah, dbo.tc_trans_pelayanan.nama_pasien_layan, 
                      dbo.tc_bpako_hemodialisa.kode_penunjang
FROM         dbo.tc_bpako_hemodialisa LEFT OUTER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_bpako_hemodialisa.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [obat_hb_v]");
    }
};
