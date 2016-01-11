<?php
use Cake\Routing\Router;

Router::plugin('Exchange', function ($routes) {
    $routes->fallbacks('InflectedRoute');
});
