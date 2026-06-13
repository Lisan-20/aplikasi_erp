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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[upd_billing_sp]
as
update upd_trans_pelayanan_v set flag_jurnal=1 where seri_kuitansi='RJ' and flag_jurnal=0 and kode_trans_pelayanan in (select kode_trans_pelayanan from tran_sed);
update upd_tran_kasir_v set flag_jurnal=1 where seri_kuitansi='RJ' and flag_jurnal=0 and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tran_kasir);
update upd_trans_pelayanan_v set flag_jurnal=1 where seri_kuitansi='RI' and flag_jurnal=0 and kode_trans_pelayanan in (select kode_trans_pelayanan from tran_sed);
update upd_tran_kasir_v set flag_jurnal=1 where seri_kuitansi='RI' and flag_jurnal=0 and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tran_kasir);
update upd_trans_pelayanan_v set flag_jurnal=1 where seri_kuitansi='AJ' and flag_jurnal=0 and kode_trans_pelayanan in (select kode_trans_pelayanan from tran_sed);
update upd_tran_kasir_v set flag_jurnal=1 where seri_kuitansi='AJ' and flag_jurnal=0 and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tran_kasir);
update upd_trans_pelayanan_v set flag_jurnal=1 where seri_kuitansi='AI' and flag_jurnal=0 and kode_trans_pelayanan in (select kode_trans_pelayanan from tran_sed where kode not in (31,32));
update upd_tran_kasir_v set flag_jurnal=1 where seri_kuitansi='AI' and flag_jurnal=0 and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tran_kasir where kode not in (31,32));
update upd_trans_pelayanan_v set flag_jurnal=1 where seri_kuitansi='NK' and flag_jurnal=0 and kode_trans_pelayanan in (select kode_trans_pelayanan from tran_sed);
update upd_tran_kasir_v set flag_jurnal=1 where seri_kuitansi='NK' and flag_jurnal=0 and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tran_kasir);

UPDATE tc_trans_pelayanan set flag_jurnal=1 WHERE kode_tc_trans_kasir in(select kode_tc_trans_kasir from tx_harian WHERE kel_jurnal=1 AND YEAR(tx_tgl)=YEAR(GETDATE()) AND tx_tipe='D');
UPDATE tc_trans_kasir set flag_jurnal=1 WHERE kode_tc_trans_kasir in(select kode_tc_trans_kasir from tx_harian WHERE kel_jurnal=1 AND YEAR(tx_tgl)=YEAR(GETDATE()) AND tx_tipe='D');

update tc_trans_jkn set status_ver=1 where status_ver=0 and tgl_ver is not null and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tran_kasir where (kode=7));
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS upd_billing_sp");
    }
};
