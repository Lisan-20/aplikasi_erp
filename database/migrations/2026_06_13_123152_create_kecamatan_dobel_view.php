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
        DB::statement("CREATE VIEW dbo.kecamatan_dobel
AS
SELECT     nama_kelurahan, COUNT(nama_kelurahan) AS Expr1, MAX(id_dc_kelurahan) AS id_dc_kelurahan
FROM         dbo.dc_kelurahan
GROUP BY nama_kelurahan
HAVING      (COUNT(nama_kelurahan) > 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kecamatan_dobel]");
    }
};
