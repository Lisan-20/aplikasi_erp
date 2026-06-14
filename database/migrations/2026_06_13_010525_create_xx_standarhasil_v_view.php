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
        DB::statement("CREATE OR ALTER VIEW dbo.xx_standarhasil_v
AS
SELECT     dbo.xx_mister.*, dbo.xx_standarhasil.kode_mt_hasilpm, dbo.xx_standarhasil.standar_hasil_wanita, dbo.xx_standarhasil.standar_hasil_pria, 
                      dbo.xx_standarhasil.standar_kesimpulan, dbo.xx_standarhasil.standar_kesan
FROM         dbo.xx_mister INNER JOIN
                      dbo.xx_standarhasil ON dbo.xx_mister.kode_tarif = dbo.xx_standarhasil.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [xx_standarhasil_v]");
    }
};
