<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$result = DB::select("SELECT sys.objects.name AS constraint_name, sys.check_constraints.definition
FROM sys.check_constraints
INNER JOIN sys.objects ON sys.objects.object_id = sys.check_constraints.object_id
WHERE sys.objects.parent_object_id = OBJECT_ID('mt_erp_coa')");

print_r($result);
