<?php
require __DIR__ . '/../src/Framework/App.php';

use Framework\App\App;

$app = new App();

$app->add_route('/register', function () {
    echo '<h2>Test</h2>';
});

$app->add_route('/', function () {
    echo '<h2>Testowa</h2>';
});

$app->add_route('/post/{id}', function ($id) {
    echo '<h2>Post ' . $id . ' </h2>';
});


$app->run();
