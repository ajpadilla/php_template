<?php

namespace  Template\Php\Infrastructure\Ui\Web\Silex;

class Application {

  public static function bootstrap() {

    $app = new \Silex\Application();

    $app['debug'] = true;
    $app['gamify_host'] = '127.0.0.1';
    $app['gamify_port'] = '8080';

    return $app;
  }

}
