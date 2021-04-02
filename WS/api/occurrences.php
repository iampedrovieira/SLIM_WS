<?php

$app->get('/api/alloccurrences', function ($request, $response, array $args) {
    require_once('db/dbconnect.php');
 
    foreach($db->occurrence()
        as $row){
            $data[]=$row;
        };
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
});
?>