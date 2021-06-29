<?= content_open() ?>

<div class="card bg-white">
	<div class="judul text-center mt-5 ">
		<h1><b><?= $title; ?></b></h1>
	</div>
	<br>

	<div class="row text-center justify-content-center mt-3">
		<div class="col-11">

			<form action="<?= base_url('stop/urut') ?>" method="post">
				<div class=" input-group mt-3 mb-2">
					<select class="form-select rounded" name="kota">
						<option selected value='null'>Pilih Jalur</option>
						<?php foreach ($kota as $pilihan) :

							echo "<option value='" . $pilihan['jalur'] . "'>" . $pilihan['jalur'] . "</option>";

						endforeach; ?>
					</select>
					<input class="btn btn-primary" type="submit" name="submit2" value='cari'>
				</div>
			</form>
			<!-- <a href="<?= site_url($url . '/form/tambah') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a> -->
			<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
				<i class="fa fa-upload"></i> Import CSV
			</button> -->
			<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalZip">
				<i class="fa fa-upload"></i> Import Zip
			</button>
			<a href="<?= site_url($url . '/export/pdf') ?>" class="btn btn-danger" target="_BLANK"><i class="fa fa-file-pdf-o"></i> Export PDF</a> -->

			<!-- <=$this->session->flashdata('info')?> -->

			<table class="table table-bordered">
				<thead>
					<tr class="table table-primary text-dark">
						<th width="50px" class="text-center">No</th>
						<th>Jalur</th>
						<th>Stop</th>
						<th>Latitude</th>
						<th>Longitude</th>
						<th width="200px">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($datastop->result() as $row) {
					?>
						<tr>
							<td><?= $no ?></td>
							<td><?= $row->jalur ?></td>
							<td><?= $row->stop ?></td>
							<td><?= $row->latitude ?></td>
							<td><?= $row->longitude ?></td>
							<td>
								<a href="<?= site_url($url . '/form/ubah/' . $row->id_stop) ?>" class="btn btn-info"><i class="fa fa-edit"></i> Ubah</a>
								<a href="<?= site_url($url . '/hapus/' . $row->id_stop) ?>" class="btn btn-danger" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
							</td>
						</tr>
					<?php
						$no++;
					}

					?>
				</tbody>

			</table>
		</div>
	</div>
</div>
<?= content_close() ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Upload CSV</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?= site_url($url . '/importcsv') ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label>File CSV</label>
						<div class="row">
							<div class="col-md-12">
								<?= input_file('csv', '') ?>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalZip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Upload ZIP</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?= site_url($url . '/importzip') ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label>File ZIP</label>
						<div class="row">
							<div class="col-md-12">
								<?= input_file('zip', '') ?>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>