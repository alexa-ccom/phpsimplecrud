<?php

include_once 'config/class-mahasiswa.php';
$mahasiswa = new Mahasiswa();
// Menampilkan alert berdasarkan status yang diterima melalui parameter GET
if(isset($_GET['status'])){
	// Mengecek nilai parameter GET 'status' dan menampilkan alert yang sesuai menggunakan JavaScript
	if($_GET['status'] == 'inputsuccess'){
		echo "<script>alert('Data mahasiswa berhasil ditambahkan.');</script>";
	} else if($_GET['status'] == 'editsuccess'){
		echo "<script>alert('Data mahasiswa berhasil diubah.');</script>";
	} else if($_GET['status'] == 'deletesuccess'){
		echo "<script>alert('Data mahasiswa berhasil dihapus.');</script>";
	} else if($_GET['status'] == 'deletefailed'){
		echo "<script>alert('Gagal menghapus data mahasiswa. Silakan coba lagi.');</script>";
	}
}
$dataMahasiswa = $mahasiswa->getAllMahasiswa();

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
								<h3 class="mb-0">Daftar Customer</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Beranda</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="app-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-14">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Tabel Customer</h3>
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
									<div class="card-body p-0 table-responsive">
										<table class="table table-striped" role="table">
											<thead>
												<tr>
													<th>No</th>
													<th>NIM</th>
													<th>Nama</th>
													<th>Prodi</th>
													<th>alamat</th>
													<th>Email</th>
													<th>Telp</th>
													<th>Status</th>
													<th>Kategori</th>
													<th>Nama buku</th>
													<th>Tanggal Pinjam</th>
													<th>Tanggal Kembali</th>
													<th class="text-center">Status</th>
													<th class="text-center">Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if(count($dataMahasiswa) == 0){
													    echo '<tr class="align-middle">
															<td colspan="14" class="text-center">Tidak ada data mahasiswa.</td>
														</tr>';
													} else {
														foreach ($dataMahasiswa as $index => $mahasiswa){
															if($mahasiswa['status'] == 1){
															    $mahasiswa['status'] = '<span class="badge bg-success">Aktif</span>';
															} 
															echo '<tr class="align-middle">
																<td>'.($index + 1).'</td>
																<td>'.$mahasiswa['nim'].'</td>
																<td>'.$mahasiswa['nama'].'</td>
																<td>'.$mahasiswa['prodi'].'</td>
																<td>'.$mahasiswa['alamat'].'</td>
																<td>'.$mahasiswa['email'].'</td>
																<td>'.$mahasiswa['telp'].'</td>
																<td>'.$mahasiswa['status'].'</td>
																<td>'.$mahasiswa['kategori'].'</td>
																<td>'.$mahasiswa['bukupinjam'].'</td>
																<td class="text-center">
																	<button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'data-edit.php?id='.$mahasiswa['id'].'\'"><i class="bi bi-pencil-fill"></i> Edit</button>
																	<button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus data mahasiswa ini?\')){window.location.href=\'proses/proses-delete.php?id='.$mahasiswa['id'].'\'}"><i class="bi bi-trash-fill"></i> Hapus</button>
																</td>
															</tr>';
														}
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary" onclick="window.location.href='data-input.php'"><i class="bi bi-plus-lg"></i> Tambah Customer</button>
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