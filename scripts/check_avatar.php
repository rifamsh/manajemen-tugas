<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$u = User::find(1);
echo "user id=1 avatar: ";
var_export($u->avatar);
echo PHP_EOL;

$dir = __DIR__ . '/../storage/app/public/avatars';
if (is_dir($dir)) {
    echo "files in storage/app/public/avatars:\n";
    $files = scandir($dir);
    foreach ($files as $f) {
        if ($f === '.' || $f === '..') continue;
        echo " - $f\n";
    }
} else {
    echo "avatars dir not found: $dir\n";
}
