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
        DB::statement("CREATE VIEW dbo.xocp_users
AS
SELECT     user_id, person_id, user_nm, pwd0, pwd1, language, avatar, regdate, icq, viewemail, aim, yim, msnm, startpage, user_theme, theme, sig, attachsig, tz_offset, popmsgon, last_login, pgroup_id, 
                      status_cd, last_org_id, last_page_id, cur_ses_id
FROM         OPENQUERY(INACBG_MYSQL, 'SELECT * from xocp_users') AS xocp_users
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [xocp_users]");
    }
};
