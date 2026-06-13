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
        DB::statement("CREATE OR ALTER VIEW dbo.upg_kobag_kasir_v
AS
SELECT     TOP (100) PERCENT dbo.tran_kasir.kode_tc_trans_kasir, dbo.tran_kasir.kode_bagian, dbo.tran_sed.kode_bagian AS kode_bagian2, 
                      dbo.tran_sed.kode_bagian_asal
FROM         dbo.tran_kasir INNER JOIN
                      dbo.tran_sed ON dbo.tran_kasir.kode_tc_trans_kasir = dbo.tran_sed.kode_tc_trans_kasir
WHERE     (dbo.tran_kasir.flag_jurnal IS NULL) AND (dbo.tran_kasir.kode_tc_trans_kasir IN (8152, 8188, 8196, 8206, 8251, 8261, 8258, 8260, 8257, 8278, 8276, 8277, 8325, 
                      8368, 8382, 8385, 8443, 8438, 8451, 8441, 8442, 8475, 8477, 8476, 8488, 8530, 8557, 8590, 8589, 8643, 8684, 8730, 8757, 7767, 8954, 8964, 9217, 8521, 8519, 9104, 
                      7464, 7580, 7651, 7683, 7669, 7698, 7741, 7744, 7771, 7788, 7816, 7817, 7847, 7850, 7848, 7849, 7856, 7861, 7913, 7899, 7924, 7922, 7926, 7928, 7936, 7963, 8004, 
                      8071))
ORDER BY dbo.tran_kasir.kode_tc_trans_kasir
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upg_kobag_kasir_v]");
    }
};
