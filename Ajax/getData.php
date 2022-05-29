<?php 
    require('../database.php');

    $id = intval($_POST['id']);

    $data = query("SELECT * FROM ont_database WHERE id_ont = $id")[0];
    echo(json_encode($data));
?>