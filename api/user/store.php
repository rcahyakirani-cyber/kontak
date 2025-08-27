<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include('helper.php'); 
include("../../connect.php"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $form_data = json_decode(file_get_contents("php://input"));
    
    if ($form_data != NULL) {
        if (!empty($form_data->name) && !empty($form_data->nomor_hp) && !empty($form_data->jenis_kelamin) && !empty($form_data->tanggal_lahir)) {
            
            $name          = $form_data->name;
            $nomor_hp      = $form_data->nomor_hp;
            $jenis_kelamin = $form_data->jenis_kelamin;            
            $tanggal_lahir = $form_data->tanggal_lahir;
            $catatan       = $form_data->catatan ?? '';

            $store = $connect->query("INSERT INTO users (name, nomor_hp, jenis_kelamin, tanggal_lahir, catatan) 
                                      VALUES ('$name', '$nomor_hp', '$jenis_kelamin', '$tanggal_lahir', '$catatan')");

            if($store){
                $array_api = response_json(200, 'Berhasil menambah data user');
            } else {
                $array_api = response_json(500, 'Gagal menambah data user: ' . $connect->error);
            }

        } else {
            $array_api = response_json(400, 'Gagal menambah data user, data tidak lengkap.');
        }

    } else {
        $array_api = response_json(400, 'Gagal menambah data user, data tidak boleh kosong.');
    }

} else {
    $array_api = response_json(405, 'Metode tidak diizinkan.');
}

echo json_encode($array_api);
?>