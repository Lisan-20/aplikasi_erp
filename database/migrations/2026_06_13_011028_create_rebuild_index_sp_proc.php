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
CREATE OR ALTER PROCEDURE rebuild_index_sp

as 
--USE rsbh_live --Enter the name of the database you want to reindex

DECLARE @TableName varchar(255)

DECLARE TableCursor CURSOR FOR 
SELECT table_name FROM information_schema.tables 
WHERE table_type = 'base table'

OPEN TableCursor

FETCH NEXT FROM TableCursor INTO @TableName 
WHILE @@FETCH_STATUS = 0 
BEGIN 
DBCC DBREINDEX(@TableName,' ',90) 
FETCH NEXT FROM TableCursor INTO @TableName 
END

CLOSE TableCursor

DEALLOCATE TableCursor");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS rebuild_index_sp");
    }
};
