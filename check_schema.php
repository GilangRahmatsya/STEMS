<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$db = \Illuminate\Support\Facades\DB::connection();
$columns = $db->getSchemaBuilder()->getColumnListing('items');
echo "Items table columns:\n";
foreach ($columns as $col) {
    echo "  - $col\n";
}
