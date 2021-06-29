<?php
if ($parameter == 'ubah' && $id != '') {
    $this->db->where('id_rute', $id);
    $row = $this->model->get_data()->row_array();
    extract($row);
}
?>

<?= content_open(); ?>

<!-- Control the column width, and how they should appear on different devices -->
<div class="row">
    <div class="col-6">
        <div class=" card bg-white">
            <div class="card-body">

                <h3 class="text-center pt-3 pb-5"><?= $title; ?></h3>
                <div class="form col">
                    <form class="tambah" action="<?= site_url($url . '/simpan'); ?>" method="post">

                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" class="form-control" id="rute" name="rute" placeholder="rute" value="<?= set_value('rute'); ?>">
                        </div>
                        <div class="form-group">
                            <label>Titik Koordinat</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="latitude" value="<?= set_value('latitude'); ?>">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="longitude" value="<?= set_value('longitude'); ?>">
                                </div>
                            </div>


                        </div>
                        <div class="form-group">
                            <label>Marker</label>
                            <input type="file" class="form-control" id="marker" name="marker" placeholder="Marker" value="<?= set_value('marker'); ?>">
                        </div>
                        <div class="mt-5 mb-3">
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                            <a href="<?= site_url($url); ?>" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card bg-light">
            <div class="card-body">
                maps
            </div>
        </div>
    </div>
</div>

<?= content_close(); ?>