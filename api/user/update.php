<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    http_response_code(200);
    exit;
}

include("../../connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $id = $_GET['id'] ?? null;
    $data = json_decode(file_get_contents("php://input"), true);

    if ($id && !empty($data)) {
        $name = $data['name'];
        $nomor_hp = $data['nomor_hp'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $tanggal_lahir = $data['tanggal_lahir'];
        $catatan = $data['catatan'];

        $query = "UPDATE users SET 
                    name='$name', 
                    nomor_hp='$nomor_hp', 
                    jenis_kelamin='$jenis_kelamin', 
                    tanggal_lahir='$tanggal_lahir', 
                    catatan='$catatan' 
                  WHERE id='$id'";

        if ($connect->query($query)) {
            echo json_encode(["status"=>200, "message"=>"Update berhasil"]);
        } else {
            echo json_encode(["status"=>500, "message"=>"Gagal update data"]);
        }
    } else {
        echo json_encode(["status"=>400, "message"=>"Data tidak valid"]);
    }
}
?>
