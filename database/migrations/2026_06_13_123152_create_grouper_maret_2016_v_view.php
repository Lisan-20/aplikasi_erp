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
        DB::statement("CREATE OR ALTER VIEW dbo.grouper_maret_2016_v
AS
SELECT     Kdrs, Klsrs, Norm, Klsrawat, TariffRS, Jnsrawat, Tglmsk, Tglklr, Los, Tgllhr, UmurThn, UmurHari, JK, CaraPlg, Berat, Dutama, D1, D2, D3, D4, D5, D6, D7, D8, D9, D10, D11, D12, D13, D14, D15, D16, 
                      D17, D18, D19, D20, D21, D22, D23, D24, D25, D26, D27, D28, D29, P1, P2, P3, P4, P5, P6, P7, P8, P9, P10, P11, P12, P13, P14, P15, P16, P17, P18, P19, P20, P21, P22, P23, P24, P25, P26, P27, 
                      P28, P29, P30, adl, Recid, Inacbg, Deskripsi, Tarif, SA, TarifSA, SP, DescSP, TarifSP, SR, DescSR, TarifSR, SI, DescSI, TarifSI, SD, DescSD, TarifSD, TotalTarif, NamaPasien, DPJP, SEP, Rujukan, 
                      PengesahanSL3, VersiINACBG, C1, C2, C3, F105, LEFT(SEP, 19) AS NoSep, RIGHT(SEP, 13) AS NoPeserta
FROM         dbo.GROUPER_MAR_2016
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [grouper_maret_2016_v]");
    }
};
