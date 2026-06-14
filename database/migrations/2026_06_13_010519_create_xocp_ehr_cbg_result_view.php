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
        DB::statement("CREATE OR ALTER VIEW dbo.xocp_ehr_cbg_result
AS
SELECT     patient_id, admission_id, response_txt0, response_txt1, response_txt2, response_txt3, response_txt4, status_cd, CASE WHEN created_dttm LIKE '0000-%' THEN CAST('19000101' AS datetime) 
                      ELSE CAST(created_dttm AS datetime) END AS created_dttm, created_user_id, finalized_user_id, code, tariff, rs_class, rs_tariff, result, unusp, unusa, unusr, unusi, unusd, tm, rs_tariff2, tariff_sp, 
                      tariff_sr, tariff_si, tariff_sd, tariff_sa
FROM         OPENQUERY(INACBG_MYSQL, 'select * from xocp_ehr_cbg_result') AS xocp_ehr_cbg_result
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [xocp_ehr_cbg_result]");
    }
};
