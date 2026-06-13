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
        DB::statement("CREATE VIEW dbo.update_bpjs_v
AS
SELECT     dbo.tc_registrasi.kode_kelompok AS kode, dbo.fee_dokter_rinap_temp.kode_kelompok
FROM         dbo.fee_dokter_bpjs_temp INNER JOIN
                      dbo.fee_dokter_rinap_temp ON dbo.fee_dokter_bpjs_temp.no_registrasi = dbo.fee_dokter_rinap_temp.no_registrasi AND 
                      dbo.fee_dokter_bpjs_temp.kode_trans_pelayanan = dbo.fee_dokter_rinap_temp.kode_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.fee_dokter_bpjs_temp.no_registrasi = dbo.tc_registrasi.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bpjs_v]");
    }
};
