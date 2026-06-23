<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$sample = DB::table('mt_barang_jasa')->limit(5)->get();
echo json_encode($sample, JSON_PRETTY_PRINT);
