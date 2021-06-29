<?= content_open() ?>

<div class="card bg-white">
	<div class="judul text-center mt-5 ">
		<h1><b><?= $title; ?></b></h1>
	</div>
	<br>

	<a href="<?= site_url($url . '/form/tambah') ?>" class="btn btn-success mb-2 ml-4" style="width: 103px;"><i class="fa fa-plus"></i> Tambah</a>
	<div class="row text-center justify-content-center mt-3">
		<div class="col-11">

			<?= $this->session->flashdata('info') ?>

			<table class="table table-bordered dt">
				<thead>
					<tr class="table table-primary text-dark">
						<th width="50px" class="text-center">No</th>
						<th>Jalur</th>
						<th>Halte</th>
						<th>Latitude</th>
						<th>Longitude</th>
						<th>Marker</th>
						<th width="150px">Aksi</th>
					</tr>
				</thead>

			</table>
		</div>
	</div>
</div>
<?= content_close() ?>