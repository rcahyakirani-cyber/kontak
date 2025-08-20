<?php 

header("content-type: application/json; charset=utf-8");

include("helper.php");

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {

    include "../../connect.php";

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        if ($id != "") {

            $read = $connect->query("SELECT * FROM users WHERE id = '$id'");

            $user = $read->fetch_assoc();

            if ($user) {
                
                $destroy = $connect->query("DELETE FROM users WHERE id = '$id'");
    
                $array_api = json_response(200, "Berhasil Menghapus");
            } 
            
            else {
                $array_api = json_response(404, "User tidak ditemukan");
            }
        }

        else {
            $array_api = json_response(400, "ID tidak boleh kosong");
        }

    }

    else {
        $array_api = json_response(400, "ID tidak ditemukan");
    }

} else {

    $array_api = json_response(405, "Method Not Allowed");

}

echo json_encode($array_api);

?>