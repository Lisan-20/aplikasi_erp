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
        DB::statement("


CREATE VIEW dbo.bd_tc_trans_flag_dr_v
AS
SELECT     dbo.tc_trans_pelayanan.*, dbo.bd_tc_trans_flag_dr.id_bd_tc_trans_flag_dr, dbo.bd_tc_trans_flag_dr.flag_kui_dr1, 
                      dbo.bd_tc_trans_flag_dr.flag_kui_dr2, dbo.bd_tc_trans_flag_dr.flag_kui_dr3, dbo.bd_tc_trans_flag_dr.flag_kui_dr4, 
                      dbo.bd_tc_trans_flag_dr.flag_kui_dr5
FROM         dbo.tc_trans_pelayanan LEFT OUTER JOIN
                      dbo.bd_tc_trans_flag_dr ON dbo.tc_trans_pelayanan.kode_trans_pelayanan = dbo.bd_tc_trans_flag_dr.kode_trans_pelayanan



");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bd_tc_trans_flag_dr_v]");
    }
};
