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
        DB::statement("CREATE VIEW dbo.tagihan_gabung_v
AS
SELECT     dbo.tc_tagih.id_tc_tagih, dbo.tc_tagih.no_invoice_tagih, dbo.tc_tagih.jenis_tagih, dbo.tc_tagih.tgl_tagih, dbo.tc_tagih.jumlah_tagih AS tagihan, dbo.tc_tagih.diskon, 
                      dbo.mt_perusahaan_tagih_v.nama_perusahaan AS nama_tertagih, dbo.tc_tagih.id_tertagih, dbo.tc_tagih.id_dd_user, dbo.tc_tagih.tgl_input, dbo.tc_tagih.tgl_jt_tempo, dbo.tc_tagih.tgl_ver, 
                      dbo.tc_tagih.status_ver, dbo.tc_tagih.no_invoice, dbo.tc_tagih.no_urut, dbo.tc_tagih.tahun, dbo.tc_tagih.periode_1, dbo.tc_tagih.periode_2, dbo.tc_tagih.jenis_pasien, dbo.tc_tagih.status_batal, 
                      dbo.tc_tagih.tgl_batal, dbo.tc_tagih.user_batal, dbo.tc_tagih.diskon_bayar, dbo.piutang_manual_v.jumlah, CASE WHEN dbo.piutang_manual_v.jumlah IS NULL 
                      THEN 0 ELSE jumlah END + dbo.tc_tagih.jumlah_tagih AS jumlah_tagih
FROM         dbo.tc_tagih INNER JOIN
                      dbo.mt_perusahaan_tagih_v ON dbo.tc_tagih.id_tertagih = dbo.mt_perusahaan_tagih_v.kode_perusahaan LEFT OUTER JOIN
                      dbo.piutang_manual_v ON dbo.tc_tagih.id_tc_tagih = dbo.piutang_manual_v.id_tc_tagih
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_gabung_v]");
    }
};
