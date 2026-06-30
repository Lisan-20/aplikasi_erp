if (!\Illuminate\Support\Facades\Schema::hasTable('tc_erp_jurnal_header')) {
    \Illuminate\Support\Facades\Schema::create('tc_erp_jurnal_header', function (\Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->string('no_jurnal', 50)->unique();
        $table->date('tgl_jurnal');
        $table->string('keterangan', 255);
        $table->string('referensi', 100)->nullable();
        $table->decimal('total_debit', 18, 2)->default(0);
        $table->decimal('total_kredit', 18, 2)->default(0);
        $table->integer('id_dd_user')->nullable(); // user pembuat
        $table->timestamps();
    });
    echo "tc_erp_jurnal_header created.\n";
} else {
    echo "tc_erp_jurnal_header already exists.\n";
}

if (!\Illuminate\Support\Facades\Schema::hasTable('tc_erp_jurnal_detail')) {
    \Illuminate\Support\Facades\Schema::create('tc_erp_jurnal_detail', function (\Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->foreignId('id_jurnal_header')->constrained('tc_erp_jurnal_header')->onDelete('cascade');
        $table->bigInteger('id_coa'); // Mengacu pada mt_erp_coa
        $table->decimal('debit', 18, 2)->default(0);
        $table->decimal('kredit', 18, 2)->default(0);
        $table->string('keterangan_detail', 255)->nullable();
    });
    echo "tc_erp_jurnal_detail created.\n";
} else {
    echo "tc_erp_jurnal_detail already exists.\n";
}
