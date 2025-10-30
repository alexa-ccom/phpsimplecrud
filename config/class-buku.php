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
        $query = "INSERT INTO tb_daftar_buku (id_book, book_nm, ISBN, release_date, category, stock) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
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
    public function searchBuku($kataKunci) {
    // Menyiapkan LIKE query untuk pencarian
    $likeQuery = "%" . $kataKunci . "%";

    // Menyiapkan query SQL untuk pencarian data buku menggunakan prepared statement
    $query = "SELECT id_book, book_nm, ISBN, release_date, category, stock
              FROM tb_daftar_buku
              WHERE ISBN LIKE ? 
                 OR book_nm LIKE ? 
                 OR category LIKE ? ";

    $stmt = $this->conn->prepare($query);
    if(!$stmt){
        // Jika statement gagal disiapkan, kembalikan array kosong
        return [];
    }

    // Memasukkan parameter ke statement (semua pakai LIKE)
    $stmt->bind_param("sss", $likeQuery, $likeQuery, $likeQuery,);
    $stmt->execute();
    $result = $stmt->get_result();

    // Menyiapkan array kosong untuk menyimpan data buku
    $buku = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            // Menyimpan data buku ke array
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
    

    $stmt->close();
    // Mengembalikan array data buku yang ditemukan
    return $buku;
}
// public function tambahBuku($data) {
//     // Ambil data dari array $data
//     $namaBuku   = $data['nama_buku'];
//     $isbn       = $data['isbn'];
//     $tahunRilis = $data['tahun_rilis'];
//     $category   = $data['category'];
//     $stock      = $data['stock'];

//     // Query insert
//     $query = "INSERT INTO tb_buku (nama_buku, isbn, tahun_rilis, category, stock) 
//               VALUES (?, ?, ?, ?, ?)";

//     $stmt = $this->conn->prepare($query);

//     if (!$stmt) {
//         return false; // jika prepare gagal
//     }

//     // Bind parameter sesuai urutan dan tipe data
//     $stmt->bind_param("ssssi", $namaBuku, $isbn, $tahunRilis, $category, $stock);

//     // Eksekusi query
//     $result = $stmt->execute();

//     // Tutup statement
//     $stmt->close();

//     return $result;
// }


}

?>