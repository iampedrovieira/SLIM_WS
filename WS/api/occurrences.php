<?php

$app->get('/api/alloccurrences', function ($request, $response, array $args) {
    require_once('db/dbconnect.php');
 
    foreach($db->occurrence()
        as $row){
            $data[]=$row;
        };
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
});

$app->post('/api/create-occurrences', function ($request, $response, array $args) {
    require_once('db/dbconnect.php');

    $description =  $_POST["description"];
    $userid =  $_POST["userid"];
    $typeid = $_POST["typeid"];
    $photo=$_REQUEST['image'];
    $lat = $_POST["lat"];
    $lng = $_POST["lng"];
    $data = array(
        "description"=>$description,
        "users_id"=>$userid,
        "occurenceType_id"=>$typeid,
        "date_"=>date("y-m-d H:i"),
        "lat"=>$lat,
        "lng"=>$lng,

    );
    $occurrence = $db->occurrence();

    $result = $occurrence->insert($data);
    if ($result == false){
        $result=['status'=>false,'MSG'=>"Inserção falhou"];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }else{
        $binary=base64_decode($photo);
        header('Content-Type: bitmap; charset=utf-8');
        $name=strval($result).".png";
        $file = fopen("api/img/".$name, 'wb');
        fwrite($file, $binary);
        fclose($file);
        $resulta=['status'=>true,'MSG'=>"Sucesso"];
        echo json_encode($resulta,JSON_UNESCAPED_UNICODE);
    }
});
$app->post('/api/edit-occurrences', function ($request) {
    require_once('db/dbconnect.php');
    $id =  $_POST["id"];
    $description =  $_POST["description"];
    $userid =  $_POST["userid"];
    $typeid = $_POST["typeid"];
    $photo=$_REQUEST['image'];
    $lat = $_POST["lat"];
    $lng = $_POST["lng"];
    $data = array(
        "description"=>$description,
        "users_id"=>$userid,
        "occurenceType_id"=>$typeid,
        "date_"=>date("y-m-d H:i"),
        "lat"=>$lat,
        "lng"=>$lng,

    );
    $occurrence = $db->occurrence();

    $result = $occurrence[$id]->update($data);
    if ($result == false){
        $result=['status'=>false,'MSG'=>"Inserção falhou"];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }else{
        $binary=base64_decode($photo);
        header('Content-Type: bitmap; charset=utf-8');
        $name=strval($id).".png";
        unlink("api/img/".$name);
        $file = fopen("api/img/".$name, 'wb+');
        fwrite($file, $binary);
        fclose($file);
        $resulta=['status'=>true,'MSG'=>"Sucesso"];
        echo json_encode($resulta,JSON_UNESCAPED_UNICODE);
    }
});
?>