<?= content_open(); ?>
<div class="card bg-white">
    <div class="judul text-center mt-5 ">
        <h1><b><?= $title; ?></b></h1>
    </div>
    <!-- <h3>
        PHP versi <?= phpversion() ?>
    </h3>
    <h5>
        Mime Type : <?= mime_content_type(FCPATH . 'map1.geojson'); ?>
    </h5> -->
    <br>
    <a href="<?= site_url($url . '/form/tambah') ?>" class="btn btn-success mb-2 ml-4" style="width: 103px;"><i class="fa fa-plus"></i> Tambah</a>
    <div class="row text-center justify-content-center mt-3">
        <div class="col-11">
            <?= $this->session->flashdata('info') ?>
            <table class="table table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th>No.</th>
                        <th>Kode Jalur</th>
                        <th>Jalur</th>
                        <th>Warna</th>
                        <th>Geojson</th>
                        <th>Marker</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php

                    $no = 1;
                    foreach ($data_jalur->result() as $jalur) { ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $jalur->kd_jalur; ?></td>
                            <td class="text-left"><?= $jalur->jalur; ?></td>
                            <td style="background:<?= $jalur->warna; ?> ;"></td>
                            <td><a href="<?= site_url($url .'/linkGeojson/'. $jalur->id_jalur)?>" target="_BLANK"><?= $jalur->geojson ?></a></td>
                            <!-- <td class="text-center"><-?= ($jalur->marker == '' ? '-' : '<img src="' . (str_replace("dl=0","raw=1", $jalur->linkmarker)) . '" width="40px">') ?></td> -->
                            <td class="text-center"><i class="fa fa-map-marker-alt" style="color:<?= $jalur->warna?>; font-size:30px;"></i></td>
                            <td>
                                <a href="<?= site_url($url . '/form/ubah/' . $jalur->id_jalur) ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>

                                <a href="<?= site_url($url . '/hapus/' . $jalur->id_jalur) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ? ')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    } ?>

                </tbody>

            </table>
        </div>
    </div>

</div>
<?= content_close(); ?>