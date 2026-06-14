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
        DB::statement("CREATE OR ALTER VIEW dbo.cm_v
AS
SELECT     dbo.cm.M_MR, dbo.cm.M_NAMA, dbo.cm.M_NAMAKK, dbo.cm.M_IBUKDG, dbo.cm.M_ALM, dbo.cm.M_ALM1, dbo.cm.M_RT, dbo.cm.M_RW, dbo.cm.M_DESA, dbo.cm.M_KEC, dbo.cm.M_TGLH, 
                      dbo.cm.M_KOTA, dbo.cm.M_TELP, dbo.cm.M_TELP2, dbo.cm.M_JK, dbo.cm.M_JKERJA, dbo.cm.M_DIDIK, dbo.cm.M_AGAMA, dbo.cm.M_SUKU, dbo.cm.M_BANGSA, dbo.cm.M_SUAMI, 
                      dbo.cm.M_KELUH, dbo.cm.M_UMSUAMI, dbo.cm.M_JSUAMI, dbo.cm.M_AJSUAMI, dbo.cm.M_TKSUAMI, dbo.cm.M_NMOR, dbo.cm.M_NOLAMA, dbo.cm.M_KET, dbo.cm.M_GUDANG, 
                      dbo.mt_master_pasien.no_mr
FROM         dbo.cm LEFT OUTER JOIN
                      dbo.mt_master_pasien ON dbo.cm.M_MR = dbo.mt_master_pasien.no_mr
WHERE     (dbo.mt_master_pasien.no_mr IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cm_v]");
    }
};
