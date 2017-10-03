<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="/css/materialize/css/animate.css">
    <link rel="stylesheet" href="/css/fa/css/font-awesome.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>


<body class="blue-grey lighten-5">

    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper blue lighten-1">
                <a href="#" class="brand-logo center">Laravel REST API</a>
            </div>
        </nav>
    </div>
        


    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">

            <table class="bordered centered responsive-table striped">
                <thead>
                    <tr>
                    <th class="hide">ID</th>
                    <th>Text</th>
                    <th>Body</th>
                    <th colspan="2">Action</th>
                    </tr>
                </thead>
                <!--end of thead-->

                <tbody id="tbl_items"></tbody>
                <!--end of tbody-->
            </table>
            <!--end of table-->


            </div>
        </div>
    </div>

    <div class="row">
      <div class="fixed-action-btn vertical">
        <a href="#modal_add" class="modal-trigger btn-floating btn-large blue lighten-1 btn tooltipped waves-effect" data-position="left"
          data-delay="50" data-tooltip="Add Items">
          <span class="fa fa-plus fa-lg"></span>
          </a>
      </div>
    </div>

    <!-- Modal Add -->
    <div id="modal_add" class="modal">

        <form id="frm_add_items">
            <div class="modal-content">

                <h5>Add items</h5><br>

                <div class="row">
                    <div class="col s12 m6 l6 input-field">
                        <label for="text">Text</label>
                        <input type="text" id="text" name="text">
                    </div>
                    <div class="col s12 m6 l6 input-field">
                        <label for="body">Body</label>
                        <input type="text" id="body" name="body">
                    </div>
                </div>


            </div>
        </form>

        <div class="modal-footer">
            <button class="btn waves-effect blue lighten-1" id="btn_add_items">Ok</button>
        </div>
    </div>

        <!-- Modal Delete -->
        <div id="modal_delete" class="modal">

        <form id="frm_delete_items">
            <div class="modal-content">

                <h5>Delete item</h5><br>
                <p>Are you sure you want to delete this item?</p>
                <div class="row hide">
                    <div class="col s12 m6 l6">
                        <label for="id">ID</label>
                        <input type="text" id="did" name="id">
                    </div>
                    <div class="col s12 m6 l6">
                        <label for="_method">Method</label>
                        <input type="text" id="_dmethod" name="_method">
                    </div>
                </div>


            </div>
        </form>

        <div class="modal-footer">
            <button class="btn waves-effect blue lighten-1" id="btn_delete_items">Ok</button>
        </div>
    </div>

            <!-- Modal Update -->
    <div id="modal_update" class="modal">

        <form id="frm_update_items">
            <div class="modal-content">

                <h5>Update item</h5><br>

                <div class="row hide">
                    <div class="col s12 m6 l6">
                        <label for="id">ID</label>
                        <input type="text" id="uid" name="id">
                    </div>
                    <div class="col s12 m6 l6">
                        <label for="_method">Method</label>
                        <input type="text" id="_umethod" name="_method">
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m6 l6 input-field">
                        <label for="text">Text</label>
                        <input type="text" id="text" name="text">
                    </div>
                    <div class="col s12 m6 l6 input-field">
                        <label for="body">Body</label>
                        <input type="text" id="body" name="body">
                    </div>
                </div>


            </div>
        </form>

        <div class="modal-footer">
            <button class="btn waves-effect blue lighten-1" id="btn_update_items">Ok</button>
        </div>
    </div>

