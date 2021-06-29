<?php
$id_stop = "";
$id_jalur = "";
$jalur = "";
$kd_stop = "";
$stop = "";
$latitude = "";
$longitude = "";
if ($parameter == 'ubah' && $id != '') {
	$this->db->where('id_stop', $id);
	$row = $this->model->get()->row_array();
	extract($row);
}
?>
<?= content_open() ?>
<div class="card bg-white pb-5">
	<div class="judul text-center mt-5 ">
		<h1><b><?= $title; ?></b></h1>
	</div>
	<br>
	<div class="row justify-content-center mt-3">
		<div class="col-11">
			<form method="post" action="<?= site_url($url . '/simpan') ?>" enctype="multipart/form-data">
				<?= input_hidden('parameter', $parameter) ?>
				<?= input_hidden('id_stop', $id_stop) ?>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Jalur</label>
							<div class="row">
								<div class="col-md-12">
									<?php
									$op[''] = 'Pilih Jalur';
									$get = $this->Rute_model->get_jalur();
									foreach ($get->result() as $row) {
										$op[$row->id_jalur] = $row->jalur;
									}
									?>
									<?= select('id_jalur', $op, $id_jalur) ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Halte</label>
							<div class="row">
								<div class="col-md-12">
									<?= input_text('stop', $stop) ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Titik Koordinat</label>
							<div class="row">
								<div class="col-md-6">
									<?= input_text('latitude', $latitude) ?>
								</div>
								<div class="col-md-6">
									<?= input_text('longitude', $longitude) ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="input-group mb-3">
							<span class="input-group-text" id="inputGroup-sizing-default">Lokasi Titik : </span>
							<input type="text" name="lokasi" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
						</div>


						<div id="map" style="height: 400px;">
						</div>
					</div>

					<div class="col-md-12">
						<hr>
						<div class="form-group">
							<button type="submit" name="simpan" value="true" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
							<a href="<?= site_url($url) ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
						</div>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
<?= content_close() ?>