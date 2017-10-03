<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="/css/fa/css/font-awesome.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="blue-grey lighten-5">
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
</body>
<script src="/js/jquery/jquery.min.js"></script>
<script src="/css/materialize/js/materialize.min.js"></script>
<script>
$(document).ready(function() {

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
                        "<td><a class='fa fa-lg fa-pencil' href='/api/items" +data[i].id+ "'></a></td>"+
                        "<td><a class='fa fa-lg fa-trash' href='/api/items" +data[i].id+ "'></a></td>";
            }
            $("#tbl_items").append(output);
            
        }
    });


}); //end of document.ready
</script>
</html>