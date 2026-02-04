<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$item = \App\Models\Item::first();
if ($item) {
    echo "Item ID: " . $item->id . "\n";
    echo "Item name: " . $item->name . "\n";
    echo "Item category_id: " . $item->category_id . "\n";
    
    try {
        echo "Testing relationship with(): ";
        $result = \App\Models\Item::with('category')->first();
        echo "✓ Success\n";
    } catch (\Exception $e) {
        echo "✗ Error: " . $e->getMessage() . "\n";
    }
} else {
    echo "No items in database\n";
}
