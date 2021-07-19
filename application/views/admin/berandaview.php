<?= content_open(); ?>

<!-- Control the column width, and how they should appear on different devices -->
<?= $this->session->flashdata('info') ?>
<div class="row pt-7">
    <div class="col-xl-6 col-md-6 mt-2">
        <div class="card card-stats bg-primary">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col text-center">
                        <h4 class="card-title text-uppercase text-white mb-2 text-center"> <strong>Jalur</strong> </h4>
                    </div>
                </div>
                <div class="text-center mt--3">
                    <i class="fas fa-route text-white" style="font-size: 100px;"></i>
                </div>
                <div class="button text-center">
                    <a href="<?= site_url('jalur'); ?>">
                        <button class="btn btn-info" style="margin-bottom: -50px;">
                            <span class="text-white mr-2"><i class="fa fa-arrow-down"></i></span>
                            <span class="text-nowrap">Lihat Selengkapnya</span>
                            </p>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6 mt-2">
        <div class="card card-stats bg-primary">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col text-center">
                        <h4 class="card-title text-uppercase text-white mb-2 text-center"> <strong>Halte</strong> </h4>
                    </div>
                </div>
                <div class="text-center mt--3">
                    <i class="fas fa-store-alt text-white" style="font-size: 100px;"></i>
                </div>
                <div class="button text-center">
                    <a href="<?= site_url('stop'); ?>">
                        <button class="btn btn-info" style="margin-bottom: -50px;">
                            <span class="text-white mr-2"><i class="fa fa-arrow-down"></i></span>
                            <span class="text-nowrap">Lihat Selengkapnya</span>
                            </p>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6 mt-5">
        <div class="card card-stats bg-primary">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col text-center">
                        <h4 class="card-title text-uppercase text-white mb-2 text-center"> <strong>Jadwal</strong> </h4>
                    </div>
                </div>
                <div class="text-center mt--3">
                    <i class="far fa-clock text-white" style="font-size: 100px;"></i>
                </div>
                <div class="button text-center">
                    <a href="<?= site_url('admin/jadwal'); ?>">
                        <button class="btn btn-info" style="margin-bottom: -50px;">
                            <span class="text-white mr-2"><i class="fa fa-arrow-down"></i></span>
                            <span class="text-nowrap">Lihat Selengkapnya</span>
                            </p>
                        </button>
                    </a>
                </div>
            </div> 
        </div>
    </div>
    <div class="col-xl-6 col-md-6 mt-5">
        <div class="card card-stats bg-primary">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col text-center">
                        <h4 class="card-title text-uppercase text-white mb-2 text-center"> <strong>Maps</strong> </h4>
                    </div>
                </div>
                <div class="text-center mt--3">
                    <i class="fas fa-map-marker-alt text-white" style="font-size: 100px;"></i>
                </div>
                <div class="button text-center">
                    <a href="<?= site_url('admin/leafletstandar'); ?>">
                        <button class="btn btn-info" style="margin-bottom: -50px;">
                            <span class="text-white mr-2"><i class="fa fa-arrow-down"></i></span>
                            <span class="text-nowrap">Lihat Selengkapnya</span>
                            </p>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<?= content_close(); ?>