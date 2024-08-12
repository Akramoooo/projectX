<?php
require '../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Public\Controllers\IndexController;
use Aura\SqlQuery\QueryFactory;
use League\Plates\Engine;

$queryFactory = new QueryFactory('sqlite');


$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    PDO::class => function () {
        return new PDO('mysql:host=mysql;dbname=ProjectX', 'root', 'akramatik');
    },
    QueryFactory::class => function () {
        return new QueryFactory('mysql');
    },
    IndexController::class => \DI\create()
    ->constructor(\DI\get(PDO::class), \DI\get(QueryFactory::class), \DI\get(Engine::class)),
    Engine::class =>function () {
        return new Engine("../public/Views");
    }
]);

$container = $containerBuilder->build();


AppFactory::setContainer($container);
$app = AppFactory::create();

// Определяем маршруты
$app->get('/', [IndexController::class, 'index']);
$app->get('/about', [IndexController::class, 'about']);


// COMMUNICATE WITH JAVASCRIPT
$app->post('/get-category', [IndexController::class, 'getCategory']);
$app->post('/search', [IndexController::class, 'search']);



$app->run();
