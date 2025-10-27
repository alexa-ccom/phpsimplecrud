<?php
include_once 'config/class-buku.php';
$buku = new Buku();

// Ambil semua data buku dari class Buku
$dataBuku = $buku->getAllBuku();
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
								<h3 class="mb-0">Daftar Buku</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Daftar Buku</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="app-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Tabel Data Buku</h3>
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
													<th>Nama Buku</th>
													<th>ISBN</th>
													<th>Tahun Rilis</th>
													<th>Kategori</th>
													<th>Stok</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if (count($dataBuku) == 0) {
														echo '<tr class="align-middle">
															<td colspan="8" class="text-center">Tidak ada data buku.</td>
														</tr>';
													} else {
														foreach ($dataBuku as $index => $b) {
															echo '<tr class="align-middle">
																<td>' . ($index + 1) . '</td>
																<td>' . $b['nama_buku'] . '</td>
																<td>' . $b['isbn'] . '</td>
																<td>' . $b['tahun_rilis'] . '</td>
																<td>' . $b['category'] . '</td>
																<td>' . $b['stock'] . '</td>
															</tr>';
														}
													}
												?>
											</tbody>
										</table>
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