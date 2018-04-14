/**
 * Created by Dulaj Ariyaratne on 4/7/2018.
 */

$(document).ready(function () {

    $("form").submit(function(e){
        e.preventDefault();

    });

    // Calling fetch requests function
    fetch_requests();
    fetchEmployeesWidget();


    // Configuring method to insert requests in to database
    $("#requestFormButton").click(function () {
        var request = $("#request").val();
        // This will remove unnessary spaces
        if($.trim(request) != "")
        {
            $.ajax({
                url:"build/submit/requestInsert.php",
                method:"POST",
                data:{request:request},
                dataType:"text",
                success:function (data) {
                    fetch_requests();
                    $("#request").val("");
                },
                error: function(xhr, textStatus, errorThrown){
                    alert(errorThrown);
                }
            });
        }
    });

    $("#requestDelete").click(function () {
        deleteRequest();
    });


    $("#category-form").validate({
        submitHandler: function(form) {
            // some other code
            // maybe disabling submit button
            // then:
            insertCategory(form);
        }
    });


    $("#update-category-form").validate({
        submitHandler: function(formCategory) {
            // some other code
            // maybe disabling submit button
            // then:
            updateCategory(formCategory);
        }
    });

    $("div#myId").dropzone({
        url: "build/submit/upload.php",
        addRemoveLinks: true,
        thumbnailWidth: "100",
        thumbnailHeight: "100",
        dictCancelUpload: "Cancel",
        autoProcessQueue: false,
        autoQueue:true,
        dictDefaultMessage:"Upload a Profile Photo",
        uploadMultiple: false,
        maxFiles:1,
        thumbnailMethod:"contain",
        resizeWidth:100,
        init:function () {
            var myDropZone = this;
            var filename ;
            this.on("success", function(data,response) {
                /* Maybe display some more file information on your page */
               filename = response;
               insertEmployee($("#employee-registration"),filename);
                $('.dz-preview').remove();
                $('.dz-default').show();

            });

            this.on("removedfile",function (file) {

                $.ajax({
                    url: 'build/submit/removeUpload.php?filetodelete='+filename,
                    type: "POST",
                    data: { 'filetodelete': filename}
                });
            });
            $("#employee-registration").validate({
                submitHandler: function(formEmployee) {
                    // some other code
                    // maybe disabling submit button
                    // then:
                    if (myDropZone.files.length == 0){
                        filename = "avatar.png";
                        insertEmployee($("#employee-registration"),filename);
                    }else{
                        // myDropZone.enqueueFile(filename);
                        myDropZone.processQueue();
                    }




                }
            });

        }

    });

    //End of Employee Registration with the dropzone














    // Defining a function to fetching request data from the database
    function fetch_requests() {
        $.ajax({
            url:"build/submit/requestSubmit.php",
            method:"POST",
            success:function (data) {
                $('.to_do').html(data);
                inputBeautify();
                checkboxUpdate();
            },
            error: function(xhr, textStatus, errorThrown){
                alert(errorThrown);
            }
        });
    }

    
    function updateRequest(id,status){
        $.ajax({
            url:"build/submit/requestUpdate.php",
            method:"POST",
            data:{id:id,status:status},
            dataType:"text",
            success:function (data) {
                fetch_requests();
            },
            error: function(xhr, textStatus, errorThrown){
                alert(errorThrown);
            }
        });
    }

    function checkboxUpdate() {
        $('input').on('ifChecked', function(){
            var currentId = $(this).val();
            updateRequest(currentId,1);
        });
        $('input').on('ifUnchecked', function(){
            var currentId = $(this).val();
            updateRequest(currentId,0);
        });
    }

    function deleteRequest() {
        $.ajax({
            url:"build/submit/requestDelete.php",
            method:"POST",
            success:function (data) {
                fetch_requests();
            },
            error: function(xhr, textStatus, errorThrown){
                alert(errorThrown);
            }
        });
    }

    $('#category-name').typeahead({
        source: function(query, result)
        {
            $.ajax({
                url:"build/submit/fetchCategorySearch.php",
                method:"POST",
                data:{query:query},
                dataType:"json",
                success:function(data)
                {

                    result($.map(data, function(item){
                        return item;
                    }));
                }
            });
        },
        autoSelect: false,
        afterSelect:function (item) {
            $.ajax({
                url:"build/submit/updateCategoryCode.php",
                method:"POST",
                data:{query:item},
                dataType:"text json",
                success:function (data1) {
                    $("#category-code").val(data1[0]['cat_code']);
                    $("#category-remarks").val(data1[0]['cat_remarks']);
                }
            });
        }

    });



    // Function to implement iCheckbox
    function inputBeautify() {
        if ( $("input.flat")[0]) {
            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        }

    }

    // Function to Insert category to database
    function insertCategory(form) {
        $.ajax({
            url:"build/submit/categoryInsert.php",
            method:"POST",
            data:$(form).serialize(),
            success:function (data) {
                if(data == "true"){
                    $('#catSuccess').fadeIn('fast').delay(1000).fadeOut('slow');
                    $("#category-name").val("");
                    $("#category-remarks").val("");
                    $.ajax({
                        url:"build/submit/test.php",
                        method:"POST",
                        success:function (data) {
                            $("#category-code").val(data);
                        }
                    });
                }


            }
        });

    }


    // Function to Update category to database

    function updateCategory(form) {
        $.ajax({
            url: "build/submit/categoryUpdate.php",
            method: "POST",
            data: $(form).serialize(),
            success: function (data) {
                alert(data);
            }
        });

    }

    function insertEmployee(form,filename) {
        $.ajax({
            url: "build/submit/insertEmployee.php",
            type: "POST",
            data: $(form).serialize()+'&empThumb='+filename,
            success: function (data) {
                if(data == "true"){
                    $('#empSuccess').fadeIn('fast').delay(1000).fadeOut('slow');
                }
                $.ajax({
                    url:"build/submit/getLastEmpCode.php",
                    method:"POST",
                    success:function (data) {
                        $(form).trigger("reset");
                        $("#empCode").val(data);
                    }
                });

            }
        });
    }

    function fetchEmployeesWidget() {
        $.ajax({
            url:"build/submit/fetchEmployeesWidget.php",
            method:"POST",
            success:function (data) {
                $('#empAllowanceWidget tbody').html(data);
            },
            error: function(xhr, textStatus, errorThrown){
            }
        });
    }




});