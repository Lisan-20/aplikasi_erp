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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[update_sep_temp]
@no_sep as varchar(20),
@no_mr as varchar(6),
@kode_cbg as varchar(50),
@total_tarif as int,
@tarif_rs as int,
@jenis as varchar(2)
as
DECLARE @cek_sep INT
SET @cek_sep =(select count(no_sep) from tc_sep_ri_temp where no_sep=@no_sep);
--print @cek_sep;
--print @no_mr;
IF (@cek_sep='' or @cek_sep=0)

BEGIN
insert into tc_sep_ri_temp(no,tgl_masuk,tgl_pulang,no_mr,nama_pasien,no_sep,kode_cbg,topup,total_tarif,tarif_rs,jenis)
select top(1)no,tgl_masuk,tgl_pulang,no_mr,nama_pasien,no_sep,kode_cbg,topup,total_tarif,tarif_rs,jenis
from upload_sep_temp where no_mr=@no_mr and no_sep=@no_sep;
END
ELSE
BEGIN
update tc_sep_ri_temp set kode_cbg=@kode_cbg,total_tarif=@total_tarif,tarif_rs=@tarif_rs,jenis=@jenis where no_mr=@no_mr and no_sep=@no_sep;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS update_sep_temp");
    }
};
