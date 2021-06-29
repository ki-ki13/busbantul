<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>

<body id="page-top">
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div id="map"></div>
        <!-- end page content -->
    </div>
    <!-- End of Main Content -->
    <?php include 'javascript.php' ?>
    <?php
    if (isset($js)) {
        echo $js;
    }
    ?>
</body>

</html>