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
        DB::unprepared("CREATE OR ALTER PROCEDURE insert_mysql_sp
as
--SET NOCOUNT ON;
--SET XACT_ABORT OFF;
--BEGIN TRY
--	BEGIN TRANSACTION

	INSERT into openquery(MYSQL, 'select no_pesanan, tgl_pesanan, kode_pelanggan, total_pesanan, diskon, ppn, biaya, keterangan, nama_pemesan, ttd, created_by from trans_co_header') SELECT 'PO/CS/1603/0050' as no_pesanan, GETDATE() as tgl_pesanan, 'APTCKR' as kode_pelanggan, JmlHarga as total_pesanan, 0 as diskon, 0 as ppn, 0 as biaya, term_of_pay as keterangan, 'Sudarisman' as nama_pemesan, 'daris.png' as ttd, 'rsbh' as created_by FROM list_po_rs_v WHERE id_tc_po=3;

--	COMMIT

--END TRY
--BEGIN CATCH
  -- Determine if an error occurred.
--  IF @@TRANCOUNT > 0
--     ROLLBACK

  -- Return the error information.
  --DECLARE @ErrorMessage nvarchar(4000),  @ErrorSeverity int;
  --SELECT @ErrorMessage = ERROR_MESSAGE(),@ErrorSeverity = ERROR_SEVERITY();
  --RAISERROR(@ErrorMessage, @ErrorSeverity, 1);
--END CATCH;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS insert_mysql_sp");
    }
};
