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
        DB::statement("CREATE VIEW dbo.upd_harga_beli_bhp_v
AS
SELECT     dbo.tran_sed.no_registrasi, dbo.tran_sed.no_kunjungan, dbo.tran_sed.no_mr, dbo.tran_sed.seri_kuitansi, dbo.tran_sed.no_kuitansi, dbo.tran_sed.tx_nominal, 
                      dbo.tran_sed.jumlah, dbo.tran_sed.jenis_tindakan, dbo.tran_sed.nama_tindakan, dbo.tran_sed.harga_beli, dbo.tran_sed.kode, YEAR(dbo.tran_sed.tgl_jam) AS tahun, 
                      dbo.tc_trans_pelayanan.harga_beli AS harga
FROM         dbo.tran_sed INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tran_sed.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan
WHERE     (dbo.tran_sed.jenis_tindakan = 9) AND (dbo.tran_sed.harga_beli IS NULL) AND (YEAR(dbo.tran_sed.tgl_jam) >= 2014)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_harga_beli_bhp_v]");
    }
};
