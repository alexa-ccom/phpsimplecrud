<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Buku extends Database {

    // Method untuk input data mahasiswa
    public function dataBuku($data){
        // Mengambil data dari parameter $data
        $id_book      = $data['id_book'];
        $nama_buku     = $data['nama_buku'];
        $isbn    = $data['isbn'];
        $tahun_liris   = $data['tahun_rilis'];
        $category    = $data['category'];
        $stock     = $data['stock'];
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_daftar_buku (id_book, book_name, ISBN, release_date, category, stock) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Mengecek apakah statement berhasil disiapkan
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssss", $id_book, $nama_buku, $isbn, $tahun_rilis, $category, $stock);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

     // Method untuk mengambil semua data buku
    public function getAllBuku(){
        // Menyiapkan query SQL untuk mengambil data mahasiswa beserta prodi dan provinsi
        $query = "SELECT id_book, book_nm, ISBN, release_date, category, stock
                  FROM tb_daftar_buku";
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $buku = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                $buku[] = [
                    'id' => $row['id_book'],
                    'nama_buku' => $row['book_nm'],
                    'isbn' => $row['ISBN'],
                    'tahun_rilis' => $row['release_date'],
                    'category' => $row['category'],
                    'stock' => $row['stock']
                ];
            }
        }
        // Mengembalikan array data mahasiswa
        return $buku;

    }
}

?>