</body>
<script src="/js/jquery/jquery.min.js"></script>
<script src="/js/jquery/jquery.validate.min.js"></script>
<script src="/js/jquery/jquery.additionalMethod.min.js"></script>
<script src="/css/materialize/js/materialize.min.js"></script>
<script>
$(document).ready(function() {
    $('.modal').modal();

    getData();
    
    $('#btn_add_items').on('click', function () { //validate on btn click
        if ($("#frm_add_items").valid()) { //check if all field is valid
            addData();
        } else {
            $('.val').addClass('animated bounceIn');
            $('.val').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
            $('.val').removeClass('animated');
            });
        } //end of else   
    }); //end of btn click

    $('#btn_update_items').on('click', function () { //validate on btn click
        if ($("#frm_update_items").valid()) { //check if all field is valid
            var id = $('#uid').val();
            $.ajax({
                type: "POST",
                url: "http://localhost:8000/api/items/"+id,
                data: $("#frm_update_items").serialize(),
                dataType: "text",
                success: function (response) {
                    $('.modal').modal('close');
                    getData();
                    $('#frm_update_items')[0].reset();
                }
            });
        } else {
            $('.val').addClass('animated bounceIn');
            $('.val').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
            $('.val').removeClass('animated');
            });
        } //end of else   
    }); //end of btn click

    $('#btn_delete_items').on('click', function () { //validate on btn click
        var id = $('#did').val();
        $.ajax({
            type: "POST",
            url: "http://localhost:8000/api/items/"+id,
            data: $("#frm_delete_items").serialize(),
            dataType: "text",
            success: function (response) {
                $('.modal').modal('close');
                getData();
            }
        });
    }); //end of btn click

    $(document).on('click', '.i_delete', function () {
         //bind html5 data attributes to variables
         var id = $(this).attr('data-delete-id');
         //set values to id
         $('#did').val(id);
         $('#_dmethod').val("DELETE");
         //show modal
         $('#modal_delete').modal('open');
     }); //end of onclick

     $(document).on('click', '.i_update', function () {
         //bind html5 data attributes to variables
         var id = $(this).attr('data-update-id');
         //set values to id
         $('#uid').val(id);
         $('#_umethod').val("PUT");
         //show modal
         $('#modal_update').modal('open');
     }); //end of onclick


    $("#frm_add_items").validate({ //form validation
        rules: {
            text: {
                required: true
            },
            body: {
                required: true
            },
        }, //end of rules

        messages: {
            text: {
                required: "<small class='right val red-text'>This field is required</small>"
            },
            body: {
                required: "<small class='right val red-text'>This field is required</small>"
            }
        }, //end of messages

        errorElement: 'div',
        errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            } //end of errorElement
    }); //end of validate

    $("#frm_update_items").validate({ //form validation
        rules: {
            text: {
                required: true
            },
            body: {
                required: true
            },
        }, //end of rules

        messages: {
            text: {
                required: "<small class='right val red-text'>This field is required</small>"
            },
            body: {
                required: "<small class='right val red-text'>This field is required</small>"
            }
        }, //end of messages

        errorElement: 'div',
        errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            } //end of errorElement
    }); //end of validate





}); //end of document.ready

function getData(){
    $.ajax({
        type: "GET",
        url: "http://localhost:8000/api/items",
        contentType: "application/json",
        dataType: "json",
        success: function (data) {  
            var output="";

            for(i=0; i<data.length; i++){

                output += "<tr>"+ 
                        "<td class='hide'>"+ data[i].id +"</td>"+
                        "<td>"+ data[i].text +"</td>"+
                        "<td>"+ data[i].body +"</td>"+
                        "<td><a class='fa fa-lg fa-pencil i_update' href='#' data-update-id='" +data[i].id+ "'></a></td>"+
                        "<td><a class='fa fa-lg fa-trash i_delete' href='#' data-delete-id='" +data[i].id+ "'></a></td>";
            }
            $("#tbl_items").html(output);
            
        }
    });
}//end of function


function addData(){
    $.ajax({
        type: "POST",
        url: "http://localhost:8000/api/items",
        data: $("#frm_add_items").serialize(),
        dataType: "text",
        success: function (response) {
            $('.modal').modal('close');
            getData();
            $('#frm_add_items')[0].reset();
        }
    });
}







</script>
</html>