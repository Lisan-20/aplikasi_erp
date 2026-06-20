<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    \Illuminate\Support\Facades\DB::statement('ALTER TABLE tc_trans_kasir ADD uang_diterima money NULL, uang_kembali money NULL');
    echo "Success adding columns";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
