<?php 

header("Content-Type: application/json");

include('helper.php'); 

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    include("../../connect.php"); 

    $input = json_decode(file_get_contents("php://input"));

    $name          = $input->name;
    $nomor_hp      = $input->nomor_hp;
    $jenis_kelamin = $input->jenis_kelamin;
    $tanggal_lahir = $input->tanggal_lahir;
    $catatan       = $input->catatan;

    if($name == "" || $nomor_hp == "" || $jenis_kelamin == "" || $tanggal_lahir == ""){
        $array_api = json_response(400, "Isi tidak boleh kosong");
    } else {
        $store = $connect->query("INSERT INTO kontak_teman (name, nomor_hp, jenis_kelamin, tanggal_lahir, catatan) 
                                  VALUES ('$name', '$nomor_hp', '$jenis_kelamin', '$tanggal_lahir', '$catatan')");
        
        if($store){
            $array_api = json_response(200, "Data berhasil ditambahkan");
        } else {
            $array_api = json_response(500, "Gagal menambahkan data: " . $connect->error);
        }
    }
} else {
    $array_api = json_response(405, "Method salah");
}

echo json_encode($array_api);

?>
