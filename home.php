<?php 
    require('database.php');

    $query = "SELECT * FROM ont_database ORDER BY id_ont DESC LIMIT 0, 10";

    if(isset($_POST['keyword'])){
        $keyword = strtoupper($_POST['keyword']);
        $query = "SELECT * FROM ont_database WHERE
                    ip_address_ont LIKE '%$keyword%' OR
                    site_id LIKE '%$keyword%' OR
                    `type` LIKE '%$keyword%' OR
                    alamat LIKE '%$keyword%'";
    }

    $onts = query($query);
?>
<!-- <link rel="stylesheet" href="CSS/style.css"> -->
<head>
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
<style>
    .modal-content{
        border-top: .5em solid red;
        border-radius: 0;
    }
    #save-changes{
        color: white;
        background-color: red;
        border-color: red;
        border-radius: 0;
    }
    #save-changes:hover{
        background-color: rgb(184, 14, 14);
    }
</style>
<table class="table table-dark table-striped" style="font-size: .8em;">
    <thead class="text-center">
        <th scope="col">No</th>
        <th scope="col">IP Address</th>
        <th scope="col">Serial Number</th>
        <th scope="col">Site ID</th>
        <th scope="col">Tipe</th>
        <th scope="col">Alamat</th>
        <th scope="col">Status</th>
        <th scope="col">Last Updated</th>
        <th scope="col">Action</th>
    </thead>
    <?php if(!empty($onts)) : ?>
        <?php $no = 1;?>
        <?php foreach($onts as $ont) : ?>
        <tbody>
            <td class="text-center align-middle py-1"><?= $no; ?></td>
            <td class="text-center align-middle py-1"><?= $ont['ip_address_ont']; ?></td>
            <td class="text-center align-middle py-1"><?= $ont['sn_ont']; ?></td>
            <td class="text-center align-middle py-1"><?= $ont['site_id']; ?></td>
            <td class="text-center align-middle py-1"><?= $ont['type']; ?></td>
            <td class="align-middle py-1"><?= $ont['alamat']; ?></td>
            <td class="text-center align-middle py-1"><?= $ont['status']; ?></td>
            <td class="text-center align-middle py-1"><?= $ont['last_update']; ?></td>
            <td  class="text-center align-middle py-1">
                <div class="container-fluid">
                    <div class="col">
                        <div class="row">
                            <button type="btn btn-primary" class="edit-data" data-bs-toggle="modal" data-bs-target="#editModal" data-id-ont="<?= $ont['id_ont']; ?>" ><img src="img/icon/edit.svg"></button>
                        </div>
                        <div class="row mt-1">
                            <button type="btn btn-primary" class="delete-data" data-id-ont="<?= $ont['id_ont']; ?>"><img src="img/icon/trash.svg"></button>
                        </div>
                    </div>
                </div>
            </td>
        </tbody>
        <?php $no++; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <tbody>
        <td colspan="12" align="center"> Data tidak ditemukan</td>
    </tbody>
    <?php endif?>
</table>

<!-- Modal -->
<div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editDataMOdal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editDataMOdal">Edit Data ONT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- End Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                
            </div>
            <!-- End Modal Body -->

            <!-- Modal Footer -->
            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="row">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="save-changes">Simpan</button>
                    </div>
                </div>
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary" id="save-changes">Save changes</button> -->
            </div>
            <!-- End Modal Footer -->
        </div>
    </div>
</div>


<script>
    // edit data
    $('.edit-data').click(function(data){
        let idOnt = $(this).data("id-ont");
        console.log(idOnt);
        $.post('Ajax/getData.php', {id : idOnt}, function(result){
            const detail = editForm($.parseJSON(result));
            $('.modal-body').html(detail);
        })

    })
    
    $('#save-changes').click(function(){
        let data = $('#edit-ont-form').serialize();
        $.ajax({
            url: 'Ajax/editONT.php',
            method: 'POST',
            data: data,
            success: function(response){
                console.log(response);
                
                if(response >= 1){
                    toastr["success"]("Data berhasil di simpan", "Notification");
                }
                $.post("home.php", function(result){
                    $('#search-result').html(result);
                });
            },
            error: function(e){
                console.log(e.responseText);
            }
        });
    })
    // end edit data

    // delete data
    $('.delete-data').click(function(data){
        let idOnt = $(this).data("id-ont");
        console.log(idOnt);
        $.ajax({
            url: 'Ajax/delONT.php',
            method: 'POST',
            data: {
                'id' : idOnt
            },
            success: function(response){
                if(response >= 1){
                    console.log('delete data berhasil');
                    toastr["success"]("Data berhasil dihapus", "Notification")
                }
                $.post("home.php", function(result){
                    $('#search-result').html(result);
                });
            },
            error: function(e){
                console.log(e.responseText);
            }
        });
    });
    // end delete data
    

    function editForm(data){
        return `<div class="container-fluid">
                    <form id="edit-ont-form" class="my-4">
                        <input type="hidden" id="id_ont" name="id_ont" value=${data.id_ont}>
                        <div class="form-label mb-4">
                            <div class="row align-items-baseline">
                                <div class="col-2">
                                    <label for="ip_address">IP Address</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="ip_address" id="ip_address" value="${data.ip_address_ont}" placeholder="IP Address" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-label mb-4">
                            <div class="row align-items-baseline">
                                <div class="col-2">
                                    <label for="sn_ont">Serial Number</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="sn_ont" id="sn_ont" value="${data.sn_ont}" placeholder="Serial Number ONT" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-label mb-4">
                            <div class="row align-items-baseline">
                                <div class="col-2">
                                    <label for="site_id">Site ID</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="site_id" id="site_id" value="${data.site_id}" placeholder="Site ID" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-label mb-4">
                            <div class="row align-items-baseline">
                                <div class="col-2">
                                    <label for="type">Type</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="type" id="type" value="${data.type}" placeholder="Type" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-label mb-4"> 
                            <div class="row align-items-baseline">
                                <div class="col-2">
                                    <label for="deskripsi">Alamat</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="alamat" id="alamat" value="${data.alamat}" placeholder="Alamat" autocomplete="off" required>
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
                                        <option value="Online" ${data.status == 'Online' ? 'selected' : ''}>Online</option>
                                        <option value="Offline" ${data.status == 'Offline' ? 'selected' : ''}>Offline</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>`;
    }
    function confirm(data){
        return ``;
    }
</script>