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
        DB::statement("CREATE VIEW dbo.piutang_list_bayar_v
AS
SELECT     a.id_tc_tagih, a.no_invoice_tagih, a.jenis_tagih, a.tgl_tagih, a.jumlah_tagih AS jumlah_tagih_b, a.diskon, a.nama_tertagih, a.id_tertagih, a.id_dd_user, a.tgl_input, a.tgl_jt_tempo, a.tgl_ver, 
                      a.status_ver, a.no_invoice, a.no_urut, a.tahun, a.periode_1, a.periode_2, a.jenis_pasien, a.status_batal, a.tgl_batal, a.user_batal, a.diskon_bayar, a.keterangan_non_rs, a.keterangan_tolak, 
                      CASE WHEN b.jumlah_transaksi IS NULL THEN 0 ELSE b.jumlah_transaksi END AS jumlah_transaksi, a.jumlah_tagih + CASE WHEN b.jumlah_transaksi IS NULL 
                      THEN 0 ELSE b.jumlah_transaksi END AS jumlah_tagih
FROM         dbo.tc_tagih AS a LEFT OUTER JOIN
                      dbo.luar_modul_bayar_v AS b ON a.id_tc_tagih = b.id_tc_tagih
WHERE     (a.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [piutang_list_bayar_v]");
    }
};
