<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MicroService Client</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
    .space {
        padding-top: 5%;
        padding-bottom: 5%;
    }
    .right-space {
        padding-right: 1%;
    }
    .soft-space {
        padding-top: 1%;
        padding-bottom: 1%;
    }
    </style>

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
        $("#laravel-java").click(function(){
            $.ajax({url: "http://localhost:8000/getuserinfo", dataType:'json', success: function(result){
                var res = JSON.stringify(result);
                $("#div1").html(res);
            }});
        });

        $("#javahello").click(function(){
            $.ajax({url: "http://localhost:8080/hello", success: function(result){
                $("#div2").html(result);
            }});
        });
        $("#python").click(function(){
            $.ajax({url: "http://localhost:5000", success: function(result){
                $("#div3").html(result);
            }});
        });

        $("#pythoncars").click(function(){
            $.ajax({url: "http://localhost:5000/cars", dataType:'json', success: function(result){
                var res = JSON.stringify(result);
                $("#div3").html(res);
            }});
        });

    });
    </script>
</head>

<div class="container-fluid navHead" id="mainNav" style="padding-top: 25px; padding-bottom: 25px;">
    <h2>Welcome to the MicroService Client.</h2>
    <button class="btn btn-primary" id="laravel-java">Get user data from Java Server Database through Laravel</button><span class="right-space"></span>
    <button class="btn btn-success" id="laravel">Get Current Time From Laravel MicroService</button><br>
    <div class="soft-space"></div>
    <button class="btn btn-primary" id="java">Get Greetings from Java SpringBoot MicroService</button>
    <span class="right-space"></span>
    <button class="btn btn-success" id="javahello">Say Hello to the MicroService.</button><br>
    <div class="soft-space"></div>
    <button class="btn btn-primary" id="python">Get Greetings from Python MicroService</button>
    <span class="right-space"></span>
    <button class="btn btn-success" id="pythoncars">Get Cars as Json from Python Server</button><br>
    <div class="space"></div>
    <div id="div1"><h2>Laravel Microservice Updates this block.</h2></div><br>
    <div id="div2"><h2>Java Microservice updates this block.</h2></div><br>
    <div id="div3"><h2>Python Microservice updates this block.</h2></div>

</div>




</body>
</html>
