 <?php
header('Content-Type: application/json');

include("helper.php");

if ($_SERVER["REQUEST_METHOD"] == 'PUT') {
    include("../../connect.php");

    if (isset($_GET['id'])) {
        if ($_GET['id'] != "") {
            $id = $_GET['id'];

            // cek apakah data dengan id ada
            $search_id = $connect->query("SELECT * FROM kontak_teman WHERE id = '$id'");
            $data = $search_id->fetch_assoc();

            if ($data == null) {
                $array_api = json_response(404, "ID tidak ditemukan");
            } else {
                $input = json_decode(file_get_contents("php://input"));

                $name          = $input->name;
                $nomor_hp      = $input->nomor_hp;
                $jenis_kelamin = $input->jenis_kelamin;
                $tanggal_lahir = $input->tanggal_lahir;
                $catatan       = $input->catatan;

                if ($name == "" || $nomor_hp == "" || $jenis_kelamin == "" || $tanggal_lahir == "") {
                    $array_api = json_response(400, "Isi tidak boleh kosong");
                } else {
                    $update = $connect->query("UPDATE kontak_teman 
                                               SET name='$name', 
                                                   nomor_hp='$nomor_hp', 
                                                   jenis_kelamin='$jenis_kelamin', 
                                                   tanggal_lahir='$tanggal_lahir', 
                                                   catatan='$catatan' 
                                               WHERE id='$id'");
                    
                    if ($update) {
                        $array_api = json_response(200, "Data berhasil diubah");
                    } else {
                        $array_api = json_response(500, "Gagal mengubah data: " . $connect->error);
                    }
                }
            }
        } else {
            $array_api = json_response(400, "ID tidak boleh kosong");
        }
    } else {
        $array_api = json_response(400, "Masukkan kolom ID");
    }
} else {
    $array_api = json_response(405, "Metode tidak diizinkan");
}

echo json_encode($array_api);
?>
