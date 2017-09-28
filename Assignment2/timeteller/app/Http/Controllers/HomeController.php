<?php
/**
 * Created by PhpStorm.
 * User: stephenpaul
 * Date: 29/08/17
 * Time: 12:25 AM
 */
namespace App\Http\Controllers;

use Carbon\Carbon;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "HELLO FROM LARAVEL";
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTime()
    {
        $mytime = Carbon::now();
        return $mytime->toDateTimeString();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserInfo()
    {
        $result = json_decode(file_get_contents("http://129.114.104.44:8090/getuserdata"));
        return response()->json($result);
    }

    /**
     * Send Messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveUserRabbit()
    {
        $user_name = "Prudhvi";
        $user_email = "prudacha@iu.edu";
        $user_phone = "8129551384";
        $finalString = "{$user_name}-{$user_email}-{$user_phone}";
        $connection = new AMQPStreamConnection('129.114.104.44','5672','guest','guest');
        // $connection = new AMQPStreamConnection('localhost','5672','guest','guest');
        $channel = $connection->channel();
        $channel->exchange_declare("java-exchange","topic",false,true,false);
        $routingKey = "java";
        $msg = new AMQPMessage($finalString,array('delivery_mode' => 2));
        $channel->basic_publish($msg,"java-exchange",$routingKey);
        $channel->close();
        $connection->close();
        return "SENT USER INFORMATION THROUGH RABBITMQ to JAVA SERVER!";

    }

    /**
     * Send Messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendTimeRabbit()
    {
        echo "I'm currently inside sendtimeRabbit";
        $mytime = Carbon::now();
        $connection = new AMQPStreamConnection('129.114.104.44','5672','guest','guest');
        // $connection = new AMQPStreamConnection('localhost','5672','guest','guest');
        $channel = $connection->channel();
        $channel->exchange_declare("api-exchange","topic",false,true,false);
        $routingKey = "api-queue";
        $msg = new AMQPMessage($mytime->toDateTimeString(),array('delivery_mode' => 2));
        $channel->basic_publish($msg,"api-exchange",$routingKey);
        $channel->close();
        $connection->close();
        return "SENT TIME BACK THROUGH RABBIT";

    }

    /**
     * Listening Messages.
     *
     */
    public function listenUserRabbit()
    {
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
        return "";
    }



}
