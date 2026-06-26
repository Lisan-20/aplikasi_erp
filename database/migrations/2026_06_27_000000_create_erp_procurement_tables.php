<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Chart of Accounts (Kas/Bank)
        Schema::create('mt_erp_coa', function (Blueprint $table) {
            $table->id();
            $table->string('kode_akun', 20)->unique();
            $table->string('nama_akun', 100);
            $table->integer('level')->default(1);
            $table->foreignId('parent_id')->nullable()->constrained('mt_erp_coa');
            $table->enum('tipe_akun', ['D', 'K'])->default('D')->comment('D=Debit, K=Kredit');
            $table->string('kategori', 50)->nullable(); // Asset, Liability, Equity, Revenue, Expense
            $table->boolean('is_kas_bank')->default(false); // Penanda apakah ini rekening pencairan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Permintaan Pembelian (PR)
        Schema::create('tc_erp_pr', function (Blueprint $table) {
            $table->id();
            $table->string('no_pr', 50)->unique();
            $table->dateTime('tgl_pr');
            $table->integer('status')->default(0)->comment('0=Draft, 1=Diajukan, 2=Diproses PO, 3=Batal');
            $table->integer('user_id')->nullable(); // id_dd_user
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('tc_erp_pr_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pr_id')->constrained('tc_erp_pr')->onDelete('cascade');
            $table->string('kode_brg', 50); // -> mt_barang_jasa
            $table->integer('qty_minta');
            $table->integer('qty_po')->default(0); // Berapa yg sudah dipesan ke PO
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        // 3. Purchase Order (PO)
        Schema::create('tc_erp_po', function (Blueprint $table) {
            $table->id();
            $table->string('no_po', 50)->unique();
            $table->dateTime('tgl_po');
            $table->unsignedBigInteger('supplier_id')->nullable(); // dari mt_erp_supplier
            $table->decimal('ppn_persen', 5, 2)->default(0);
            $table->decimal('ppn_nominal', 15, 2)->default(0);
            $table->decimal('diskon_nominal', 15, 2)->default(0);
            $table->decimal('total_sbl_ppn', 15, 2)->default(0);
            $table->decimal('total_stl_ppn', 15, 2)->default(0);
            $table->integer('status')->default(0)->comment('0=Penerbitan, 1=ACC Manajemen, 2=Revisi, 3=Batal, 4=Selesai');
            $table->dateTime('tgl_acc')->nullable();
            $table->integer('acc_by')->nullable(); // id_dd_user manajemen
            $table->integer('user_id')->nullable(); // id_dd_user pembuat PO
            $table->string('keterangan_revisi')->nullable();
            $table->timestamps();
        });

        Schema::create('tc_erp_po_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('po_id')->constrained('tc_erp_po')->onDelete('cascade');
            $table->foreignId('pr_detail_id')->nullable()->constrained('tc_erp_pr_detail');
            $table->string('kode_brg', 50);
            $table->integer('qty_pesan');
            $table->integer('qty_terima')->default(0);
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('diskon', 15, 2)->default(0);
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
        });

        // 4. Penerimaan Barang (GR)
        Schema::create('tc_erp_penerimaan', function (Blueprint $table) {
            $table->id();
            $table->string('no_penerimaan', 50)->unique();
            $table->string('no_faktur_supplier', 100);
            $table->foreignId('po_id')->constrained('tc_erp_po');
            $table->dateTime('tgl_terima');
            $table->integer('user_id')->nullable(); // Petugas Gudang
            $table->integer('status_tukar_faktur')->default(0)->comment('0=Belum, 1=Sudah (Masuk AP Invoice)');
            $table->timestamps();
        });

        Schema::create('tc_erp_penerimaan_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerimaan_id')->constrained('tc_erp_penerimaan')->onDelete('cascade');
            $table->foreignId('po_detail_id')->constrained('tc_erp_po_detail');
            $table->string('kode_brg', 50);
            $table->integer('qty_terima');
            $table->decimal('harga_satuan', 15, 2);
            $table->timestamps();
        });

        // 5. Tukar Faktur (AP Invoice)
        Schema::create('tc_erp_tukar_faktur', function (Blueprint $table) {
            $table->id();
            $table->string('no_tukar_faktur', 50)->unique();
            $table->dateTime('tgl_tukar_faktur');
            $table->unsignedBigInteger('supplier_id');
            $table->decimal('total_tagihan', 15, 2);
            $table->dateTime('jatuh_tempo')->nullable();
            $table->integer('status_pembayaran')->default(0)->comment('0=Belum, 1=Verifikasi, 2=Lunas');
            $table->integer('user_id')->nullable(); // Akunting
            $table->timestamps();
        });

        Schema::create('tc_erp_tukar_faktur_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tukar_faktur_id')->constrained('tc_erp_tukar_faktur')->onDelete('cascade');
            $table->foreignId('penerimaan_id')->constrained('tc_erp_penerimaan');
            $table->timestamps();
        });

        // 6 & 7. Pembayaran Supplier (Payment)
        Schema::create('tc_erp_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('no_pembayaran', 50)->unique();
            $table->dateTime('tgl_pembayaran');
            $table->unsignedBigInteger('supplier_id');
            $table->foreignId('akun_kas_id')->nullable()->constrained('mt_erp_coa');
            $table->decimal('total_bayar', 15, 2);
            $table->integer('status_verifikasi')->default(0)->comment('0=Draft, 1=ACC Manajemen');
            $table->integer('verified_by')->nullable();
            $table->dateTime('tgl_verifikasi')->nullable();
            $table->integer('user_id')->nullable(); // Kasir
            $table->timestamps();
        });

        Schema::create('tc_erp_pembayaran_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembayaran_id')->constrained('tc_erp_pembayaran')->onDelete('cascade');
            $table->foreignId('tukar_faktur_id')->constrained('tc_erp_tukar_faktur');
            $table->decimal('nominal_bayar', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_erp_pembayaran_detail');
        Schema::dropIfExists('tc_erp_pembayaran');
        Schema::dropIfExists('tc_erp_tukar_faktur_detail');
        Schema::dropIfExists('tc_erp_tukar_faktur');
        Schema::dropIfExists('tc_erp_penerimaan_detail');
        Schema::dropIfExists('tc_erp_penerimaan');
        Schema::dropIfExists('tc_erp_po_detail');
        Schema::dropIfExists('tc_erp_po');
        Schema::dropIfExists('tc_erp_pr_detail');
        Schema::dropIfExists('tc_erp_pr');
        Schema::dropIfExists('mt_erp_coa');
    }
};
