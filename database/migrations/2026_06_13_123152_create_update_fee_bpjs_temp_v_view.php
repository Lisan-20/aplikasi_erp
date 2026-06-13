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
        DB::statement("CREATE VIEW dbo.update_fee_bpjs_temp_v
AS
SELECT        dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.bill, dbo.tc_registrasi.plafon_bpjs, dbo.fee_dokter_rajal_temp.nama_tindakan, 
                         dbo.fee_dokter_rajal_temp.tgl_kuitansi, dbo.fee_dokter_rajal_temp.jumlah, dbo.fee_dokter_rajal_temp.kode_dr, dbo.fee_dokter_rajal_temp.flag_sppu, 
                         dbo.fee_dokter_rajal_temp.id_fee_dr_rj_temp, dbo.fee_dokter_rajal_temp.kode_kelompok, 
                         CASE WHEN plafon_bpjs > bill THEN '55000' ELSE '50000' END AS fee_bpjs, dbo.fee_dokter_rajal_temp.no_sppu, dbo.fee_dokter_rajal_temp.tahun
FROM            dbo.tc_registrasi INNER JOIN
                         dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi INNER JOIN
                         dbo.fee_dokter_rajal_temp ON dbo.tc_trans_kasir.no_registrasi = dbo.fee_dokter_rajal_temp.no_registrasi
WHERE        (dbo.fee_dokter_rajal_temp.kode_dr = 207) AND (dbo.fee_dokter_rajal_temp.flag_sppu IS NULL) AND (NOT (dbo.fee_dokter_rajal_temp.kode_kelompok IN (1)))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_fee_bpjs_temp_v]");
    }
};
