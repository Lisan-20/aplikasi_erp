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
        DB::statement("CREATE OR ALTER VIEW dbo.update_bukti_tau_v
AS
SELECT     nomor_permintaan, bln, thn, id_tc_permintaan_inst, Nomor, dbo.NoBuktiHead(Nomor) AS awalan, bukti_upd, CAST(dbo.NoBuktiHead(Nomor) + '/RS/AU/II/2017' AS varchar(50)) AS bukti_ok
FROM         dbo.v_bukti_TU
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bukti_tau_v]");
    }
};
