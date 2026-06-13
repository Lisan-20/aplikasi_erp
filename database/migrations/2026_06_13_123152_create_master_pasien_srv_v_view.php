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
        DB::statement("CREATE VIEW dbo.master_pasien_srv_v
AS
SELECT     NOPASIEN, no_mr, kode_agama, gol_darah, kode_pendidikan, kode_perusahaan, nama_pasien, tempat_lahir, tgl_lhr, jen_kelamin, status_perkaw, almt_ttp_pasien, tlp_almt_ttp, id_dc_propinsi, 
                      id_dc_kota, kota, kelurahan, kecamatan, kode_pos, pekerjaan, nama_almt_kantor, TLPPEKERJA, alergi, nama_kel_ter, nik, nama_almt_kel, ALM2PGJWB, HUBPGJWB, NOTANGPAS, TGLAKHRS, 
                      UNITAKHRS, WARGANEGARA, kebangsaan, RETENSI, nama_panggilan, KODEJBT, KDGRPTRF, STSPASIEN, NOPASIENHISTORY, KODEPT1, NOPOLIS, TGLAWALRS, PHOTO, BARCODE, HDKUNJKE, 
                      HDKUNJ1ST, KUNJFIS, NMKANTOR, DOKTERHD, DX, HBBSAG, TGLEDITSTS, FLAGRAUDHAH, UNITAWAL, no_ktp, PJMSTS, KDPKRJAAN, TGLKUNJA, UNITKUNJA, ICDKUNJA, id_dc_kelurahan, 
                      id_dc_kecamatan, nama_perusahaan, agama
FROM         SERVER.dbmds2.dbo.master_pasien_v AS master_pasien_v_1
WHERE     (NOT (kode_perusahaan LIKE '%UMUM%'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [master_pasien_srv_v]");
    }
};
