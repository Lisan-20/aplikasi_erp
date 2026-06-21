<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

try {
    DB::statement('ALTER TABLE tc_trans_kasir ADD uang_diterima money NULL, uang_kembali money NULL');
    echo 'Success adding columns';
} catch (Exception $e) {
    echo 'Error: '.$e->getMessage();
}
