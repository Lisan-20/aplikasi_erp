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
        DB::statement("CREATE OR ALTER VIEW dbo.ref_man_ok_v
AS
SELECT     CAST(CAST(RowNumber AS varchar) + ref AS varchar) AS kode_ref, RowNumber AS no_urut_periodik, ref, GETDATE() AS tgl_ref, 1 AS user_id, 
                      kodesupplier
FROM         dbo.referensi_man_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ref_man_ok_v]");
    }
};
