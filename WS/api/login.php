<?php

$app->post('/api/login', function ($request, $response, array $args) {
    require_once('db/dbconnect.php');
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $data=null;
    foreach($db->users()
        ->select('id','name')
        ->where('username',$username)->where('password',$pass)
        as $row){
            $data[]=$row;
        };
        if($data){
            echo json_encode($data[0],JSON_UNESCAPED_UNICODE);
        }else{
            $myObj = new \stdClass();
            $myObj->userid = "-1";
            $myObj->name = " ";
            
            echo json_encode($myObj,JSON_UNESCAPED_UNICODE);
        }
});
?>