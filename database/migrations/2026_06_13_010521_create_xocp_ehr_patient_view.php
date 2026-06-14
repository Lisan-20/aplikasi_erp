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
        DB::statement("CREATE OR ALTER VIEW dbo.xocp_ehr_patient
AS
SELECT     patient_id, patient_ext_id, status_cd, vip_cd, confidentiality_cd, person_id, mrview_classes, CASE WHEN created_dttm LIKE '0000-%' THEN CAST('19000101' AS datetime) 
                      ELSE CAST(created_dttm AS datetime) END AS created_dttm, account_id, created_by, mpi_patient_id
FROM         OPENQUERY(INACBG_MYSQL, 'select * from xocp_ehr_patient') AS xocp_ehr_patient
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [xocp_ehr_patient]");
    }
};
