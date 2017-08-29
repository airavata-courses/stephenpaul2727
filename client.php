<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MicroService Client</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function(){
        $("#laravel").click(function(){
            $.ajax({
                url: "http://localhost:8000/time",
                success: function(result){
                    $("#div1").html(result);
                }
            });
        });
        $("#java").click(function(){
            $.ajax({url: "http://localhost:8080/", success: function(result){
                $("#div2").html(result);
            }});
        });
        $("#javahello").click(function(){
            $.ajax({url: "http://localhost:8080/hello", success: function(result){
                $("#div2").html(result);
            }});
        });

    });
    </script>
</head>

<div class="container-fluid navHead" id="mainNav" style="padding-top: 25px; padding-bottom: 25px;">
    <h2>Welcome to the MicroService Client.</h2>
    <button id="laravel">Get Current Time From Laravel MicroService</button>
    <button id="java">Get Greetings from Java SpringBoot MicroService</button>
    <button id="javahello">Say Hello to the MicroService.</button>


    <div id="div1"><h2>Laravel Microservice Updates this block.</h2></div>
    <div id="div2"><h2>Java Microservice updates this block.</h2></div>
</div>




</body>
</html>
