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
        DB::statement("CREATE VIEW dbo.upd_lab_e
AS
SELECT     dbo.upd_lab_ri.nama_tarif, dbo.upd_lab_ri.kode_klas, dbo.upd_lab_ri.bill_rs, dbo.upd_lab_ri.bill_dr1, dbo.upd_lab_ri.bill_dr1_pt, dbo.upd_lab_ri.bill_rs_pt, dbo.upd_lab_ri.bill_rs_ass, 
                      dbo.upd_lab_ri.bill_dr1_ass, dbo.upd_lab_ri.bill_rs_bpjs, dbo.upd_lab_ri.bill_dr1_bpjs, dbo.upd_lab_ri.bill_rs_inhealth, dbo.upd_lab_ri.bill_dr1_inhealth, dbo.upd_lab_ri.bill_dr2_inhealth, 
                      dbo.upd_lab_rj.bill_rs AS bill_rs_rj, dbo.upd_lab_rj.bill_dr1 AS bill_dr1_rj, dbo.upd_lab_rj.bill_rs_pt AS bill_rs_pt_rj, dbo.upd_lab_rj.bill_dr1_pt AS bill_dr1_pt_rj, 
                      dbo.upd_lab_rj.bill_rs_ass AS bill_rs_ass_rj, dbo.upd_lab_rj.bill_dr1_ass AS bill_dr1_ass_rj, dbo.upd_lab_rj.bill_rs_bpjs AS bill_rs_bpjs_rj, dbo.upd_lab_rj.bill_dr1_bpjs AS bill_dr1_bpjs_rj, 
                      dbo.upd_lab_rj.bill_rs_inhealth AS bill_rs_inhealth_rj, dbo.upd_lab_rj.bill_dr1_inhealth AS bill_dr1_inhealth_rj
FROM         dbo.upd_lab_ri INNER JOIN
                      dbo.upd_lab_rj ON dbo.upd_lab_ri.nama_tarif = dbo.upd_lab_rj.nama_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_lab_e]");
    }
};
