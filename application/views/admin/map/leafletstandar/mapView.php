<?= content_open() ?>
<!-- <div id="map"></div> -->
<div class="card">
    <h1 class="text-center mt-3 mb-2"><b><?= $title; ?></b></h1>
    <div class="card-body">
        <div class="full mb-2">
            <a href="<?= site_url('peta'); ?>">
                <button class="btn btn-primary">
                    View Full Screen
                </button>
            </a>
        </div>
        <div class="peta">
            <iframe src="<?= site_url('peta'); ?>" width="100%" height="500px" frameborder="50px"></iframe>
        </div>
    </div>
</div>

<?= content_close() ?>