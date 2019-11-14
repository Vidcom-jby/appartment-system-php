$(document).ready(function () {

// Select all links with hashes
    $('a[href*="#"]')
    // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function(event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function() {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
            }
        });

    $('#submit_contact_form').on('click',function(e){
        e.preventDefault();

        var error = "";
        var post_data = {
            'name':$("#name").val(),
            'email': $("#email").val(),
            'phone': $("#phone").val(),
            'message': $("#message").val()
        };

        if (post_data.name == "" && post_data.email == "" && post_data.phone == "" && post_data.message == "") {
            error = "<div class='error_title'>Please complete all fields</div>";
            $('#name').addClass('error');
            $('#email').addClass('error');
            $('#phone').addClass('error');
            $('#message').addClass('error');
        }
        if (post_data.name == "") {
            error = "<div class='error_title'>Please complete all of the required fields</div>";
            $('#name').addClass('error');
        }
        else {
            $('#name').removeClass('error');
        }
        if (post_data.email == "") {
            error = "<div class='error_title'>Please complete all of the required fields</div>";
            $('#email').addClass('error');
        }
        else {
            $('#email').removeClass('error');
        }
        if (post_data.phone == "") {
            error = "<div class='error_title'>Please complete all of the required fields</div>";
            $('#phone').addClass('error');
        }
        else {
            $('#phone').removeClass('error');
        }
        if (post_data.message == "") {
            error = "<div class='error_title'>Please complete all of the required fields</div>";
            $('#message').addClass('error');
        }
        else {
            $('#message').removeClass('error');
        }

        if (!error == "") {
            e.preventDefault();
            bootbox.alert(error);
        }
        else {

            $('#name').removeClass('error');
            $('#email').removeClass('error');
            $('#phone').removeClass('error');
            $('#message').removeClass('error');
            $('#submit_contact_form').html('<img src="images/process_loader.gif" /> &nbsp; <em>sending email...</em>').prop('disabled', true);

            $.ajax({
                "type": "POST",
                "url": "contact_process.php",
                "data": post_data,
                "dataType": "json"
            }).done(function (response) {
                setTimeout(function () {
                    if ((response.error) && (response.error.caption!=="")) {
                        $('#submit_contact_form').html('SUBMIT').prop({'disabled': false});
                        $('#'+response.error_field+'').addClass('error');
                        bootbox.alert("<div class='error_title'>"+response.error.caption+"</div><div>"+response.error.text+"</div>");
                    }
                    else{
                        $('#name').removeClass('error');
                        $('#email').removeClass('error');
                        $('#phone').removeClass('error');
                        $('#message').removeClass('error');
                        if((response.success) && response.success==="sent"){
                            setTimeout(function () {
                                $('#submit_contact_form').html('SUBMIT').prop({'disabled': false});
                                bootbox.alert("<br><div class='alert alert-success text-center'>Your Contact was successfully Sent! We will get back to you shortly</div>");
                                document.getElementById("contact_form").reset();
                            },3000);
                        }
                    }
                },800);

            }).fail(function (response) {
                  $('#submit_contact_form').html('SUBMIT').prop({'disabled': false});
              bootbox.alert("An error occurred while processing your request, please try again later");
            });
        }
    });
    $('#submit_login_form').on('click',function(e){
            e.preventDefault();
            var error = "";
            var post_data = {
                'matric_number':$("#matric_number").val(),
                'email': $("#email").val(),
                'password': $("#password").val(),
            };
            if($('#user_group').val().toUpperCase()===("administrator").toUpperCase()) {
                  if ((post_data.email == "") && post_data.password == "") {
                        error = "<div class='error_title'>Please complete all fields</div>";
                        $('#password').addClass('error');
                        $('#email').addClass('error');
                  }
                  if (post_data.password == "") {
                        error = "<div class='error_title'>Please complete all of the required fields</div>";
                        $('#password').addClass('error');
                  }
                  else {
                        $('#password').removeClass('error');
                  }
                  if (post_data.email == "") {
                        error = "<div class='error_title'>Please complete all of the required fields</div>";
                        $('#email').addClass('error');
                  }
                  else {
                        $('#email').removeClass('error');
                  }
            }else{
                  if (post_data.matric_number == "" && post_data.password == "") {
                        error = "<div class='error_title'>Please complete all fields</div>";
                        $('#password').addClass('error');
                        $('#matric_number').addClass('error');
                  }
                  if (post_data.password == "") {
                        error = "<div class='error_title'>Please complete all of the required fields</div>";
                        $('#password').addClass('error');
                  }
                  else {
                        $('#password').removeClass('error');
                  }
                  if (post_data.matric_number == "") {
                        error = "<div class='error_title'>Please complete all of the required fields</div>";
                        $('#matric_number').addClass('error');
                  }
                  else {
                        $('#matric_number').removeClass('error');
                  }
            }
            if (!error == "") {
                e.preventDefault();
                bootbox.alert(error);
            }
            else {
                 $('#matric_number').removeClass('error');
                $('#email').removeClass('error');
                $('#password').removeClass('error');
                $('#login_form').submit();
            }
        });


    $('#submit_news_form').on('click',function(e){
        e.preventDefault();

        var error = "";
        var post_data = {
            'email': $("#newsletter").val()
        };

        if (post_data.email == "") {
            error = "<div class='error_title'>Please enter your Email</div>";
            $('#newsletter').addClass('error');
        }
        else {
            $('#newsletter').removeClass('error');
        }

        if (!error == "") {
            e.preventDefault();
            bootbox.alert(error);
        }
        else {
            $('#newsletter').removeClass('error');

            $(this).html('<img src="images/process_loader.gif" /> &nbsp; <em>signing up...</em>').prop('disabled', true);

            $.ajax({
                "type": "POST",
                "url": "newsletter.php",
                "data": post_data,
                "dataType": "json"
            }).done(function (response) {
                setTimeout(function () {
                    if ((response.error) && (response.error.caption!=="")) {
                        $('#submit_news_form').html('SIGN UP').prop({'disabled': false});
                        $('#'+response.error_field+'').addClass('error');
                        bootbox.alert("<div class='error_title'>"+response.error.caption+"</div><div>"+response.error.text+"</div>");
                    }
                    else{

                        $('#newsletter').removeClass('error');
                        if((response.success) && response.success==="sent"){
                            setTimeout(function () {
                                $('#submit_news_form').html('SIGN UP').prop({'disabled': false});
                                bootbox.alert("<br><div class='alert alert-success text-center'>Thank you for Signing Up. We will keep you updated <br>with our latest News/Articles</div>");
                                document.getElementById("news_form").reset();
                            },3000);
                        }
                    }
                },800);

            }).fail(function (response) {
              bootbox.alert("Failed to Submit: "+response.status+"\n try again later");
                $('#submit_news_form').html('SIGN UP').prop({'disabled': false});
            });
        }
    });

      var add_image_src = "";
      var photo_image_first_time = true;
      if($('[name="teller_image_uploaded"]')[0] && $('[name="teller_image_uploaded"]').val() != ""){
            add_image_src = $('[name="teller_image_uploaded"]').val();
      } else if($('[name="teller_image_http"]')[0] && $('[name="teller_image_http"]').val() != ""){
            add_image_src = $('[name="teller_image_http"]').val();
      }
      var teller_file_change = false;
      if($('#teller_image_editor')[0]) {
            $('#teller_image_editor').cropit({
                  imageState: {
                        src: add_image_src
                  },
                  minZoom: 'fill',
                  maxZoom: 3,
                  height: 250,
                  width: 320,
                  onFileChange: function () {
                        $('#teller_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        $('#teller_image_editor.image-editor').find(".cropit-preview").show();
                        $('#teller_image_editor.image-editor').find(".image-size-label").show();
                        $('#teller_image_editor.image-editor').find(".controls-wrapper").show();
                        teller_file_change = true;
                  },
                  onImageLoaded: function () {
                        $('#teller_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        $('#teller_image_editor.image-editor').find(".cropit-preview").show();
                        $('#teller_image_editor.image-editor').find(".image-size-label").show();
                        $('#teller_image_editor.image-editor').find(".controls-wrapper").show();
                        photo_image_first_time = false;
                        var image_dim=$('#teller_image_editor.image-editor').cropit('imageSize');
                        console.log(image_dim);
                        $('#teller_image_editor').cropit('previewSize', { width: image_dim.width, height: image_dim.height});
                        $('#teller_upload_modal .modal-dialog').css({'width':(image_dim.width+100)+'px','max-width':+(image_dim.width+100)+'px'});

                  },
                  onImageError: function () {
                        if (photo_image_first_time) {
                              alert('An error occurred loading your image\n\nYour image may have been deleted or is invalid\n\nTo avoid seeing this message please upload a valid image!');
                              photo_image_first_time = false;
                        } else {
                              alert('An error occurred loading your image\n\nplease select a jpg, png or gif image that is not smaller/larger than 320 X 250');
                        }
                        teller_file_change = false;
                        $("input[name='teller_image_uploaded']").val("");
                        $('#teller_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        $('#teller_image_editor.image-editor').find(".cropit-preview").hide();
                        $('#teller_image_editor.image-editor').find(".image-size-label").hide();
                        $('#teller_image_editor.image-editor').find(".controls-wrapper").hide();
                  },
                  onFileReaderError: function () {
                        teller_file_change = false;
                        alert('An error occurred loading your image\n\nplease select a jpg, png or gif image');
                        $("input[name='teller_image_uploaded']").val("");
                        $('#teller_image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        $('#teller_image_editor.image-editor').find(".cropit-preview").hide();
                        $('#teller_image_editor.image-editor').find(".image-size-label").hide();
                        $('#teller_image_editor.image-editor').find(".controls-wrapper").hide();
                  }
            });
      }
      $("#upload_teller_photo").off('click').on('click',function(e) {
            e.preventDefault();
            $("#teller_upload_modal").modal('show');
      });

      $("#teller_continue_upload").off('click').on('click',function(e) {
            e.preventDefault();
            if ($("#teller_image_editor .cropit-preview").hasClass("cropit-image-loaded")) {
                  var imageData = $('#teller_image_editor.image-editor').cropit('export', {type: 'image/jpg', quality: 1.0});
            }
            $("#teller_thumbnail img").attr("src",imageData);
      });
      if($("input[name='teller_image_uploaded']").val() !=""){
            teller_file_change=true;
            $("#teller_thumbnail img").attr("src",$("input[name='teller_image_uploaded']").val());
      }else if($("input[name='teller_image_http']").val() !=""){
            teller_file_change=true;
            $("#teller_thumbnail img").attr("src",$("input[name='teller_image_http']").val());
      }
      $("#teller_form").on("submit", function() {
            if ($("#teller_image_editor .cropit-preview").hasClass("cropit-image-loaded")) {
                  var imageData = $('#teller_image_editor.image-editor').cropit('export', {
                        type: 'image/jpg',
                        quality: 1.0,
                        originalSize: true
                  });
                  $("#teller_image_uploaded").val(imageData);
            }
      });



      var add_image_src = "";
      var photo_image_first_time = true;
      if($('[name="image_uploaded"]')[0] && $('[name="image_uploaded"]').val() != ""){
            add_image_src = $('[name="image_uploaded"]').val();
      } else if($('[name="image_http"]')[0] && $('[name="image_http"]').val() != ""){
            add_image_src = $('[name="image_http"]').val();
      }
      var file_change = false;
      if($('#image_editor')[0]) {
            $('#image_editor').cropit({
                  imageState: {
                        src: add_image_src
                  },
                  minZoom: 'fill',
                  maxZoom: 3,
                  height: 250,
                  width: 250,
                  onFileChange: function () {
                        $('#image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        $('#image_editor.image-editor').find(".cropit-preview").show();
                        $('#image_editor.image-editor').find(".image-size-label").show();
                        $('#image_editor.image-editor').find(".controls-wrapper").show();
                        file_change = true;
                  },
                  onImageLoaded: function () {
                        $('#image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        $('#image_editor.image-editor').find(".cropit-preview").show();
                        $('#image_editor.image-editor').find(".image-size-label").show();
                        $('#image_editor.image-editor').find(".controls-wrapper").show();
                        photo_image_first_time = false;
                  },
                  onImageError: function () {
                        if (photo_image_first_time) {
                              alert('An error occurred loading your image\n\nYour image may have been deleted or is invalid\n\nTo avoid seeing this message please upload a valid image!');
                              photo_image_first_time = false;
                        } else {
                              alert('An error occurred loading your image\n\nplease select a jpg, png or gif image that is not smaller/larger than 320 X 250');
                        }
                        file_change = false;
                        $("input[name='image_uploaded']").val("");
                        $('#image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        $('#image_editor.image-editor').find(".cropit-preview").hide();
                        $('#image_editor.image-editor').find(".image-size-label").hide();
                        $('#image_editor.image-editor').find(".controls-wrapper").hide();
                  },
                  onFileReaderError: function () {
                        file_change = false;
                        alert('An error occurred loading your image\n\nplease select a jpg, png or gif image');
                        $("input[name='image_uploaded']").val("");
                        $('#image_editor.image-editor').find(".cropit-image-zoom-input").show();
                        $('#image_editor.image-editor').find(".cropit-preview").hide();
                        $('#image_editor.image-editor').find(".image-size-label").hide();
                        $('#image_editor.image-editor').find(".controls-wrapper").hide();
                  }
            });
      }
      $("#upload_photo").off('click').on('click',function(e) {
            e.preventDefault();
            $("#upload_modal").modal('show');
      });
      $(".form-check-input").iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
            increaseArea: '2%'
      });
      $("#continue_upload").off('click').on('click',function(e) {
            e.preventDefault();
            if ($("#image_editor .cropit-preview").hasClass("cropit-image-loaded")) {
                  var imageData = $('#image_editor.image-editor').cropit('export', {type: 'image/jpg', quality: 1.0});
            }
            $("#thumbnail img").attr("src",imageData);
      });
      if($("input[name='image_uploaded']").val() !==""){
            file_change=true;
            $("#thumbnail img").attr("src",$("input[name='image_uploaded']").val());
      }else if($("input[name='image_http']").val() !==""){
            file_change=true;
            $("#thumbnail img").attr("src",$("input[name='image_http']").val());
      }
      $("#reg_form").on("submit", function() {
            if ($("#image_editor .cropit-preview").hasClass("cropit-image-loaded")) {
                  var imageData = $('#image_editor.image-editor').cropit('export', {
                        type: 'image/jpg',
                        quality: 1.0,
                        originalSize: true
                  });
                  $("#image_uploaded").val(imageData);
            }
      });


      /***** Custom Select Initialization     *****/
      if ($('.custom-select').length > 0) {
            $('.custom-select').select2();
      }
      if ($('#dept_list_data_table')[0]) {
            var oTable1 = $('#dept_list_data_table').dataTable({
                  dom: 'Bfrtip',
                  buttons: [{
                        text: 'copy',
                        extend: "copy",
                        exportOptions: {
                              columns: [0, 1, 2, 3, 4]
                        },
                        className: 'btn dark btn-outline'
                  }, {
                        text: 'csv',
                        extend: "csv",
                        exportOptions: {
                              columns: [0, 1, 2, 3, 4]
                        },
                        className: 'btn aqua btn-outline'
                  }, {
                        text: 'excel',
                        extend: "excel",
                        exportOptions: {
                              columns: [0, 1, 2, 3, 4]
                        },
                        className: 'btn aqua btn-outline'
                  }, {
                        text: 'pdf',
                        extend: "pdf",
                        exportOptions: {
                              columns: [0, 1, 2, 3, 4]
                        },
                        className: 'btn yellow  btn-outline'
                  }, {
                        text: 'print',
                        extend: "print",
                        exportOptions: {
                              columns: [0, 1, 2, 3, 4]
                        },
                        className: 'btn purple  btn-outline'
                  }],
                  "sPaginationType": "full_numbers",
                  "bProcessing": true,
                  "sProcessing": "loading...",
                  "iDisplayLength": 50,
                  "aLengthMenu": [[25, 50, 100, 250, -1], [25, 50, 100, 250, "All"]],
                  "bServerSide": false,
                  "oLanguage": {
                        "sSearch": "Search",
                        "sLengthMenu": "_MENU_ records per page",
                        "sProcessing": "Loading &nbsp;<img src='/images/process_loader.gif' />"
                  },
                  "aaSorting": [[0, 'desc']],

                  "deferRender": true,
                  "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        $('td:eq(0)', nRow).addClass('center');
                        $('td:eq(1)', nRow).addClass('center');
                        $('td:eq(2)', nRow).addClass('center');
                        $('td:eq(3)', nRow).addClass('center');
                  },
                  'fnDrawCallback': function (settings) {
                        if ($('.page-container [data-toggle="tooltip"]')[0]) {
                              $('.page-container [data-toggle="tooltip"]').tooltip();
                        }
                  }
            });
            //$.fn.dataTable.KeyTable(oTable1);
      }


      /***CHECK FOR USER_AGENT BROWSERS  ***/
      var userAgent = navigator.userAgent;
      var msie = userAgent.indexOf('MSIE ');// for IE <= version 10
      var trident = userAgent.indexOf('Trident/'); //for IE 11
      var edge = userAgent.indexOf('Edge/'); //for IE 12+
      var is_internet_explorer, is_firefox;
      var isChrome = /Chrome/.test(userAgent) && /Google Inc/.test(navigator.vendor);
      var isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;

      if (msie > -1 || trident > -1 || edge > -1) {
            is_internet_explorer = true;
      } else {
            is_internet_explorer = false;
      }
      if (userAgent.indexOf('Firefox') > -1) {
            is_firefox = true;
      } else {
            is_firefox = false;
      }
      var is_safari = ( /^((?!chrome|android).)*safari/i.test(userAgent));
      /****END ***/

      $('body').on('click','.modal_action_btn',function(){
            var location_url=!_.isEmpty($(this).data('location_url'))?$(this).data('location_url'):'';
            var message=!_.isEmpty($(this).data('message'))?$(this).data('message'):'';
            bootbox.confirm({
                  title: "Online Student Registration System",
                  message: ""+message,
                  buttons: {
                        confirm: {
                              label: 'Yes',
                              className: 'btn-primary'
                        },
                        cancel: {
                              label: 'No',
                              className: 'btn-danger'
                        }
                  },
                  callback: function (result) {
                        if(result && !_.isEmpty(location_url)){
                              location.href=location_url;
                        }
                  }
            });
      });
      $(".state_lists").off("change").on("change", function (e) {
            var lgas = window.lgas;
            var that = this;
            $(this).parents('form').find('.lga_list').html('<option value="">Select LGA*</option>');
            if ($(this).val() !== "" && lgas[$(this).val()]) {
                  $.each(lgas[$(this).val()], function (k, v) {
                        $(that).parents('form').find('.lga_list').append('<option value="' + v + '">' + v + '</option>');
                  });
            }
            setTimeout(function () {
                  $(that).parents('form').find('.lga_list').find('.lga_list').select2();
                  $(that).select2();
            });
      });

      var check_all=false;
      $('.check_all').on('ifChecked', function () {

                  $("input[type='checkbox']").each(function () {
                        if (!$(this).is(':checked') && !($(this).hasClass('check_all'))) {
                              $(this).iCheck('check');
                        }
                  });


      }).on('ifUnchecked', function () {
            $("input[type='checkbox']").each(function () {
                  if ($(this).is(':checked') && !($(this).hasClass('check_all'))) {
                        $(this).iCheck('uncheck');
                  }
            });
      });


      function number_format (number, decimals, dec_point, thousands_sep) {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                  prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                  sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                  dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                  s = '',
                  toFixedFix = function (n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                  };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                  s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                  s[1] = s[1] || '';
                  s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
      }
});
