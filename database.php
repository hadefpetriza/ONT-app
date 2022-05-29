<?php 
    $connect = mysqli_connect('localhost', 'root', '', 'bges');

    // fungsi mengambil data dari database
    function query($query){
        global $connect;

        $result = mysqli_query($connect, $query);

        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    function updateStatusOLT($data, $status){
        global $connect;

        $idOLT = intval($data['id_olt']);

        $query = "UPDATE olt_database SET status = '$status' WHERE id_olt = $idOLT";
        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }

    function updateStatusONT($data, $status){
        global $connect;

        $idOLT = intval($data['id_ont']);

        $query = "UPDATE ont_database SET status = '$status' WHERE id_ont = $idOLT";
        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }

    function updateTextInfo($text){
        global $connect;

        $query = "UPDATE info SET text_info = '$text' WHERE id_info = 1";
        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }

    function sendMessage($pesan){
        $id_bot = "1085134261";
        $id_channel = "-1001618409341";
        // file_get_contents("https://api.telegram.org/bot5195402787:AAGljMCmeYsp2Fy45FtvIdB0ufF5Cd_1UVo/sendMessage?chat_id=$id_bot&text=$pesan");
        file_get_contents("https://api.telegram.org/bot5195402787:AAGljMCmeYsp2Fy45FtvIdB0ufF5Cd_1UVo/sendMessage?chat_id=$id_channel&text=$pesan");
    }
?>  