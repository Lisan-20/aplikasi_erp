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
        DB::statement("CREATE OR ALTER VIEW dbo.fee_asisten_penata_bedah_v
AS
SELECT        dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_pelayanan.tgl_transaksi, 
                         dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_bagian, 
                         dbo.tc_trans_pelayanan.kode_klas, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.flag_param1, dbo.tc_trans_pelayanan.flag_param2, dbo.tc_trans_pelayanan.flag_param3, 
                         dbo.tc_trans_pelayanan.kode_paramedis, dbo.tc_trans_pelayanan.kode_paramedis2, dbo.tc_trans_pelayanan.kode_paramedis3, dbo.tc_trans_pelayanan.no_urut, dbo.tc_trans_kasir.kode_tc_trans_kasir, 
                         dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.status_batal, 
                         dbo.tc_trans_kasir.status_batal AS Expr1, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_registrasi.plafon_bpjs
FROM            dbo.tc_trans_kasir INNER JOIN
                         dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                         dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE        (dbo.tc_trans_pelayanan.no_urut IN (5)) AND (dbo.tc_trans_kasir.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_asisten_penata_bedah_v]");
    }
};
