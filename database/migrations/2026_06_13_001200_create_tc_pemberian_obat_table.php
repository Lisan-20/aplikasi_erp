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
        if (Schema::hasTable('tc_pemberian_obat')) {
            return;
        }

        Schema::create('tc_pemberian_obat', function (Blueprint $table) {
            $table->integer('id_pemberian_obat');
            $table->text('cara_pemberian')->nullable();
            $table->dateTime('jam')->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('kode_brg', 50)->nullable();
            $table->text('dosis')->nullable();
            $table->text('ifvd')->nullable();
            $table->dateTime('jam_psg_ifvd')->nullable();
            $table->dateTime('jam_hbs_ifvd')->nullable();

            $table->primary(['id_pemberian_obat'], 'pk_tc_pemebrian_obat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemberian_obat');
    }
};
