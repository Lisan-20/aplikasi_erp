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
        DB::statement("CREATE VIEW dbo.v_cek_obat_retur
AS
SELECT     dbo.v_cek_obat_retur_1.*
FROM         dbo.v_cek_obat_retur_1 INNER JOIN
                      dbo.v_cek_obat_retur_2 ON dbo.v_cek_obat_retur_1.kode_tc_trans_kasir = dbo.v_cek_obat_retur_2.kode_tc_trans_kasir AND 
                      dbo.v_cek_obat_retur_1.no_registrasi = dbo.v_cek_obat_retur_2.no_registrasi AND dbo.v_cek_obat_retur_1.no_mr = dbo.v_cek_obat_retur_2.no_mr AND 
                      dbo.v_cek_obat_retur_1.jenis_tindakan = dbo.v_cek_obat_retur_2.jenis_tindakan AND 
                      dbo.v_cek_obat_retur_1.kode_barang = dbo.v_cek_obat_retur_2.kode_barang AND 
                      dbo.v_cek_obat_retur_1.kode_trans_far = dbo.v_cek_obat_retur_2.kode_trans_far AND dbo.v_cek_obat_retur_1.kd_tr_resep = dbo.v_cek_obat_retur_2.kd_tr_resep
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_cek_obat_retur]");
    }
};
