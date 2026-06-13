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
        Schema::create('GrouperRestTemp', function (Blueprint $table) {
            $table->float('Kdrs', 53, 0)->nullable();
            $table->string('Klsrs')->nullable();
            $table->float('Norm', 53, 0)->nullable();
            $table->float('Klsrawat', 53, 0)->nullable();
            $table->float('TariffRS', 53, 0)->nullable();
            $table->float('Jnsrawat', 53, 0)->nullable();
            $table->dateTime('Tglmsk')->nullable();
            $table->dateTime('Tglklr')->nullable();
            $table->float('Los', 53, 0)->nullable();
            $table->dateTime('Tgllhr')->nullable();
            $table->float('UmurThn', 53, 0)->nullable();
            $table->float('UmurHari', 53, 0)->nullable();
            $table->float('JK', 53, 0)->nullable();
            $table->float('CaraPlg', 53, 0)->nullable();
            $table->string('Berat')->nullable();
            $table->string('Dutama')->nullable();
            $table->string('D1')->nullable();
            $table->string('D2')->nullable();
            $table->string('D3')->nullable();
            $table->string('D4')->nullable();
            $table->string('D5')->nullable();
            $table->string('D6')->nullable();
            $table->string('D7')->nullable();
            $table->string('D8')->nullable();
            $table->string('D9')->nullable();
            $table->string('D10')->nullable();
            $table->string('D11')->nullable();
            $table->string('D12')->nullable();
            $table->string('D13')->nullable();
            $table->string('D14')->nullable();
            $table->string('D15')->nullable();
            $table->string('D16')->nullable();
            $table->string('D17')->nullable();
            $table->string('D18')->nullable();
            $table->string('D19')->nullable();
            $table->string('D20')->nullable();
            $table->string('D21')->nullable();
            $table->string('D22')->nullable();
            $table->string('D23')->nullable();
            $table->dateTime('D24')->nullable();
            $table->dateTime('D25')->nullable();
            $table->string('D26')->nullable();
            $table->dateTime('D27')->nullable();
            $table->string('D28')->nullable();
            $table->string('D29')->nullable();
            $table->float('P1', 53, 0)->nullable();
            $table->float('P2', 53, 0)->nullable();
            $table->string('P3')->nullable();
            $table->string('P4')->nullable();
            $table->string('P5')->nullable();
            $table->string('P6')->nullable();
            $table->string('P7')->nullable();
            $table->string('P8')->nullable();
            $table->string('P9')->nullable();
            $table->string('P10')->nullable();
            $table->string('P11')->nullable();
            $table->string('P12')->nullable();
            $table->string('P13')->nullable();
            $table->string('P14')->nullable();
            $table->string('P15')->nullable();
            $table->string('P16')->nullable();
            $table->string('P17')->nullable();
            $table->string('P18')->nullable();
            $table->string('P19')->nullable();
            $table->string('P20')->nullable();
            $table->string('P21')->nullable();
            $table->string('P22')->nullable();
            $table->string('P23')->nullable();
            $table->string('P24')->nullable();
            $table->string('P25')->nullable();
            $table->string('P26')->nullable();
            $table->string('P27')->nullable();
            $table->string('P28')->nullable();
            $table->string('P29')->nullable();
            $table->string('P30')->nullable();
            $table->float('adl', 53, 0)->nullable();
            $table->float('Recid', 53, 0)->nullable();
            $table->string('Inacbg')->nullable();
            $table->string('Deskripsi')->nullable();
            $table->string('Tarif')->nullable();
            $table->string('SA')->nullable();
            $table->float('TarifSA', 53, 0)->nullable();
            $table->string('SP')->nullable();
            $table->string('DescSP')->nullable();
            $table->float('TarifSP', 53, 0)->nullable();
            $table->string('SR')->nullable();
            $table->string('DescSR')->nullable();
            $table->float('TarifSR', 53, 0)->nullable();
            $table->string('SI')->nullable();
            $table->string('DescSI')->nullable();
            $table->float('TarifSI', 53, 0)->nullable();
            $table->string('SD')->nullable();
            $table->string('DescSD')->nullable();
            $table->float('TarifSD', 53, 0)->nullable();
            $table->float('TotalTarif', 53, 0)->nullable();
            $table->string('NamaPasien')->nullable();
            $table->string('DPJP')->nullable();
            $table->string('SEP')->nullable();
            $table->string('Rujukan')->nullable();
            $table->string('PengesahanSL3')->nullable();
            $table->string('VersiINACBG')->nullable();
            $table->string('C1')->nullable();
            $table->float('C2', 53, 0)->nullable();
            $table->string('C3')->nullable();
            $table->string('F105')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('GrouperRestTemp');
    }
};
