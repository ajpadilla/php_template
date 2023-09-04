<?php

//use Symfony\Component\Debug\Debug;
use \Template\Php\Infrastructure\Ui\Web\Silex\Application;
use Template\Php\Domain\Model\User;
use Template\Php\Domain\Model\Question;
use Template\Php\Infrastructure\Persistence\Eloquent\Database;
use \Template\Php\Container;

error_reporting(E_ALL);

require_once __DIR__ . '/../../../../../../../vendor/autoload.php';

define('VIEW_PATH', __DIR__.'/../../../../../../views');


//new Database();
session_start();
//phpinfo();

$container = new Container();

$container->set(\Template\Php\Services\PaymentGatewayServiceInterface::class, fn(Container $c)=> $c->get(\Template\Php\Services\PaymentGatewayService::class));

$router = new \Template\Php\Router($container);

/*$container->set(Template\Php\Services\InvoiceService::class, function (Container $c){
    return new \Template\Php\Services\InvoiceService($c->get(\Template\Php\Services\EmailService::class));
});

$container->set(\Template\Php\Services\EmailService::class, fn() => new \Template\Php\Services\EmailService());*/

/*try {
    $container->get(\Template\Php\Services\InvoiceService::class)->process(["a"], 25);
} catch (\Psr\Container\NotFoundExceptionInterface $e) {
    echo $e->getMessage();
} catch (ReflectionException $e) {
} catch (\Template\Php\Exception\ContainerException $e) {
    echo $e->getMessage();
}*/



$router->get('/', [\Template\Php\Controllers\Home::class, 'index']);
$router->get('/invoices', [\Template\Php\Controllers\Invoice::class, 'index']);
$router->get('/invoices/create', [\Template\Php\Controllers\Invoice::class, 'create']);
$router->post('/invoices/create', [\Template\Php\Controllers\Invoice::class, 'store']);

try {
    echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
} catch (\Template\Php\Exception\RouteNotFoundException $e) {
    echo $e->getMessage();
}

var_dump($_SESSION);