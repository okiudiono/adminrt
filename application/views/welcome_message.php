<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kamus Jawa - Responsif</title>

	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<style>
		body {
			background-color: #f8f9fa;
		}

		.container {
			margin-top: 50px;
		}

		.card {
			transition: 0.3s;
		}

		.card:hover {
			transform: scale(1.02);
		}

		#loading {
			display: none;
		}
	</style>
</head>

<body>

	<!-- Navbar -->
	<nav class="navbar navbar-dark bg-primary">
		<div class="container">
			<a class="navbar-brand" href="#">Kamus Jawa - Indonesia</a>
		</div>
	</nav>

	<!-- Container -->
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card shadow">
					<div class="card-body">
						<h4 class="text-center">Cari Kata</h4>
						<div class="input-group mt-3">
							<input type="text" id="keyword" class="form-control" placeholder="Masukkan kata..." autocomplete="off">
							<button class="btn btn-primary" id="btnCari">Cari</button>
						</div>
						<div id="loading" class="text-center mt-3">
							<div class="spinner-border text-primary" role="status"></div>
						</div>
					</div>
				</div>

				<div class="mt-4">
					<h5>Hasil Pencarian:</h5>
					<div id="hasil"></div>
				</div>
			</div>
		</div>
	</div>

	<!-- JavaScript -->
	<script>
		$(document).ready(function() {
			$("#btnCari").click(function() {
				var keyword = $("#keyword").val();
				if (keyword.length > 0) {
					$("#loading").show();
					$.ajax({
						url: "<?= site_url('kamus/ajax_cari') ?>",
						type: "POST",
						data: {
							keyword: keyword
						},
						dataType: "json",
						success: function(response) {
							$("#hasil").html("");
							$("#loading").hide();
							if (response.length > 0) {
								var output = '<div class="row">';
								$.each(response, function(index, item) {
									output += `
                                        <div class="col-md-6">
                                            <div class="card text-bg-light shadow-sm mb-3">
                                                <div class="card-body">
                                                    <h6 class="card-title"><b>${item.indonesia}</b></h6>
                                                    <p class="card-text text-primary">${item.jawa}</p>
                                                </div>
                                            </div>
                                        </div>`;
								});
								output += '</div>';
								$("#hasil").html(output);
							} else {
								$("#hasil").html("<p class='text-danger'>Tidak ditemukan.</p>");
							}
						}
					});
				} else {
					$("#hasil").html("<p class='text-warning'>Masukkan kata terlebih dahulu.</p>");
				}
			});

			// Support Enter key
			$("#keyword").keypress(function(event) {
				if (event.which == 13) {
					$("#btnCari").click();
				}
			});
		});
	</script>

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>