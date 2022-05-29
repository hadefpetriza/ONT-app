<?php
    require('database.php');
    // ============================= BEGIN PROGRAM ============================= 
    // fungsi melakukan ping ip address
    function Ping($ip){

        exec("ping -n 1 $ip", $output);

        if(!isset($output[2])){
            updateTextInfo($output[0]);
        }
        else{
            updateTextInfo($output[2]);
        }

        $response = strtolower(implode(' ', $output));
        $response = preg_match('/request timed out/', $response) || preg_match('/failure/i', $response) || preg_match('/host unreachable/i', $response) || preg_match('/could not find host/i', $response);

        return $response;
    }
    
    // while(true){
        // mengambil data ont dari database
        $data_ont = query("SELECT * FROM ont_database");
        
        if(!empty($data_ont)){
            // melakukan ping ke setiap ont yang ada didalam olt
            foreach($data_ont as $ont){
                $id_ont = $ont['id_ont'];
                $ip_ont = $ont['ip_address_ont'];
                $sn_ont = $ont['sn_ont'];
                $site_id = $ont['site_id'];
                $type = $ont['type'];
                $alamat = $ont['alamat'];
                $last = $ont['last_update'];
                    
                // fungsi mereturn true bila ping gagal dan false bila berhasil
                if(Ping($ip_ont)){
                    $status = "Offline";
                    echo"<h4>".$status."</h4>";
                    if($status !== $ont['status']){
                        if(updateStatusONT($ont, $status) > 0){
                            $text = <<<EOT
                            INFORMASI ONT DOWN%0AIP Address : %0A$ip_ont%0ASerial Number : %0A$sn_ont%0ASite ID : %0A$site_id%0ATipe Layanan : %0A$type%0ALokasi ONT : %0A$alamat%0AStatus : %0ATo be Offline%0ALast Update : %0A$last
                            EOT;
                            sendMessage($text);
                        }
                    }
                }
                else{
                    $status = "Online";
                    echo"<h4>".$status."</h4>";
                    if($status !== $ont['status']){
                        if(updateStatusONT($ont, $status) > 0){
                            $text = <<<EOT
                            INFORMASI ONT UP%0AIP Address : %0A$ip_ont%0ASerial Number : %0A$sn_ont%0ASite ID : %0A$site_id%0ATipe Layanan : %0A$type%0ALokasi ONT : %0A$alamat%0AStatus : %0ATo be Online%0ALast Update : %0A$last
                            EOT;
                            sendMessage($text);
                        }
                    }
                }
                sleep(1);
            }
        }
    // }
    sleep(5);   
?>