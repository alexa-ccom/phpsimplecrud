<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Mahasiswa extends Database {

    // Method untuk input data mahasiswa
    public function inputMahasiswa($data){
        // Mengambil data dari parameter $data
        $nim      = $data['nim'];
        $nama     = $data['nama'];
        $prodi    = $data['prodi'];
        $alamat   = $data['alamat'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status'];
        $category   = $data['kategori'];
        $bukupinjam   = $data['bukupinjam'];
        $pinjam     = $data['pinjam'];
        $kembali     = $data['kembali'];
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_mahasiswa (nim_mhs, nama_mhs, prodi_mhs, alamat, email, telp, status_mhs, kategori_buku, buku_pinjam) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Mengecek apakah statement berhasil disiapkan
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("sssssssss", $nim, $nama, $prodi, $alamat, $email, $telp, $status, $category, $buku_pinjam);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mengambil semua data mahasiswa
    public function getAllMahasiswa(){
        // Menyiapkan query SQL untuk mengambil data mahasiswa beserta prodi dan provinsi
        $query = "SELECT id_mhs, nim_mhs, nama_mhs, nama_prodi, alamat, email, telp, status_mhs, kategori_buku, buku_pinjam 
                  FROM tb_mahasiswa
                  JOIN tb_prodi ON prodi_mhs = kode_prodi";
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $mahasiswa = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
                        while($row = $result->fetch_assoc()) {
                            $mahasiswa[] = [
                                'id' => $row['id_mhs'],
                                'nim' => $row['nim_mhs'],
                                'nama' => $row['nama_mhs'],
                                'prodi' => $row['nama_prodi'],
                                'alamat' => $row['alamat'],
                                'email' => $row['email'],
                                'telp' => $row['telp'],
                                'status' => $row['status_mhs'],
                                'kategori' => $row['kategori_buku'],
                                'bukupinjam' => $row['buku_pinjam']
                            ];
                        }
                    }
                    // Mengembalikan array data mahasiswa
                    return $mahasiswa;
                }

                // Method untuk mengambil data mahasiswa berdasarkan ID
                public function getUpdateMahasiswa($id){
                    // Menyiapkan query SQL untuk mengambil data mahasiswa berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_mahasiswa WHERE id_mhs = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            // Mengambil data mahasiswa  
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $data = [
                'id' => $row['id_mhs'],
                'nim' => $row['nim_mhs'],
                'nama' => $row['nama_mhs'],
                'prodi' => $row['prodi_mhs'],
                'alamat' => $row['alamat'],
                'email' => $row['email'],
                'telp' => $row['telp'],
                'status' => $row['status_mhs'],
                'kategori' => $row['kategori_buku'],
                'bukupinjam' => $row['buku_pinjam'],
            ];
        }
        $stmt->close();
        // Mengembalikan data mahasiswa
        return $data;
    }

    // Method untuk mengedit data mahasiswa
   public function editMahasiswa($data){
    $id       = $data['id'];
    $nim      = $data['nim'];
    $nama     = $data['nama'];
    $prodi    = $data['prodi'];
    $alamat   = $data['alamat'];
    $email    = $data['email'];
    $telp     = $data['telp'];
    $status   = $data['status'];

    $query = "UPDATE tb_mahasiswa 
              SET nim_mhs = ?, nama_mhs = ?, prodi_mhs = ?, alamat = ?, email = ?, telp = ?, status_mhs = ? 
              WHERE id_mhs = ?";

    $stmt = $this->conn->prepare($query);
    if(!$stmt){
        return false;
    }

    // ✅ jumlah variabel dan parameter sekarang cocok (8)
    $stmt->bind_param("sssssssi", $nim, $nama, $prodi, $alamat, $email, $telp, $status, $id);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


    // Method untuk menghapus data mahasiswa
    public function deleteMahasiswa($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_mahasiswa WHERE id_mhs = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mencari data mahasiswa berdasarkan kata kunci
    public function searchMahasiswa($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data mahasiswa menggunakan prepared statement
        $query = "SELECT id_mhs, nim_mhs, nama_mhs, nama_prodi, alamat, email, telp, status_mhs 
                  FROM tb_mahasiswa
                  JOIN tb_prodi ON prodi_mhs = kode_prodi
                  WHERE nim_mhs LIKE ? OR nama_mhs LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $mahasiswa = [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data mahasiswa dalam array
                $mahasiswa[] = [
                    'id' => $row['id_mhs'],
                    'nim' => $row['nim_mhs'],
                    'nama' => $row['nama_mhs'],
                    'prodi' => $row['nama_prodi'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'status' => $row['status_mhs']
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data mahasiswa yang ditemukan
        return $mahasiswa;
    }

}

?>