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
        DB::statement("CREATE OR ALTER VIEW dbo.query_bulan_sebelumnya_v
AS
SELECT     TOP (1) MONTH(login_time) AS bln, YEAR(login_time) AS thn
FROM         dbo.log_user_login
WHERE     (login_time >= DATEADD(MONTH, - 6, GETDATE()))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [query_bulan_sebelumnya_v]");
    }
};
