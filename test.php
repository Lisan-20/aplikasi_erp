<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$data = \Illuminate\Support\Facades\DB::table('mt_bagian')->take(3)->get();
print_r($data->toArray());
