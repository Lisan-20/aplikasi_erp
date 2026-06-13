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
        DB::statement("CREATE VIEW dbo.trans_baksos_v
AS
SELECT        dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.kode_pesan_resep, dbo.fr_tc_far.no_resep, dbo.fr_tc_far.kode_profit, dbo.fr_tc_far.kode_bagian, dbo.fr_tc_far.tgl_trans, 
                         dbo.fr_tc_far.kode_bagian_asal, dbo.fr_tc_far.dokter_pengirim, dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far.petugas, dbo.fr_tc_far.kode_form_baksos, 
                         dbo.fr_tc_far_detail.kode_brg
FROM            dbo.fr_tc_far INNER JOIN
                         dbo.fr_tc_far_detail ON dbo.fr_tc_far.kode_trans_far = dbo.fr_tc_far_detail.kode_trans_far
WHERE        (dbo.fr_tc_far.kode_profit = 11000)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [trans_baksos_v]");
    }
};
