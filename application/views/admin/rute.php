<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="container mt-5">
        <div class="container-fluid">
            <!-- Control the column width, and how they should appear on different devices -->
            <div class="row">
                <div class="col-6">
                    <div class=" card bg-light">
                        <div class="card-body">

                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <?php foreach ($data_jalur as $jalur => $value) : ?>
                                            <th colspan="3">
                                                <?= $value['jalur']; ?>
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_rute as $rute => $value) : ?>
                                        <tr>
                                            <td>
                                                <li> </li>
                                            </td>
                                            <td>
                                                <?= $value['rute']; ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning"><i class="fas fa-pen"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="4">
                                            <div class="tambah" style="text-align: right;">
                                                <a href="<?= site_url('ControlAD/tambah'); ?>"><button type="button" class="btn btn-primary"><i class="fas fa-plus mr-2"></i> Tambah</button></a>

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
        </div>
    </div>


</div>
<!-- end page content -->

</div>
<!-- End of Main Content -->