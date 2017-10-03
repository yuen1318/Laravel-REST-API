<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/materialize/css/materialize.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h4>Materialize Madafaka</h4>
    <div id="items">
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
                output += "<li>" + data[i].text +" "+ data[i].body;
            }
            $("#items").append(output);
            
        }
    });


}); //end of document.ready
</script>
</html>