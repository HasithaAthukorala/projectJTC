/**
 * Created by Dulaj Ariyaratne on 4/7/2018.
 */

$(document).ready(function () {

    $("form").submit(function(e){
        e.preventDefault();

    });

    // Calling fetch requests function
    fetch_requests();


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
        submitHandler: function(form) {
            // some other code
            // maybe disabling submit button
            // then:
            updateCategory(form);
        }
    });















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
                url:".build/submit/fetchCategorySearch.php",
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
                $("#category-name").val("");
                $("#category-remarks").val("");
                var currentCode = $("#category-code").val();
                $("#category-code").val(++currentCode);
            }
        });

    }


    // Function to Update category to database

    function updateCategory(form) {
        $.ajax({
            url:"build/submit/categoryUpdate.php",
            method:"POST",
            data:$(form).serialize(),
            success:function (data) {
               alert(data);
            }
        });

    }




});