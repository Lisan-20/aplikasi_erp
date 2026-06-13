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
create proc linked_srv_mysql

as 

--EXEC master.dbo.sp_addlinkedserver @server='MYSQL_LOGISTIK', @srvproduct='MySQL',
--@provider='MSDASQL', @provstr='DRIVER={MySQL ODBC 5.3 ANSI Driver};SERVER=192.168.1.1;Port=3306;USER=root;PASSWORD=23021982;OPTION=3;DATABASE=logistik;';

--select * from openquery(MYSQL_LOGISTIK,'select * from trans_co_header order by no_pesanan desc');");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS linked_srv_mysql");
    }
};
