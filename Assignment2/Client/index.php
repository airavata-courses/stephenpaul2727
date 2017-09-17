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
                url: "http://0.0.0.0:2500/laraveltime",
                success: function(result){
                    $("#div1").html(result);
                }
            });
        });
        $("test-api").click(function(){
            $.ajax({url: "http://0.0.0.0:2500/",success: function(result){
                $("#div4").html(result);
            }});
        })
        $("#java").click(function(){
            $.ajax({url: "http://0.0.0.0:2500/javahome", success: function(result){
                $("#div2").html(result);
            }});
        });
        $("#laravel-java").click(function(){
            $.ajax({url: "http://0.0.0.0:2500/getjavadataphp", dataType:'json', success: function(result){
                var res = JSON.stringify(result);
                $("#div1").html(res);
            }});
        });

        $("#javahello").click(function(){
            $.ajax({url: "http://0.0.0.0:2500/javahello", success: function(result){
                $("#div2").html(result);
            }});
        });
        $("#python").click(function(){
            $.ajax({url: "http://0.0.0.0:2500/getjavadata", success: function(result){
                $("#div3").html(result);
            }});
        });

        $("#pythoncars").click(function(){
            $.ajax({url: "http://0.0.0.0:2500/flaskcars", dataType:'json', success: function(result){
                var res = JSON.stringify(result);
                $("#div3").html(res);
            }});
        });

    });
    </script>
</head>

<div class="container-fluid navHead" id="mainNav" style="padding-top: 25px; padding-bottom: 25px;">
    <h2>Welcome to the MicroService Client.</h2>
    <button class="btn btn-warning" id="test-api">Test API Server Connection</button>
    <button class="btn btn-primary" id="laravel-java">Get user data from Java Server Database through Laravel</button><span class="right-space"></span>
    <button class="btn btn-success" id="laravel">Get Current Time From Laravel MicroService</button><br>
    <div class="soft-space"></div>
    <button class="btn btn-primary" id="java">Get Greetings from Java SpringBoot MicroService</button>
    <span class="right-space"></span>
    <button class="btn btn-success" id="javahello">Say Hello to the MicroService.</button><br>
    <div class="soft-space"></div>
    <button class="btn btn-primary" id="python">Get User data from Java Server Database through python flask.</button>
    <span class="right-space"></span>
    <button class="btn btn-success" id="pythoncars">Get Cars as Json from Python Server</button><br>
    <div class="space"></div>
    <div id="div4"><h2>-----CONNECTION STATUS------</h2></div><br>
    <div id="div1"><h2>Laravel Microservice Updates this block.</h2></div><br>
    <div id="div2"><h2>Java Microservice updates this block.</h2></div><br>
    <div id="div3"><h2>Python Microservice updates this block.</h2></div>

</div>




</body>
</html>
