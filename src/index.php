<?php

declare(strict_types=1);

require __DIR__ . '/autoload.php';

use App\Exceptions\NotFound;
use App\Exceptions\ServerError;

$ctrl = $_GET['ctrl'] ?? 'Index';

$class = '\\App\Controllers\\' . $ctrl;

if(!class_exists($class)) {
    die('Страницы не существует');
}

try {
    $controller = new $class;
    $controller();
} catch(NotFound $ex) {
    http_response_code(404);
} catch(ServerError $ex) {
    http_response_code(500);
} catch(Throwable $ex) {
    die('Неизвестная ошибка');
}