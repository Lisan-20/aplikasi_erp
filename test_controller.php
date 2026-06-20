<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $request = \Illuminate\Http\Request::create('/kasir/checkout', 'POST', [
        'items' => [
            ['kode_brg' => 'K02003034', 'qty' => 1, 'harga_jual' => 10000]
        ],
        'tunai' => 10000,
        'kredit' => 0,
        'debet' => 0,
        'adm_cc' => 0,
        'diskon' => 0,
        'diskon_pers' => 0,
        'bill' => 10000
    ]);
    
    // Bind session
    \Illuminate\Support\Facades\Session::put('no_induk', '12345');

    $controller = new \App\Http\Controllers\Kasir\AntrianLoketController();
    $response = $controller->checkout($request);
    
    echo $response->getContent();
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n" . $e->getTraceAsString();
}
