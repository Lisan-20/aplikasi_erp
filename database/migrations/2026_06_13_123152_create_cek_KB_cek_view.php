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
        DB::statement("CREATE VIEW dbo.cek_KB_cek
AS
SELECT     dbo.cek_KB_debet.debet, dbo.cek_KB_kredit.kredit, dbo.cek_KB_kredit.id_bd_tc_trans, dbo.cek_KB_debet.id_bd_tc_trans AS Expr1
FROM         dbo.cek_KB_debet INNER JOIN
                      dbo.cek_KB_kredit ON dbo.cek_KB_debet.id_bd_tc_trans = dbo.cek_KB_kredit.id_bd_tc_trans AND dbo.cek_KB_debet.debet = dbo.cek_KB_kredit.kredit AND 
                      dbo.cek_KB_debet.no_bukti = dbo.cek_KB_kredit.no_bukti
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_KB_cek]");
    }
};
