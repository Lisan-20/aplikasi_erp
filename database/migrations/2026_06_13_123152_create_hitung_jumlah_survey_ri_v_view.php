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
        DB::statement("
CREATE VIEW [dbo].[hitung_jumlah_survey_ri_v]
AS
SELECT     optradio1, optradio2, optradio3, optradio4, optradio5, optradio6, optradio7, optradio8, optradio9, optradio10, optradio11, COUNT(optradio1) AS jawaban1, COUNT(optradio2) AS jawaban2, 
                      COUNT(optradio3) AS jawaban3, COUNT(optradio4) AS jawaban4, COUNT(optradio5) AS jawaban5, COUNT(optradio6) AS jawaban6, COUNT(optradio7) AS jawaban7, COUNT(optradio8) AS jawaban8, 
                      COUNT(optradio9) AS jawaban9, COUNT(optradio10) AS jawaban10, COUNT(optradio11) AS jawaban11, id
FROM         dbo.hsl_angket_ri
GROUP BY optradio1, optradio2, optradio3, optradio4, optradio5, optradio6, optradio7, optradio8, optradio9, optradio10, optradio11, id

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hitung_jumlah_survey_ri_v]");
    }
};
