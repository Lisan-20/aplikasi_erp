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
        DB::unprepared("
CREATE OR ALTER PROCEDURE reduce_log_file_sp
@name_db varchar(200),
@name_logical varchar(200),
@space int

 AS
BACKUP LOG @name_db WITH NO_LOG;
DBCC SHRINKFILE (@name_logical,@space);
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS reduce_log_file_sp");
    }
};
