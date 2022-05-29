<?php 
    require('../database.php');

    $id = intval($_POST['id']);
    $data = query("SELECT * FROM ont_database WHERE id_ont = $id")[0];

    $ip = $data['ip_address_ont'];
    $sn = strtoupper($data['sn_ont']);
    $site = strtoupper($data['site_id']);
    $type = strtoupper($data['type']);
    $alamat = strtoupper($data['alamat']);

    $move = "INSERT INTO deleted_data VALUE (NULL, '$ip', '$sn', '$site', '$type', '$alamat', CURRENT_TIMESTAMP)";
    mysqli_query($connect, $move);

    if(mysqli_affected_rows($connect) > 0){
        $query = "DELETE FROM ont_database WHERE id_ont = $id";
        mysqli_query($connect, $query);
    }
    print(mysqli_affected_rows($connect));
?>