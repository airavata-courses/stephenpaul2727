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
        $result = json_decode(file_get_contents("http://localhost:8080/getuserdata"));
        return response()->json($result);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveUserRabbit()
    {
        $user_name = "Prudhvi";
        $user_email = "prudacha@iu.edu";
        $user_phone = "8129551384";
        $finalString = "{$user_name}-{$user_email}-{$user_phone}";
        $connection = new AMQPStreamConnection('localhost','5672','guest','guest');
        $channel = $connection->channel();
        $channel->exchange_declare("java-exchange","topic",false,true,false);
        $routingKey = "java-queue";
        $msg = new AMQPMessage(serialize($finalString),array('content_type' => 'text/plain','delivery_mode' => 2));
        $channel->basic_publish($msg,"java-exchange",$routingKey);
        $channel->close();
        $connection->close();
        return "SENT USER INFORMATION THROUGH RABBITMQ to JAVA SERVER!";

    }
}