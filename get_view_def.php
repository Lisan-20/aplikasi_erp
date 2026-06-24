<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$result = Illuminate\Support\Facades\DB::select("EXEC sp_helptext 'user_karyawan_v'");
foreach($result as $row) {
    echo $row->Text;
}
