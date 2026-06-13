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
        DB::unprepared("CREATE proc [dbo].[fast_query_sp]
as 

SET NOCOUNT ON
CREATE TABLE #spins([Spinlock Name] varchar(50),Collisions numeric,Spins numeric,[Spins/Collision] float,[Sleep Time (ms)] numeric,Backoffs numeric, InsertTime datetime DEFAULT GETDATE())
DECLARE @counter int = 1
WHILE @counter < 10
      BEGIN
            INSERT INTO #spins ([Spinlock Name], Collisions, Spins, [Spins/Collision], [Sleep Time (ms)], Backoffs) EXECUTE ('DBCC SQLPERF (''SPINLOCKSTATS'') WITH NO_INFOMSGS')
            WAITFOR DELAY '00:00:05'
            SET @counter +=1
      END
SELECT * FROM #spins WHERE [Spinlock Name] = 'QUERY_EXEC_STATS' ORDER BY InsertTime
DROP TABLE #spins");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS fast_query_sp");
    }
};
