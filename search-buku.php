<?php

include_once 'config/class-buku.php';
$buku = new Buku();
$kataKunci = '';
// Mengecek apakah parameter GET 'search' ada
if(isset($_GET['search'])){
	// Mengambil kata kunci pencarian dari parameter GET 'search'
	$kataKunci = $_GET['search'];
	// Memanggil method searchMahasiswa untuk mencari data buku berdasarkan kata kunci dan menyimpan hasil dalam variabel $cariBuku
	$cariBuku = $buku->searchBuku($kataKunci);
} 
?>
<!doctype html>
<html lang="en">
	<head>
		<?php include 'template/header.php'; ?>
	</head>

	<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

		<div class="app-wrapper">

			<?php include 'template/navbar.php'; ?>

			<?php include 'template/sidebar.php'; ?>

			<main class="app-main">

				<div class="app-content-header">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="mb-0">Cari Buku</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Cari Data</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="app-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card mb-3">
									<div class="card-header">
										<h3 class="card-title">Pencarian Buku</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
												<i data-lte-icon="expand" class="bi bi-plus-lg"></i>
												<i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
											</button>
											<button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
												<i class="bi bi-x-lg"></i>
											</button>
										</div>
									</div>
									<div class="card-body">
										<form action="search-buku.php" method="GET">
											<div class="mb-3">
												<label for="search" class="form-label">Masukan Nama Buku</label>
												<input type="text" class="form-control" id="search" name="search" placeholder="Cari berdasarkan Nama Buku, ISBN, Tahun Rilis, Kategori, Stock" value="<?php echo $kataKunci; ?>" required>
											</div>
											<button type="submit" class="btn btn-primary"><i class="bi bi-search-heart-fill"></i> Cari</button>
										</form>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Hasil Pencarian</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
												<i data-lte-icon="expand" class="bi bi-plus-lg"></i>
												<i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
											</button>
											<button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
												<i class="bi bi-x-lg"></i>
											</button>
										</div>
									</div>
									<div class="card-body">
										<?php
										// Mengecek apakah parameter GET 'search' ada
										if(isset($_GET['search'])){
											// Mengecek apakah ada data mahasiswa yang ditemukan
											if(count($cariBuku) > 0){
												// Menampilkan tabel hasil pencarian
												echo '<table class="table table-striped" role="table">
													<thead>
														<tr>
															<th>No</th>
                                                            <th>Nama Buku</th>
                                                            <th>ISBN</th>
                                                            <th>Tahun Rilis</th>
                                                            <th>Kategori</th>
                                                            <th>Stok</th>
														</tr>
													</thead>
													<tbody>';
													// Iterasi data mahasiswa yang ditemukan dan menampilkannya dalam tabel
													foreach ($cariBuku as $index => $buku){
													
														// Menampilkan baris data mahasiswa dalam tabel
														if (count($buku) == 0) {
														echo '<tr class="align-middle">
															<td colspan="8" class="text-center">Tidak ada data buku.</td>
														</tr>';
													} else {
														foreach ($cariBuku as $index => $b) {
															echo '<tr class="align-middle">
																<td>' .($index + 1). '</td>
																<td>' .$b['nama_buku']. '</td>
																<td>' .$b['isbn']. '</td>
																<td>' .$b['tahun_rilis']. '</td>
																<td>' .$b['category']. '</td>
																<td>' .$b['stock']. '</td>
															</tr>';
														}
                                                    }
                                                }
													}
												echo '</tbody>
												</table>';
											} 
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</main>

			<?php include 'template/footer.php'; ?>

		</div>
		
		<?php include 'template/script.php'; ?>

	</body>
</html>