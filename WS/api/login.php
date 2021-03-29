<?php

$app->post('/api/login', function ($request, $response, array $args) {
    require_once('db/dbconnect.php');
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $data=null;
    foreach($db->users()
        ->select('userid','name')
        ->where('username',$username)->where('password',$pass)
        as $row){
            $data[0]=$row;
        };
        if($data){
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode("Login Fail",JSON_UNESCAPED_UNICODE);
        }
});
?>