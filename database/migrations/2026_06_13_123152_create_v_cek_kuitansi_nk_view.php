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
        DB::statement("CREATE VIEW dbo.v_cek_kuitansi_nk
AS
SELECT     kode_tc_trans_kasir, no_registrasi, nk_perusahaan, seri_kuitansi, no_kuitansi, no_induk, debet, tunai, kredit, tunai + debet + kredit AS jml_tunai
FROM         dbo.tc_trans_kasir
WHERE     (nk_perusahaan > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_cek_kuitansi_nk]");
    }
};
