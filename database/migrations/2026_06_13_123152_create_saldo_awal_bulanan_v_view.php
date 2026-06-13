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
        DB::statement("CREATE VIEW dbo.saldo_awal_bulanan_v
AS
SELECT     dbo.saldo_awal_bulanan.no_saldo_bln, dbo.saldo_awal_bulanan.tahun, dbo.saldo_awal_bulanan.bulan, dbo.saldo_awal_bulanan.saldo_awal, dbo.saldo_awal_bulanan.[level], 
                      dbo.saldo_awal_bulanan.flag, dbo.saldo_awal_bulanan.acc_type, dbo.saldo_awal_bulanan.tx_tipe, dbo.saldo_awal_bulanan.tgl_input, dbo.saldo_awal_bulanan.kode_bagian, dbo.Bank_v.acc_no, 
                      dbo.Bank_v.id_bank, dbo.Bank_v.acc_nama
FROM         dbo.Bank_v LEFT OUTER JOIN
                      dbo.saldo_awal_bulanan ON dbo.Bank_v.acc_no = dbo.saldo_awal_bulanan.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [saldo_awal_bulanan_v]");
    }
};
