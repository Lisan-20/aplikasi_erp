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
        DB::statement("CREATE OR ALTER VIEW dbo.bd_tc_hutang_dr_all_v
AS
SELECT     dbo.bd_tc_hutang_dr.id_bd_tc_hutang_dr, dbo.bd_tc_hutang_dr.kode_dokter, dbo.bd_tc_hutang_dr.no_voucher, dbo.bd_tc_hutang_dr.tgl_pembentukan, dbo.bd_tc_hutang_dr.nominal, 
                      dbo.bd_tc_hutang_dr.id_input, dbo.bd_tc_hutang_dr.status_lunas, dbo.bd_tc_hutang_dr.periode_tgl_awal, dbo.bd_tc_hutang_dr.periode_tgl_akhir, dbo.bd_tc_hutang_dr.potongan_pajak, 
                      dbo.bd_tc_hutang_dr.no_sppu, dbo.bd_tc_hutang_dr.tahun, dbo.bd_tc_hutang_dr.flag_ass, dbo.bd_tc_hutang_dr.flag_pt, dbo.bd_tc_hutang_dr.flag_umum, dbo.bd_tc_hutang_dr.flag_jamkesmas, 
                      dbo.bd_tc_hutang_dr.flag_sktm, dbo.bd_tc_hutang_dr.flag_jampersal, dbo.bd_tc_hutang_dr.no_bukti, dbo.bd_tc_hutang_dr.potongan, dbo.bd_tc_hutang_dr.total_kuitansi, 
                      dbo.bd_tc_hutang_dr.tgl_ver, dbo.bd_tc_hutang_dr.status_ver, dbo.bd_tc_hutang_dr.rj_ri, dbo.bd_tc_hutang_dr.flag_bpjs, dbo.bd_tc_hutang_dr.kode_slip, dbo.bd_tc_hutang_dr.flag_ver, 
                      dbo.bd_tc_hutang_dr.flag_op, dbo.bd_tc_hutang_dr.flag_bidan, dbo.bd_tc_hutang_dr.flag_paramedis, dbo.bd_tc_hutang_dr.kode_paramedis, dbo.bd_tc_hutang_dr.flag_sitting, 
                      dbo.bd_tc_hutang_dr.id_bd_tc_bayar_dr_kol, dbo.bd_tc_hutang_dr.insentif_dr, dbo.mt_karyawan.nama_pegawai AS paramedis, mt_karyawan_1.nama_pegawai AS dokter
FROM         dbo.bd_tc_hutang_dr LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.bd_tc_hutang_dr.kode_paramedis = dbo.mt_karyawan.kode_paramedis LEFT OUTER JOIN
                      dbo.mt_karyawan AS mt_karyawan_1 ON dbo.bd_tc_hutang_dr.kode_dokter = mt_karyawan_1.kode_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bd_tc_hutang_dr_all_v]");
    }
};
