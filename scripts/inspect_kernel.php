<?php
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
echo get_class($kernel)."\n";
$reflect = new ReflectionObject($kernel);
$prop = $reflect->getProperty('routeMiddleware');
$prop->setAccessible(true);
print_r($prop->getValue($kernel));
