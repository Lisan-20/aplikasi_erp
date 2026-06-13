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
        DB::statement("CREATE VIEW dbo.fee_dokter_temp_union_v
AS
SELECT     *  
FROM         fee_dokter_rajal_temp
union 
select *
from fee_dokter_rinap_temp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_dokter_temp_union_v]");
    }
};
