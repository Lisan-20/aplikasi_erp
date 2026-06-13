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
        DB::statement("CREATE OR ALTER VIEW dbo.potongan_dr_igd_v
AS
SELECT     TOP (100) PERCENT ROW_NUMBER() OVER (PARTITION BY dbo.fee_dokter_rj_ri2_v.tgl,dbo.fee_dokter_rj_ri2_v.bln, dbo.fee_dokter_rj_ri2_v.kode_dr
ORDER BY kode_kelompok DESC) AS no, dbo.fee_dokter_rj_ri2_v.tgl, dbo.fee_dokter_rj_ri2_v.bln, dbo.tc_jadwal_dokter_v.thn, dbo.fee_dokter_rj_ri2_v.kode_dr, 
dbo.tc_jadwal_dokter_v.kode_bagian, dbo.tc_jadwal_dokter_v.kode_jadwal, dbo.fee_dokter_rj_ri2_v.kode_trans_pelayanan, dbo.fee_dokter_rj_ri2_v.nama_tindakan, 
dbo.fee_dokter_rj_ri2_v.no_sppu, dbo.fee_dokter_rj_ri2_v.flag_sppu, dbo.fee_dokter_rj_ri2_v.tahun, dbo.fee_dokter_rj_ri2_v.jumlah, dbo.fee_dokter_rj_ri2_v.kode_kelompok, 
dbo.fee_dokter_rj_ri2_v.tgl_transaksi, dbo.fee_dokter_rj_ri2_v.seri_kuitansi
FROM         dbo.tc_jadwal_dokter_v INNER JOIN
                      dbo.fee_dokter_rj_ri2_v ON dbo.tc_jadwal_dokter_v.tgl = dbo.fee_dokter_rj_ri2_v.tgl AND dbo.tc_jadwal_dokter_v.bln = dbo.fee_dokter_rj_ri2_v.bln AND 
                      dbo.tc_jadwal_dokter_v.thn = dbo.fee_dokter_rj_ri2_v.thn AND dbo.tc_jadwal_dokter_v.kode_dokter = dbo.fee_dokter_rj_ri2_v.kode_dr
GROUP BY dbo.fee_dokter_rj_ri2_v.tgl, dbo.fee_dokter_rj_ri2_v.bln, dbo.tc_jadwal_dokter_v.thn, dbo.fee_dokter_rj_ri2_v.kode_dr, dbo.tc_jadwal_dokter_v.kode_bagian, 
                      dbo.tc_jadwal_dokter_v.kode_jadwal, dbo.fee_dokter_rj_ri2_v.kode_trans_pelayanan, dbo.fee_dokter_rj_ri2_v.nama_tindakan, dbo.fee_dokter_rj_ri2_v.no_sppu, 
                      dbo.fee_dokter_rj_ri2_v.flag_sppu, dbo.fee_dokter_rj_ri2_v.tahun, dbo.fee_dokter_rj_ri2_v.jumlah, dbo.fee_dokter_rj_ri2_v.kode_kelompok, 
                      dbo.fee_dokter_rj_ri2_v.tgl_transaksi, dbo.fee_dokter_rj_ri2_v.seri_kuitansi
HAVING      (dbo.tc_jadwal_dokter_v.kode_jadwal = '3') AND (dbo.fee_dokter_rj_ri2_v.flag_sppu IS NULL) AND (dbo.fee_dokter_rj_ri2_v.nama_tindakan LIKE 'Pem Dokter%') AND (dbo.fee_dokter_rj_ri2_v.nama_tindakan NOT LIKE 'Pem Dokter IGD Pagi') AND (dbo.fee_dokter_rj_ri2_v.seri_kuitansi in ('RJ','AJ')) ORDER BY dbo.fee_dokter_rj_ri2_v.kode_kelompok DESC 
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [potongan_dr_igd_v]");
    }
};
