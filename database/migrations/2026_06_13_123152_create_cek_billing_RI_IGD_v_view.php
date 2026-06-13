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
        DB::statement("CREATE VIEW dbo.cek_billing_RI_IGD_v
AS
SELECT     dbo.cek_pelayanan_v.no_registrasi, dbo.cek_pelayanan_igd_v.no_kunjungan, dbo.cek_pelayanan_igd_v.kode_bagian, dbo.cek_pelayanan_igd_v.no_registrasi AS reg_igd, 
                      dbo.cek_pelayanan_igd_v.no_registrasi2, dbo.cek_pelayanan_v.status_selesai
FROM         dbo.cek_pelayanan_igd_v INNER JOIN
                      dbo.cek_pelayanan_v ON dbo.cek_pelayanan_igd_v.no_registrasi2 = dbo.cek_pelayanan_v.no_registrasi
WHERE     (dbo.cek_pelayanan_v.status_selesai <= 2)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_billing_RI_IGD_v]");
    }
};
