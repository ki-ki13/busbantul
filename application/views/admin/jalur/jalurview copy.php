<?= content_open(); ?>



<!-- Control the column width, and how they should appear on different devices -->
<div class="row">
    <div class="col-6">
        <div class=" card bg-light">
            <div class="card-body">

                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <?php foreach ($data_jalur->result() as $row) { ?>
                                <th colspan="4">
                                    <div class="jalur text-center">
                                        <h5><strong><?= $row->jalur ?></strong></h5>
                                    </div>
                                </th>
                            <?php } ?>
                        </tr>
                        <tr>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_rute->result() as $rute => $value) { ?>
                            <tr>
                                <td>
                                    <li> </li>
                                </td>
                                <td>
                                    <?= $value->rute ?>
                                </td>
                                <td>
                                    <a href="<?= site_url($url . '/form/ubah/' . $value->id_rute) ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>

                                </td>
                                <td>
                                    <a href="<?= site_url($url . '/hapus/' . $value->id_rute) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ? ')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="4">
                                <div class="tambah" style="text-align: right;">
                                    <hr>
                                    <a href="<?= site_url($url . '/form/tambah') ?>" class="btn btn-success"><i class="fa fa-plus"> Tambah</i></a>

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- <h5>Rute Bus Trans Bantul</h5>
                            <li class="jalur"><i class="fa fa-bus"></i>Jalur 1: Terminal Giwangan ke Pantai Baru</li>
                            <div class="box">
                                <li>
                                    <div class="bulet"></div>Terminal Giwangan, Giwangan<div class="line"></div>
                                </li>
                                <li>
                                    <div class="bulet"></div>Alfamart, Jl. Parangtritis<div class="line"></div>
                                </li>
                                <li>
                                    <div class="bulet"></div>Kantor Pos, Jl. Bantul<div class="line"></div>
                                </li>
                                <li>
                                    <div class="bulet"></div>Pasar Bantul, Jl. Jend. Sudirman<div class="line"></div>
                                </li>
                                <li>
                                    <div class="bulet"></div>RS Paru Respira Yogyakarta, Jl. Panembahan Senopati<div class="line"></div>
                                </li>
                                <li>
                                    <div class="bulet"></div>SMA Negeri 1 Srandakan, Jl. Pandansimo<div class="line"></div>
                                </li>
                                <li class="akhir">
                                    <div class="bulet"></div>Pantai Baru, Ngentak
                                </li>
                            </div> -->

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