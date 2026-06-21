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
        DB::statement("CREATE OR ALTER VIEW dbo.xocp_persons
AS
SELECT     person_id, ssn, ext_id, person_nm, parent_nm, birth_dttm, birthplace, metaphone_nm, adm_gender_cd, addr_txt, regional_cd, zip_cd, telecom, religion_cd, blood_t, marital_st, education, jobclass, 
                      job_addr, nationality_nm, race_nm, status_cd, del_ind, mortal_ind, created_by, pkorder_nm, mpi_person_id
FROM         OPENQUERY(INACBG_MYSQL, 'select * from xocp_persons') AS xocp_persons
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [xocp_persons]");
    }
};
