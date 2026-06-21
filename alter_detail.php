<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();
DB::statement('ALTER TABLE tc_trans_kasir_detail ADD qty_retur float NULL DEFAULT 0, status_retur int NULL DEFAULT 0');
echo 'Altered successfully';
