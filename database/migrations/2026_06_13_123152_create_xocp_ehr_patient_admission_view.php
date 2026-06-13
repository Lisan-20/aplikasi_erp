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
        DB::statement("CREATE OR ALTER VIEW dbo.xocp_ehr_patient_admission
AS
SELECT     CASE WHEN discharge_dttm LIKE '0000-%' THEN CAST('19000101' AS datetime) ELSE CAST(discharge_dttm AS datetime) END AS discharge_dttm, stay_ind, real_cost
FROM         OPENQUERY(INACBG_MYSQL, 'select * from xocp_ehr_patient_admission') AS xocp_ehr_patient_admission_1
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [xocp_ehr_patient_admission]");
    }
};
