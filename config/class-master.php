<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

    // Method untuk mendapatkan daftar program studi
    public function getProdi(){
        $query = "SELECT * FROM tb_prodi";
        $result = $this->conn->query($query);
        $prodi = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $prodi[] = [
                    'id' => $row['kode_prodi'],
                    'nama' => $row['nama_prodi']
                ];
            }
        }
        return $prodi;
    }
   public function getBuku(){
        $query = "SELECT * FROM tb_daftar_buku";
        $result = $this->conn->query($query);
        $buku = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $buku[] = [
                    'id' => $row['id_book'],
                    'namabuku' => $row['book_nm']
                ];
            }
        }
        return $buku;
    }

    // Method untuk mendapatkan daftar status mahasiswa menggunakan array statis
    public function getStatus(){
        return [
            ['id' => 1, 'nama' => 'Buku Di Pinjam'],
            ['id' => 2, 'nama' => 'Buku Di Kembalikan']
        ];
    }

    // Method untuk input data program studi
    public function inputProdi($data){
        $kodeProdi = $data['kode'];
        $namaProdi = $data['nama'];
        $query = "INSERT INTO tb_prodi (kode_prodi, nama_prodi) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $kodeProdi, $namaProdi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data program studi berdasarkan kode
    public function getUpdateProdi($id){
        $query = "SELECT * FROM tb_prodi WHERE kode_prodi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $prodi = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $prodi = [
                'id' => $row['kode_prodi'],
                'nama' => $row['nama_prodi']
            ];
        }
        $stmt->close();
        return $prodi;
    }

    // Method untuk mengedit data program studi
    public function updateProdi($data){
        $kodeProdi = $data['kode'];
        $namaProdi = $data['nama'];
        $query = "UPDATE tb_prodi SET nama_prodi = ? WHERE kode_prodi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $namaProdi, $kodeProdi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data program studi
    public function deleteProdi($id){
        $query = "DELETE FROM tb_prodi WHERE kode_prodi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}

?>