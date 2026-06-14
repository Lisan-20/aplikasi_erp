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
        if (Schema::hasTable('hsl_angket_budaya_kesehatan_kerja')) {
            return;
        }

        Schema::create('hsl_angket_budaya_kesehatan_kerja', function (Blueprint $table) {
            $table->increments('id');
            $table->text('bagian')->nullable();
            $table->text('optradio1')->nullable();
            $table->text('optradio2')->nullable();
            $table->text('optradio3')->nullable();
            $table->text('optradio4')->nullable();
            $table->text('optradio5')->nullable();
            $table->text('optradio6')->nullable();
            $table->text('optradio7')->nullable();
            $table->text('optradio8')->nullable();
            $table->text('optradio9')->nullable();
            $table->text('optradio10')->nullable();
            $table->text('optradio11')->nullable();
            $table->text('optradio12')->nullable();
            $table->text('optradio13')->nullable();
            $table->text('optradio14')->nullable();
            $table->text('optradio15')->nullable();
            $table->text('optradio16')->nullable();
            $table->text('optradio17')->nullable();
            $table->text('optradio18')->nullable();
            $table->text('optradio19')->nullable();
            $table->text('optradio20')->nullable();
            $table->text('optradio21')->nullable();
            $table->text('optradio22')->nullable();
            $table->text('optradio23')->nullable();
            $table->text('optradio24')->nullable();
            $table->text('optradio25')->nullable();
            $table->text('optradio26')->nullable();
            $table->text('optradio27')->nullable();
            $table->text('optradio28')->nullable();
            $table->text('optradio29')->nullable();
            $table->text('optradio30')->nullable();
            $table->text('optradio31')->nullable();
            $table->text('optradio32')->nullable();
            $table->text('optradio33')->nullable();
            $table->text('optradio34')->nullable();
            $table->text('optradio35')->nullable();
            $table->text('optradio36')->nullable();
            $table->text('optradio37')->nullable();
            $table->text('optradio38')->nullable();
            $table->text('optradio39')->nullable();
            $table->text('optradio40')->nullable();
            $table->text('optradio41')->nullable();
            $table->text('optradio42')->nullable();
            $table->text('optradio43')->nullable();
            $table->text('optradio44')->nullable();
            $table->text('optradio45')->nullable();
            $table->text('optradio46')->nullable();
            $table->text('optradio47')->nullable();
            $table->text('optradio48')->nullable();
            $table->text('optradio49')->nullable();
            $table->text('optradio50')->nullable();
            $table->text('komentar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hsl_angket_budaya_kesehatan_kerja');
    }
};
