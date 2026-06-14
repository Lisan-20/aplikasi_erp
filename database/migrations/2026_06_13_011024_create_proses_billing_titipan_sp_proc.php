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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[proses_billing_titipan_sp]

@kode_klas_jatah as int,
@no_registrasi as int
--@kode_kelompok as int
as
--backup billing ke asli
UPDATE tc_trans_pelayanan SET jatah_klas=@kode_klas_jatah WHERE no_registrasi=@no_registrasi;
UPDATE proses_billing_titipan_v set bill_rs_asli=bill_rs,bill_dr1_asli=bill_dr1,bill_dr2_asli=bill_dr2 where no_registrasi=@no_registrasi;
UPDATE proses_billing_bedah_titipan_v set bill_rs_asli=bill_rs,bill_dr1_asli=bill_dr1,bill_dr2_asli=bill_dr2 where no_registrasi=@no_registrasi;

--if(@kode_kelompok>=8)
	--begin
	--ubah billing ke jatah kelasnya
	UPDATE proses_billing_titipan_v set bill_rs=tarif_rs,bill_dr1=tarif_dr1,bill_dr2=tarif_dr2 where no_registrasi=@no_registrasi AND jatah_klas=@kode_klas_jatah;
	UPDATE proses_billing_bedah_titipan_v set bill_rs=tarif_rs,bill_dr1=tarif_dr1,bill_dr2=tarif_dr2 where no_registrasi=@no_registrasi AND jatah_klas=@kode_klas_jatah;
	--end
--else if(@kode_kelompok <8)
	--begin	
	--ubah billing ke jatah kelasnya
	--UPDATE proses_billing_titipan_v set bill_rs=tarif_rs,bill_dr1=tarif_dr1,bill_dr2=tarif_dr2 where no_registrasi=@no_registrasi AND kelas_tarif=@kode_klas_jatah;
	--UPDATE proses_billing_bedah_titipan_v set bill_rs=tarif_rs,bill_dr1=tarif_dr1,bill_dr2=tarif_dr2 where no_registrasi=@no_registrasi AND kelas_tarif=@kode_klas_jatah;
	--end
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS proses_billing_titipan_sp");
    }
};
