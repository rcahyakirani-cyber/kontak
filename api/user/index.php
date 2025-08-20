<?php

header("Content-Type: application/json; charset=UTF-8");
include("helper.php");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include("../../connect.php");

    $read = $connect->query("SELECT * FROM users");
    $result = $read->fetch_all(MYSQLI_ASSOC);

    $array_api = json_response(200, "Berhasil", $result);
}

else{
    $array_api = json_response(405, "Metode tidak diizinkan");
}

echo json_encode($array_api);


?>