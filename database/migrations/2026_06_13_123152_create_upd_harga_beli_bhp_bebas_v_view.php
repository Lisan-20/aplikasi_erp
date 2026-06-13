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
        DB::statement("CREATE VIEW dbo.upd_harga_beli_bhp_bebas_v
AS
SELECT     dbo.tran_sed_bebas.no_registrasi, dbo.tran_sed_bebas.no_kunjungan, dbo.tran_sed_bebas.no_mr, dbo.tran_sed_bebas.seri_kuitansi, dbo.tran_sed_bebas.no_kuitansi, 
                      dbo.tran_sed_bebas.tx_nominal, dbo.tran_sed_bebas.jumlah, dbo.tran_sed_bebas.jenis_tindakan, dbo.tran_sed_bebas.nama_tindakan, dbo.tran_sed_bebas.harga_beli, dbo.tran_sed_bebas.kode, 
                      YEAR(dbo.tran_sed_bebas.tgl_jam) AS tahun, dbo.tc_trans_pelayanan.harga_beli AS harga
FROM         dbo.tran_sed_bebas INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tran_sed_bebas.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan
WHERE     (dbo.tran_sed_bebas.jenis_tindakan = 9) AND (dbo.tran_sed_bebas.harga_beli IS NULL) AND (YEAR(dbo.tran_sed_bebas.tgl_jam) >= 2014)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_harga_beli_bhp_bebas_v]");
    }
};
