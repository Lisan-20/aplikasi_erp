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
        DB::statement("CREATE VIEW dbo.jurnal_selisih_bpjs_ri_v
AS
SELECT     dbo.v_jurnal_selisih_bpjs_ri.no, dbo.v_jurnal_selisih_bpjs_ri.tgl_masuk, dbo.v_jurnal_selisih_bpjs_ri.tgl_pulang, dbo.v_jurnal_selisih_bpjs_ri.no_mr, dbo.v_jurnal_selisih_bpjs_ri.nama_pasien, 
                      UPPER(dbo.v_jurnal_selisih_bpjs_ri.no_sep) AS no_sep, dbo.v_jurnal_selisih_bpjs_ri.kode_cbg, dbo.v_jurnal_selisih_bpjs_ri.topup, dbo.v_jurnal_selisih_bpjs_ri.total_tarif, 
                      dbo.v_jurnal_selisih_bpjs_ri.tarif_rs, dbo.v_jurnal_selisih_bpjs_ri.jenis, dbo.v_jurnal_selisih_bpjs_ri.bill_non_adm, CAST(dbo.v_jurnal_selisih_bpjs_ri.bill_non_adm * 5 / 100 AS int) AS adm, 
                      dbo.v_jurnal_selisih_bpjs_ri.bill_non_adm - dbo.v_jurnal_selisih_bpjs_ri.total_tarif AS selisih_non_adm, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.kode_bagian_keluar AS kode_bagian, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.no_induk, dbo.tc_registrasi.flag_jurnal, dbo.tc_registrasi.tgl_jam_keluar, CAST(dbo.v_jurnal_selisih_bpjs_ri.bill_non_adm * 0.20 AS int) 
                      + dbo.v_jurnal_selisih_bpjs_ri.bill_non_adm AS bill_plus_adm, CAST(dbo.v_jurnal_selisih_bpjs_ri.bill_non_adm * 0.20 AS int) 
                      + dbo.v_jurnal_selisih_bpjs_ri.bill_non_adm - dbo.v_jurnal_selisih_bpjs_ri.total_tarif AS selisih_lm, dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.seri_kuitansi, 
                      CAST(dbo.tc_trans_kasir.bill * 25 / 100 AS int) AS admin, dbo.tc_trans_kasir.bill - CAST(dbo.tc_trans_kasir.bill * 25 / 100 AS int) AS bill_n_adm, 
                      CAST((dbo.tc_trans_kasir.bill - CAST(dbo.tc_trans_kasir.bill * 25 / 100 AS int)) * 5 / 100 AS int) AS admi, dbo.tc_trans_kasir.bill - CAST(dbo.tc_trans_kasir.bill * 25 / 100 AS int) 
                      + CAST((dbo.tc_trans_kasir.bill - CAST(dbo.tc_trans_kasir.bill * 25 / 100 AS int)) * 5 / 100 AS int) AS billing, dbo.tc_trans_kasir.bill - CAST(dbo.tc_trans_kasir.bill * 25 / 100 AS int) 
                      + CAST((dbo.tc_trans_kasir.bill - CAST(dbo.tc_trans_kasir.bill * 25 / 100 AS int)) * 5 / 100 AS int) - dbo.v_jurnal_selisih_bpjs_ri.total_tarif AS selisih
FROM         dbo.v_jurnal_selisih_bpjs_ri INNER JOIN
                      dbo.tc_registrasi ON dbo.v_jurnal_selisih_bpjs_ri.no_sep = dbo.tc_registrasi.noSep INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi
WHERE     (dbo.v_jurnal_selisih_bpjs_ri.bill_non_adm > 0) AND (NOT (dbo.tc_registrasi.tgl_jam_keluar IS NULL)) AND (dbo.v_jurnal_selisih_bpjs_ri.total_tarif > 0) AND (dbo.tc_trans_kasir.seri_kuitansi = 'AI')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_selisih_bpjs_ri_v]");
    }
};
