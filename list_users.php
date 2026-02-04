<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$users = \App\Models\User::all();
echo "Users in database:\n";
foreach ($users as $user) {
    echo "  - {$user->email} (Role: {$user->role})\n";
}

if ($users->isEmpty()) {
    echo "No users found\n";
}
