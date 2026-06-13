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
        DB::unprepared("create proc [proses_SEP_sp]

@query varchar(max)

as
set ansi_nulls on
set ansi_warnings on

INSERT INTO GROUPER_INACBG_REST (NoSep, NoPeserta, NoMr, TglMasuk, TglKeluar, no_mr, JenisRawat, KelasRawat, StayInd, TotalTarif, Tarif, Inacbg) SELECT payplan_attr2 as NoSep, 0 as NoPeserta, patient_ext_id as NoMr, admission_dttm as TglMasuk, discharge_dttm as TglKeluar, patient_ext_id as no_mr, 0 as JenisRawat, kelas_rawat as KelasRawat, stay_ind as StayInd, tariff as Tarif, real_cost as TotalTarif, code as Inacbg FROM OPENQUERY(INACBG_MYSQL, 'SELECT f.admission_dttm, f.discharge_dttm, TIME(f.discharge_dttm) as jam, a.admission_id, a.patient_id, b.patient_ext_id, c.person_nm, a.code, a.tariff, e.person_nm as nama_pasien, a.status_cd, f.stay_ind, f.real_cost, f.payplan_attr2, f.kelas_rawat FROM xocp_ehr_cbg_result a LEFT JOIN xocp_ehr_patient b USING(patient_id) LEFT JOIN xocp_persons c USING(person_id) LEFT JOIN xocp_users d ON d.user_id = a.finalized_user_id LEFT JOIN xocp_persons e ON e.person_id = d.person_id LEFT JOIN xocp_ehr_patient_admission f ON f.patient_id = a.patient_id AND f.admission_id = a.admission_id WHERE f.discharge_dt >= DATE(''2016-08-10'') AND f.discharge_dt <= DATE(''2016-08-19'') AND a.status_cd = ''final'' AND f.payplan_id = ''5'' AND f.stay_ind = ''n'' ')   ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS proses_SEP_sp");
    }
};
