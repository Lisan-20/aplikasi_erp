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
        DB::statement("CREATE OR ALTER VIEW dbo.pelayanan_upd_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_tarif AS Expr1, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.tgl_transaksi, 
                      dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_pelayanan.bill_rs + dbo.tc_trans_pelayanan.bill_dr1 AS total_sementara, dbo.tc_trans_pelayanan.bill_dr2, dbo.tc_trans_pelayanan.kode_dokter1, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tarif_honordr_bpjs.kode_kls, dbo.tarif_honordr_bpjs.nama_tindakan, dbo.tarif_honordr_bpjs.kode_tarif, dbo.tarif_honordr_bpjs.total, 
                      dbo.tarif_honordr_bpjs.dr, dbo.tarif_honordr_bpjs.rs
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tarif_honordr_bpjs ON dbo.tc_trans_pelayanan.kode_tarif = dbo.tarif_honordr_bpjs.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.kode_kelompok IN (8, 9)) AND (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.kode_dokter1 = '853') AND 
                      (dbo.tc_trans_pelayanan.jenis_tindakan IN (4, 12))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pelayanan_upd_v]");
    }
};
