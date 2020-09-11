<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div>
        <div class="card card-info">
            <div class="card-header">
                <h1>Data User Akses</h1>
            </div>
	<div class="card-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
			<tr>
				<th style="text-align:center">No.</th>
				<th style="text-align:center">Username</th>
				<th>Nama</th>
				<!-- <th>Role</th> -->
				<!-- <th style="text-align:center">Status</th> -->
				<th style="text-align:center">Action</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$no = 1;
			foreach ($users as $row) {
				?>
				<tr>
					<td style="text-align:center"><?= $no++ ?></td>
					<td style="text-align:center"><?= $row->username?></td>
					<td><?= $row->nama_user?></td>
					<!-- <td><?= $row->password?></td> -->
					<!-- <td style="text-align:center"><?= $row->is_active == "1" ? "Aktif" : "Tidak Aktif" ?></td> -->
					<td style="text-align:center">
						<a href="<?= site_url("user/update/$row->id_user") ?>"
						   class="btn btn-xs btn-warning">
							<i class="fas fa-edit"></i>
						</a>
						<a href="<?= site_url("auth/proses_hapus/$row->id_user") ?>" 
						class="btn btn-xs btn-danger tombolHapus">
                                        <fas class="fas fa-trash"></fas>
                                    </a>
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
	</div>
	<div class="card-footer">
		<a href="<?= site_url("user/tambah") ?>" class="btn btn-primary">
			<i class="fas fa-plus"></i> Tambah User
		</a>
	</div>
</div>
<script>
    $(function () {
        $(".btn-reset-password").on("click", function () {
            let idUser = $(this).data("id");
            $.confirm({
                theme: "material",
                type: "dark",
                title: "Konfirmasi",
                content: "Anda yakin akan mereset password user ini?<br> Password akan dikirim ke email user",
                buttons: {
                    buttonOke: {
                        text: "Reset Password",
                        btnClass: "btn-dark",
                        action: function () {
                            prosesReset(idUser);
                        }
                    },
                    buttonBatal: {
                        text: "Batal",
                        btnClass: "btn-info",
                        action: function () {

                        }
                    }
                }
            });
        });
        function prosesReset(idUser) {
            $.LoadingOverlay("show");
            $.ajax({
                url: window.base_url + "user/reset_password",
                type: "post",
                data: {
                    id_user: idUser
                },
				success:function (result) {
                    $.LoadingOverlay("hide");
					if(result == "1"){
					    $.alert({
							title:"Sukses",
							content:"Password Berhasil di reset"
						});
					}

                }
            })
        }
    });
</script>