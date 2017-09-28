<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

echo "Successfully Connected to the Server!"."\n";
echo "Listening for any Messages........";

$connection = new AMQPStreamConnection('129.114.104.44', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->exchange_declare('java-exchange', 'topic', false, true, false);
$channel->queue_declare("php-queue", false, true, false, false);
$channel->queue_bind("php-queue", 'java-exchange', 'php-queue');
$callback = function($msg){
    echo 'RoutingKEY:',$msg->delivery_info['routing_key'], ': Requesting: ', $msg->body, "\n";
    if($msg->body == "time"){
        $mytime = Carbon::now();
        $finalTime = $mytime->toDateTimeString();
        echo $finalTime;
        $connection = new AMQPStreamConnection('129.114.104.44', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->exchange_declare("java-exchange","topic",false,true,false);
        $routingKey = "api-queue";
        $msg = new AMQPMessage($finalTime,array('delivery_mode' => 2));
        $channel->basic_publish($msg,"java-exchange",$routingKey);

    }
    else if($msg->body == "userinfo"){
        $result = file_get_contents("http://129.114.104.44:8090/getuserdata");
        $connection = new AMQPStreamConnection('129.114.104.44', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->exchange_declare("java-exchange","topic",false,true,false);
        $routingKey = "api-queue";
        $msg = new AMQPMessage($result,array('delivery_mode' => 2));
        $channel->basic_publish($msg,"java-exchange",$routingKey);

    }
    else {}
};
$channel->basic_consume("php-queue", '', false, true, false, false, $callback);
while(count($channel->callbacks)) {
    $channel->wait();
}

?>