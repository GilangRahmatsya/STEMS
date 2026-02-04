<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$user = \App\Models\User::where('email', 'rahmatsyag@gmail.com')->first();
if ($user) {
    $user->role = 'admin';
    $user->save();
    echo "✓ User {$user->email} is now an admin\n";
} else {
    echo "✗ User rahmatsyag@gmail.com not found\n";
}
