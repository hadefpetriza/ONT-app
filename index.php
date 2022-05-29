<?php 
    require('database.php');

    $onts = query("SELECT * FROM ont_database");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/icon/telkom.ico" type="image/x-icon">
    <title>BGES : Telkom Witel Sumbar</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="CSS/style.css">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome 5.5.0 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https:/cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css ">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Bootstarp JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Toastr Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>
<body>
    <!-- Header web -->
    <div id="header-web" class="container-fluid">
        <div class="row align-item-center">
            <!-- Title dan logo -->
            <div id="title-header-web" class="col">
                <div class="row align-self-center justify-content-center">
                    <div class="col-2 px-0 mx-1">
                        <img src="img/logo.png" id="logo-web" class="img-fluid">
                    </div>
                    <div class="col align-self-center px-0 mx-1">
                        <h4>BGES : TELKOM SUMBAR</h4>
                    </div>
                </div>
            </div>
            <!-- End Title and logo web -->
            <!-- Navbar web -->
            <div id="navbar-header-web" class="col">
                <ul id="navbar-list" class="list-group list-group-horizontal px-0" style="flex-direction: row;">
                    <a href="#">
                        <li class="list list-group-item home-button"><i class="fas fa-home"></i> Home</li>
                    </a>
                    <a href="#">
                        <li class="list list-group-item showdata-button"><i class="fas fa-database"></i> Show Data</li>
                    </a>
                    <a href="#">
                        <li class="list list-group-item addont-button"><i class="fas fa-plus"></i> Add ONT</li>
                    </a>
                </ul>
            </div>
            <!-- End navbar web -->
        </div>
    </div>
    <!-- End Header Web -->

    <!-- Isi dari web -->
    <div id="content-web" class="container-fluid my-5">
        <div class="row align-item-center justify-content-around">
            <div class="col-11 col-md-8 px-0"  id="content-box">
                <div class="container-sm" id="container-content">

                    <!-- Homepage -->
                    <div id="home-page">
                        <div class="container-fluid py-5">
                            <h2 class="display-6 fw-bold">TELKOM WITEL SUMBAR</h2>
                            <h2 class="display-7 fw-bold">Businnes Goverment and Enterprise Service (BGES)</h2>
                            <br>
                            <h5 style="font-weight: normal;text-align: justify;">Website untuk memudahkan melakukan monitoring, mendetekesi ganguan layanan dan mendata semuan ONT yang digunakan oleh BGES Telkom WITEL SUMBAR</h5>
                            <br>
                            <button class="btn btn-lg btn-outline-danger showdata-button">Let's Start</button>
                        </div>
                    </div>
                    <!-- End Homepage -->

                    <!-- Show Data -->
                    <div id="show-data-page" class="px-0 hidden">
                        <div class="row mx-0">
                            <h1>Database ONT</h1>
                        </div>
                        <div class="row mx-0">
                            <form action="">
                                <div class="d-flex justify-content-end h-100">
                                    <div class="searchbar">
                                        <input type="text" class="search_input" id="search-ont" name="search-ont" placeholder="Masukan data ONT yang dicari" autocomplete="off">
                                        <label for="search-ont"  class="search_icon"><i class="fas fa-search"></i></label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="row mx-0" id="search-result">
                            <!-- search result -->
                        </div>
                    </div>
                    <!-- End Show Data -->

                    <!-- Form Penambahan ONT -->
                    <div id="add-ont-form-page" class="px-0 hidden">
                        <h1>Tambah Data ONT</h1>
                        <form id="add-ont-form" class="py-4">
                            <div class="form-label mb-4">
                                <div class="row align-items-baseline">
                                    <div class="col-2">
                                        <label for="ip_address">IP Address</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="ip_address" id="ip_address" placeholder="IP Address" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-label mb-4">
                                <div class="row align-items-baseline">
                                    <div class="col-2">
                                        <label for="sn_ont">Serial Number</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="sn_ont" id="sn_ont" placeholder="Serial Number ONT" autocomplete="off"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-label mb-4">
                                <div class="row align-items-baseline">
                                    <div class="col-2">
                                        <label for="site_id">Site ID</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="site_id" id="site_id" placeholder="Site ID" autocomplete="off"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-label mb-4">
                                <div class="row align-items-baseline">
                                    <div class="col-2">
                                        <label for="type">Type</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="type" id="type" placeholder="Type" autocomplete="off"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-label mb-4">
                                <div class="row align-items-baseline">
                                    <div class="col-2">
                                        <label for="deskripsi">Alamat</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" autocomplete="off"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-label mb-4">
                                <div class="row align-items-baseline">
                                    <div class="col-2">
                                        <label for="status">Status</label>
                                    </div>
                                    <div class="col">
                                        <select name="status" id="status" class="form-select" required>
                                            <option value="Online">Online</option>
                                            <option value="Offline">Offline</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <button type="button" class="btn btn-primary" id="submit-ont">Simpan</button>
                            </div>
                        </form>
                    </div>
                   <!-- End Form Penambahan Data -->

                </div>
            </div>
            <div class="col-11 col-md-4 px-0" id="terminal">
                <div class="container-sm px-3" id="terminal-container">
                    <h1>Terminal</h1>
                    <div id="terminal-space"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End isi dari web -->
    
    <!-- div untuk fungsi ping -->
    <div id="ping" style="display: none;"></div>
</body>
</html>
<!-- memanggil file javascript -->
<script src="Javascript/script.js"></script> 