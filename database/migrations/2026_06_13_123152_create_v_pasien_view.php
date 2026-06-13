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
        DB::statement("CREATE VIEW dbo.v_pasien
AS
SELECT     TOP (100) PERCENT M_MR AS no_mr, M_NAMA AS nama_pasien, M_NAMAKK, M_IBUKDG, M_ALM, M_ALM1, M_RT, M_RW, M_DESA, M_KEC, M_TGLH AS tgl_lhr, M_KOTA, M_TELP, M_TELP2, 
                      M_JK, M_JKERJA, M_DIDIK, M_AGAMA, M_SUKU, M_BANGSA, M_SUAMI, M_KELUH, M_UMSUAMI, M_JSUAMI, M_AJSUAMI, M_TKSUAMI, M_TGRJ, M_TGRI, M_NMOR, M_NOLAMA, M_KET, 
                      M_GUDANG
FROM         dbo.cm
ORDER BY no_mr DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_pasien]");
    }
};
