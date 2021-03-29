<?php

$app->get('/hello/{name}', function ($request, $response, array $args) {
    $name = $args['name'];
    
    $response->getBody()->write("Hello, $name");
    return $response;
});


?>