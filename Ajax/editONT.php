<?php 
    require('../database.php');

    $id = intval($_POST['id_ont']);
    $ip = $_POST['ip_address'];
    $sn = strtoupper($_POST['sn_ont']);
    $site = strtoupper($_POST['site_id']);
    $type = strtoupper($_POST['type']);
    $alamat = strtoupper($_POST['alamat']);
    $status = ucfirst($_POST['status']);

    $query = "UPDATE ont_database SET 
                ip_address_ont = '$ip',
                sn_ont = '$sn',
                site_id = '$site',
                `type` = '$type',
                alamat = '$alamat',
                `status` = '$status',
                last_update = CURRENT_TIMESTAMP
                WHERE id_ont = $id";
    
    mysqli_query($connect, $query);

    echo(mysqli_affected_rows($connect));
?>