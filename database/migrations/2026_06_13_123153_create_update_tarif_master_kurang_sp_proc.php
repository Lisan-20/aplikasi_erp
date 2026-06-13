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

CREATE PROCEDURE [dbo].[update_tarif_master_kurang_sp]
AS
BEGIN
 
declare @kode_bagian_cari varchar(6);
declare @persen int;
set @kode_bagian_cari = (select kode_bagian_update from tbl_update_tarif where flag is null);
set @persen =  (select persen from tbl_update_tarif where flag is null);


update update_tarif_master_v set bill_rs=bill_rs-(bill_rs*@persen/100) where kode_bagian=@kode_bagian_cari and tingkatan=5 and bill_rs>0;
update update_tarif_master_v set bill_dr1=bill_dr1-(bill_dr1*@persen/100) where kode_bagian=@kode_bagian_cari and tingkatan=5 and bill_dr1>0;
update update_tarif_master_v set bill_dr2=bill_dr2-(bill_dr2*@persen/100) where kode_bagian=@kode_bagian_cari and tingkatan=5 and bill_dr2>0;
update update_tarif_master_v set total=total-(total*@persen/100) where kode_bagian=@kode_bagian_cari and tingkatan=5 and total>0;
update update_tarif_master_v set alat_rs=alat_rs-(alat_rs*@persen/100) where kode_bagian=@kode_bagian_cari and tingkatan=5 and alat_rs>0;
update update_tarif_master_v set marketing=marketing-(marketing*@persen/100) where kode_bagian=@kode_bagian_cari and tingkatan=5 and marketing>0;
update update_tarif_master_v set bhp=bhp-(bhp*@persen/100) where kode_bagian=@kode_bagian_cari and tingkatan=5 and bhp>0;
update update_tarif_master_v set pendapatan_rs=pendapatan_rs-(pendapatan_rs*@persen/100) where kode_bagian=@kode_bagian_cari and tingkatan=5 and pendapatan_rs>0;
update update_tarif_master_v set reagen=reagen-(reagen*@persen/100) where kode_bagian=@kode_bagian_cari and tingkatan=5 and reagen>0;
update update_tarif_master_v set paramedis=paramedis-(paramedis*@persen/100) where kode_bagian=@kode_bagian_cari and tingkatan=5 and paramedis>0;
update tbl_update_tarif set flag=1 where flag is null;
END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS update_tarif_master_kurang_sp");
    }
};
