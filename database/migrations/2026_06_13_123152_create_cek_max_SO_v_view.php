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
        DB::statement("CREATE VIEW dbo.cek_max_SO_v
AS
SELECT     TOP (100) PERCENT a.kode_brg, MAX(a.id_tc_stok_opname) AS id_tc_stok_opname, c.kode_bagian, c.nama_bagian, MONTH(a.tgl_stok_opname) AS bln, YEAR(a.tgl_stok_opname) AS thn
FROM         dbo.tc_stok_opname AS a INNER JOIN
                      dbo.mt_karyawan_user_v AS b ON a.id_dd_user = b.id_dd_user INNER JOIN
                      dbo.mt_bagian AS c ON a.kode_bagian = c.kode_bagian INNER JOIN
                      dbo.mt_barang AS d ON a.kode_brg = d.kode_brg
GROUP BY a.kode_brg, c.kode_bagian, c.nama_bagian, MONTH(a.tgl_stok_opname), YEAR(a.tgl_stok_opname)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_max_SO_v]");
    }
};
