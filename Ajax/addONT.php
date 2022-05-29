<?php
    require('../database.php');

    $ip = $_POST['ip_address'];
    $sn = strtoupper($_POST['sn_ont']);
    $site = strtoupper($_POST['site_id']);
    $type = strtoupper($_POST['type']);
    $alamat = strtoupper($_POST['alamat']);
    $status = ucfirst($_POST['status']);

    $query = "INSERT INTO ont_database VALUE(NULL, '$ip', '$sn', '$site', '$type', '$alamat', '$status', CURRENT_TIMESTAMP)";

    mysqli_query($connect, $query);
    
    print(mysqli_affected_rows($connect));
?>