// Halaman Index
$(document).ready(function() {
    $('#ping').load('action.php');

    // inisiate height terminal
    setTimeout(function(){
        $('#terminal-container').css({
            "height" : `${$('#container-content')[0].scrollHeight}px`
        })
    }, 100);
    // end inisiate height terminal

    // semua data ont
    $.post("home.php", function(result){
        $('#search-result').html(result);
    });
    // end semua data ont

    // update terminal
    let last = "";
    
    setInterval(function(){
        let status = $.ajax({
                        type: 'POST',       
                        url: "Ajax/getInfo.php",
                        dataType: 'text',
                        global: false,
                        async:false,
                        success: function(data) {
                            return data;
                        }
                    }).responseText;
        if(last != status){
            $('#terminal-space').append('<p class="my-0">'+status+'</p>');
            setTimeout(function(){
                $('p').css(
                    "opacity", "1"
                )
            }, 10)
        }
        $('#terminal-space').scrollTop($('#terminal-space')[0].scrollHeight);

        last = status;
    }, 100);
    // end update terminal

    // delete data berlebih pada terminal
    setInterval(function(){
        if($('p').last()[0].offsetTop >= 1500){
            $('p').first().remove();
        }
    }, 1000);
    // end delete data belebih pada terminal


    // menambahkan data ont ke database secara asyncron
    $('#submit-ont').click(function(){
        let data = $('#add-ont-form').serialize();
        console.log(data);
        $.ajax({
            url: 'Ajax/addONT.php',
            method: 'POST',
            data: data,
            success: function(response){
                console.log(response);
                if(response >= 1){
                    toastr["success"]("Data berhasil ditambahkan", "Notification")
                    $('.showdata-button').click();
                    $('#add-ont-form')[0].reset()
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
    // end menambahkan data
    
    
    // get data from search
    $('#search-ont').keyup(function(){
        let keyword = $(this).val();
        $.post("home.php",{keyword : keyword}, function(result){
            $('#search-result').html(result);
        });
    });
    // end get data from search
    
    $('.home-button').on('click', function(){
        $('#home-page').removeClass('hidden');
        $('#show-data-page').addClass('hidden');
        $('#add-olt-form-page').addClass('hidden');
        $('#add-ont-form-page').addClass('hidden');
        $('#terminal')[0].scrollHeight;
        $('#terminal-container').css({
            "height" : `${$('#container-content')[0].scrollHeight}px`
        })
    });
    $('.showdata-button').on('click', function(){
        $('#home-page').addClass('hidden');
        $('#show-data-page').removeClass('hidden');
        $('#add-olt-form-page').addClass('hidden');
        $('#add-ont-form-page').addClass('hidden');
        $('#terminal')[0].scrollHeight;
        $('#terminal-container').css({
            "height" : `${$('#container-content')[0].scrollHeight}px`
        })
        $.post("home.php", function(result){
            $('#search-result').html(result);
        });
    });
    $('.addont-button').on('click', function(){
        $('#home-page').addClass('hidden');
        $('#show-data-page').addClass('hidden');
        $('#add-olt-form-page').addClass('hidden');
        $('#add-ont-form-page').removeClass('hidden');
        $('#terminal')[0].scrollHeight;
        $('#terminal-container').css({
            "height" : `${$('#container-content')[0].scrollHeight}px`
        })
    });
});
