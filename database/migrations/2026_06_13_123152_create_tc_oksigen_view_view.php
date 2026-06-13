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
        DB::statement("CREATE VIEW dbo.tc_oksigen_view
AS
SELECT     dbo.tc_oksigen.no_mr, dbo.tc_oksigen.no_registrasi, dbo.tc_oksigen.tgl_transaksi, dbo.tc_oksigen.jam, dbo.tc_oksigen.liter, dbo.tc_oksigen.harga_trans, dbo.mt_master_pasien.nama_pasien
FROM         dbo.tc_oksigen INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_oksigen.no_mr = dbo.mt_master_pasien.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_oksigen_view]");
    }
};
