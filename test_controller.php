<?php

use App\Http\Controllers\Kasir\AntrianLoketController;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

try {
    $request = Request::create('/kasir/checkout', 'POST', [
        'items' => [
            ['kode_brg' => 'K02003034', 'qty' => 1, 'harga_jual' => 10000],
        ],
        'tunai' => 10000,
        'kredit' => 0,
        'debet' => 0,
        'adm_cc' => 0,
        'diskon' => 0,
        'diskon_pers' => 0,
        'bill' => 10000,
    ]);

    // Bind session
    Session::put('no_induk', '12345');

    $controller = new AntrianLoketController;
    $response = $controller->checkout($request);

    echo $response->getContent();
} catch (Exception $e) {
    echo 'Exception: '.$e->getMessage()."\n".$e->getTraceAsString();
}
