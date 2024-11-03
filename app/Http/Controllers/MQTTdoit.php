<?php

namespace App\Http\Controllers;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Jobs\DoMqttsubscribe;
class MQTTdoit extends Controller
{
    public $data;
    public function dosomething()
    {

        DoMqttsubscribe::dispatch();


        
       

    }

}
