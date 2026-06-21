<?php

use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();
echo json_encode(DB::table('app_submenu')->whereIn('link_submenu', ['/gudang/permintaan-pembelian', '/pengadaan/po', '/manajemen/acc-purchasing', '/gudang/penerimaan'])->get());
