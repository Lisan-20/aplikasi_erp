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
        DB::statement("CREATE OR ALTER VIEW dbo.fee_dokter_temp_v
AS
SELECT    nama_pasien,kode_dr,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_kuitansi,kode_bagian,nama_tindakan,flag_sppu,jumlah,kode_trans_pelayanan
FROM    fee_dokter_rj_umum_temp
union     
select  nama_pasien,kode_dr,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_kuitansi,kode_bagian,nama_tindakan,flag_sppu,jumlah,kode_trans_pelayanan

from fee_dokter_rj_PT_temp
union 
select  nama_pasien,kode_dr,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_kuitansi,kode_bagian,nama_tindakan,flag_sppu,jumlah,kode_trans_pelayanan
 from fee_dokter_rj_asuransi_temp
union
select  nama_pasien,kode_dr,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_kuitansi,kode_bagian,nama_tindakan,flag_sppu,jumlah,kode_trans_pelayanan
 from fee_dokter_bpjs_temp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_dokter_temp_v]");
    }
};
