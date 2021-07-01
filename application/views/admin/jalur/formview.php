<?php
$id_jalur = "";
$kd_jalur = "";
$jalur = "";
$geojson = "";
$warna = "";
$marker = "";

if ($parameter == 'ubah' && $id != '') {
    $this->db->where('id_jalur', $id);
    $row = $this->model->get_jalur()->row_array();
    extract($row);
}
?>

<?= content_open() ?>
<div class="row justify-content-center">
    <div class="col-6 ">
        <div class=" card bg-white">
            <div class="card-body">

                <h3 class="text-center pt-3 pb-5"><?= $title; ?></h3>

                <form method="post" action="<?= site_url($url .'/simpan'); ?>" enctype="multipart/form-data">
                    <?= input_hidden('parameter', $parameter) ?>
                    <?= input_hidden('id_jalur', $id_jalur) ?>

                    <div class="form-group">
                        <label>Kode Jalur</label>
                        <?= input_text('kd_jalur', $kd_jalur) ?>
                    </div>
                    <div class="form-group">
                        <label>Jalur</label>
                        <?= input_text('jalur', $jalur) ?>
                    </div>
                    <div class="form-group">
                        <label>File GeoJSON</label>
                        <?= input_file('geojson', $geojson) ?>
                        <?php if ($parameter == 'ubah') : ?>
                            <small class="text-success">Biarkan kosong jika tidak ingin diubah</small>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label>Warna</label>

                        <?= input_color('warna', $warna) ?>

                    </div>
                    <!-- <div class="form-group">
                        <label>Marker</label>
                        <-?= input_file('marker', $marker) ?>
                        <-?php if ($parameter == 'ubah') : ?>
                            <small class="text-success">Biarkan kosong jika tidak ingin diubah</small>
                        <-?php endif ?>
                    </div> -->
                    <div class="form-group">
                        <button type="submit" name="simpan" value="true" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
                        <a href="<?= site_url($url) ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= content_close() ?>