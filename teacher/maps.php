<?php include './../layouts/session.php'; ?>
<?php

if(isset($_SESSION["islogged"])){

    if($_SESSION['user']=='admin'){
        header('location: ./../admin/dashboard.php');
    }else if($_SESSION['user']=='saloon'){
        header('location: ./../saloon/dashboard.php');
    }
}else{
    header('location: ./../login.php');
}
?>

<?php

if(isset($_SESSION['success'])){
    echo '
                            <div class="alert btn-success message-alert"> '
        .$_SESSION['success'].'
                            </div>';
    unset($_SESSION['success']);
}

if(isset($_SESSION['error'])){
    echo '
                            <div class="alert btn-danger message-alert"> '
        .$_SESSION['error'].'
                            </div>';
    unset($_SESSION['error']);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include './../layouts/header.php'; ?>
<!-- Load Leaflet: http://leafletjs.com/ -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js" integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log==" crossorigin=""></script>

<!-- Esri Leaflet Plugin: https://esri.github.io/esri-leaflet/ -->
<script src="https://unpkg.com/esri-leaflet@2.1.3/dist/esri-leaflet.js" integrity="sha512-pijLQd2FbV/7+Jwa86Mk3ACxnasfIMzJRrIlVQsuPKPCfUBCDMDUoLiBQRg7dAQY6D1rkmCcR8286hVTn/wlIg==" crossorigin=""></script>

<!-- ESRI Renderer Plugin: https://github.com/Esri/esri-leaflet-renderers -->
<!-- Renders feature layer using default symbology as defined by ArcGIS REST service -->
<!-- Currently doesn't work with ESRI cluster plugin -->
<script src="https://unpkg.com/esri-leaflet-renderers@2.0.6/dist/esri-leaflet-renderers.js" integrity="sha512-mhpdD3igvv7A/84hueuHzV0NIKFHmp2IvWnY5tIdtAHkHF36yySdstEVI11JZCmSY4TCvOkgEoW+zcV/rUfo0A==" crossorigin=""></script>

<!-- Load Leaflet Basemap Providers: https://github.com/leaflet-extras/leaflet-providers -->
<!-- Modified to include USGS TNM web services -->
<script src="../maps/JS/leaflet-providers.js"></script>

<!-- 2.5D OSM Buildings Classic: https://github.com/kekscom/osmbuildings -->
<script src="https://cdn.osmbuildings.org/OSMBuildings-Leaflet.js"></script>

<!-- Load Font Awesome icons -->
<script src="https://use.fontawesome.com/a64989e3a8.js"></script>

<!-- Grouped Layer Plugin: https://github.com/ismyrnow/leaflet-groupedlayercontrol  -->
<link rel="stylesheet" href="../maps/CSS/leaflet.groupedlayercontrol.min.css">
<script src="../maps/JS/leaflet.groupedlayercontrol.min.js" type="text/javascript"></script>


<!-- Overview mini map Plugin: https://github.com/Norkart/Leaflet-MiniMap -->
<link rel="stylesheet" href="../maps/CSS/Control.MiniMap.css">
<script src="../maps/JS/Control.MiniMap.min.js" type="text/javascript"></script>

<!-- Leaflet Drawing Plugin: https://github.com/codeofsumit/leaflet.pm -->
<link rel="stylesheet" href="https://unpkg.com/leaflet.pm@latest/dist/leaflet.pm.css">
<script src="https://unpkg.com/leaflet.pm@latest/dist/leaflet.pm.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Leaflet WMS Plugin: https://github.com/heigeo/leaflet.wms -->
<script src="../maps/JS/leaflet.wms.js"></script>

<!-- Logo Credit Plugin: https://github.com/gregallensworth/L.Control.Credits -->
<link rel="stylesheet" href="../maps/CSS/leaflet-control-credits.css" />
<script type="text/javascript" src="../maps/JS/leaflet-control-credits.js"></script>

<style>
    body {
        padding: 0;
        margin: 0;
    }

    html,
    body,
    #map {
        height: 100%;
        position: sticky !important;
    }

</style>
<body style="display: flex">
<div style="width:100%;display:flex;background: #2d3035;">
    <?php include './../layouts/navbar.php'; ?>

    <div class="page-content">
        <div class="page-header no-margin-bottom">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Maps</h2>
            </div>
        </div>
       <div id="map"></div>
    </div>

</div>
<script src="../maps/JS/maps.js" type="text/javascript"></script>
<?php include('./../layouts/footer.php') ?>
</body>

</html>

