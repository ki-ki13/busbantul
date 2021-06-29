<?php
$id_jadwal = "";
$id_jalur = "";
$id_stop = "";
$durasi = "";
$jadwal1 = "";
$jadwal2 = "";
$jadwal3 = "";
if ($parameter == 'ubah' && $id != '') {
	$this->db->where('id_jadwal', $id);
	$row = $this->model->get_jadwal()->row_array();
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
				<?= input_hidden('id_jadwal', $id_jadwal) ?>
				<?= input_hidden('parameter', $parameter) ?>
				<div class="row">
					<div class="col-md-12">
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
							<label>Stop</label>
							<div class="row">
								<div class="col-md-12">
									<?php
									$op = null;
									$op[''] = 'Pilih Pemberhentian';
									$get = $this->Rute_model->get_stop();
									foreach ($get->result() as $row) {
										$op[$row->id_stop] = $row->stop;
									}
									?>
									<?= select('id_stop', $op, $id_stop) ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Durasi</label>
							<div class="row">
								<div class="col-md-12">
									<?= input_text('durasi', $durasi) ?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Jadwal 1</label>
							<div class="row">
								<div class="col-md-12">
									<?= input_text('jadwal1', $jadwal1) ?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Jadwal 2</label>
							<div class="row">
								<div class="col-md-12">
									<?= input_text('jadwal2', $jadwal2) ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Jadwal 3</label>
							<div class="row">
								<div class="col-md-12">
									<?= input_text('jadwal3', $jadwal3) ?>
								</div>
							</div>
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