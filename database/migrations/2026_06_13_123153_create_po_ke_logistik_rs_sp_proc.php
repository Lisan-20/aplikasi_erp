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
CREATE OR ALTER PROCEDURE [dbo].[po_ke_logistik_rs_sp]

@id_po int,
@no_po varchar(50),
@user varchar(100)

as
--SET NOCOUNT ON;
--SET XACT_ABORT ON;
--BEGIN TRY
   --BEGIN TRANSACTION
	-- insert ke trans_co_header
	--INSERT INTO trans_co_header(no_pesanan,tgl_pesanan,kode_pelanggan,total_pesanan,diskon,ppn,biaya,keterangan,nama_pemesan,ttd,created_by)
	--SELECT @no_po as no_pesanan,GETDATE() as tgl_pesanan,'APTCKR' as kode_pelanggan,JmlHarga as total_pesanan,0 as diskon,0 as ppn,0 as biaya,term_of_pay as keterangan,@user as nama_pemesan,'daris.png' as ttd,'rsbh' as created_by
	--FROM list_po_rs_v WHERE id_tc_po=@id_po; 
	
	INSERT into openquery(MYSQL_LOGISTIK, 'select no_pesanan,tgl_pesanan,kode_pelanggan,total_pesanan,diskon,ppn,biaya,keterangan,nama_pemesan,ttd,created_by from trans_co_header')
	SELECT @no_po as no_pesanan,GETDATE() as tgl_pesanan,'APTCKR' as kode_pelanggan,JmlHarga as total_pesanan,0 as diskon,0 as ppn,0 as biaya,term_of_pay as keterangan,@user as nama_pemesan,'daris.png' as ttd,'rsbh' as created_by
	FROM list_po_rs_v WHERE id_tc_po=@id_po;
	--INSERT into openquery(MyServer, 'dbo.event_cast') values ('','');
	--INSERT into myserver.mydatabase.dbo.event_Cast values('','');
	

	--insert ke trans_co_detail
	--INSERT INTO trans_co_detail(no_pesanan,kode_produk,nama_produk,satuan,harga,diskon,qty)
	--SELECT @no_po as no_pesanan,kode_produk,nama_produk,satuan,harga,diskon,qty
	--FROM list_po_detail_rs_v WHERE id_tc_po=@id_po;

	INSERT into openquery(MYSQL_LOGISTIK, 'select no_pesanan,kode_produk,nama_produk,satuan,harga,diskon,qty from trans_co_detail')
	SELECT @no_po as no_pesanan,kode_produk,nama_produk,satuan,harga,diskon,qty
	FROM list_po_detail_rs_v WHERE id_tc_po=@id_po;
	
	--COMMIT

--END TRY
--BEGIN CATCH
  -- Determine if an error occurred.
  --IF @@TRANCOUNT > 0
     --ROLLBACK

  -- Return the error information.
  --DECLARE @ErrorMessage nvarchar(4000),  @ErrorSeverity int;
  --SELECT @ErrorMessage = ERROR_MESSAGE(),@ErrorSeverity = ERROR_SEVERITY();
  --RAISERROR(@ErrorMessage, @ErrorSeverity, 1);
--END CATCH;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS po_ke_logistik_rs_sp");
    }
};
