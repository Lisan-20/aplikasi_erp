<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$submenus = \Illuminate\Support\Facades\DB::select("SELECT id_dc_sub_menu, nama_sub_menu, url_sub_menu FROM dc_sub_menu WHERE nama_sub_menu LIKE '%Loket%'");
echo json_encode($submenus, JSON_PRETTY_PRINT);
