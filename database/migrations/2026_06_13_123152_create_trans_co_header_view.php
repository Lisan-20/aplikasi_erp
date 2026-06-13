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
        DB::statement("CREATE VIEW dbo.trans_co_header
AS
SELECT     id, no_pesanan, tgl_pesanan, kode_pelanggan, total_pesanan, diskon, ppn, biaya, keterangan, nama_pemesan, ttd, created_by, status
FROM         OPENQUERY(LOGISTIK, 'select * from trans_co_header') AS trans_co_header
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [trans_co_header]");
    }
};
