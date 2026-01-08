<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Storage;

$rel = 'avatars/Ms4SVvdOFPJj2zNwa8f6cZHvlQn1kusKz0qTQLb3.jpg';
$url = Storage::disk('public')->url($rel);
echo "storage url: $url\n";
$publicPath = __DIR__ . '/../public' . $url;
echo "public path: $publicPath\n";
echo "exists: " . (file_exists($publicPath) ? 'yes' : 'no') . "\n";
