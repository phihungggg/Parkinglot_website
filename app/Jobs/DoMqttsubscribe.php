<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use PhpMqtt\Client\Facades\MQTT;
use App\Models\Slot;
use Illuminate\Support\Facades\DB;

class DoMqttsubscribe implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void //invoked when the job is processed by the queue
    {
        echo "Xin chao";

        $mqtt = Mqtt::connection();

        if ($mqtt->isConnected()) {
           // $mqtt->publish('something/st', 'test', 0);

            // Subscribe to the topic
            $mqtt->subscribe('v3/parkinglot-greenstream@ttn/devices/slot-1/up',
                function (string $topic, string $message) use ($mqtt) {
                   
                  
                  //  echo sprintf("\n \n \n Received QoS level 0 message on topic [%s]: %s", $topic, $message);


                    $data = json_decode($message, true);
                
                    // Check if decoding was successful and retrieve the decoded payload
                    if (isset($data['uplink_message']['decoded_payload']['Payload'])) {
                        $decodedPayload = $data['uplink_message']['decoded_payload']['Payload'];
                        echo sprintf(" \n \n \n Decoded payload: %s", $decodedPayload);

                        $lastCharacter = substr($decodedPayload, -1);
                        $sixthCharacter = substr($decodedPayload, 5, 1);
                        $lastNumber = (int)$lastCharacter;
                        $sixthNumber = (int)$sixthCharacter;
                        $slot = Slot::where('slot_id', 0)->first();
                        $slot4 = Slot::where('slot_id',3)->first();
DB::beginTransaction();
try {
    $slot->slot_status = $sixthNumber;
    $slot->save();
    $slot4->slot_status = $lastNumber;
    $slot4->save();
    DB::commit();
} catch (\Exception $e) {
    DB::rollBack();
    echo "Failed to update slot status: " . $e->getMessage();
}

                        echo sprintf("\n something %d ",$lastNumber);
                    } else 
                        echo "No decoded payload found.";
                }, 0
            );




            $mqtt->subscribe('v3/parkinglot-greenstream@ttn/devices/slot-3/up',
            function (string $topic, string $message) use ($mqtt) {
               
              
              //  echo sprintf("\n \n \n Received QoS level 0 message on topic [%s]: %s", $topic, $message);


                $data = json_decode($message, true);
            
                // Check if decoding was successful and retrieve the decoded payload
                if (isset($data['uplink_message']['decoded_payload']['Payload'])) {
                    $decodedPayload = $data['uplink_message']['decoded_payload']['Payload'];
                    echo sprintf(" \n \n \n Decoded payload: %s", $decodedPayload);

                    $lastCharacter = substr($decodedPayload, -1);
                    $sixthCharacter = substr($decodedPayload, 5, 1);
                    $lastNumber = (int)$lastCharacter;
                    $sixthNumber = (int)$sixthCharacter;
                    $slot3 = Slot::where('slot_id', 2)->first();
                    $slot6 = Slot::where('slot_id', 5)->first();
                    
DB::beginTransaction();
try {
$slot3->slot_status = $sixthNumber;
$slot3->save();
$slot6->slot_status = $lastNumber;
$slot6->save();
DB::commit();
} catch (\Exception $e) {
DB::rollBack();
echo "Failed to update slot status: " . $e->getMessage();
}

                    echo sprintf("\n something %d ",$lastNumber);
                } else 
                    echo "No decoded payload found.";
            }, 0
        );




        $mqtt->subscribe('v3/parkinglot-greenstream@ttn/devices/slot-2222/up',
        function (string $topic, string $message) use ($mqtt) {
           
          
          //  echo sprintf("\n \n \n Received QoS level 0 message on topic [%s]: %s", $topic, $message);


            $data = json_decode($message, true);
        
            // Check if decoding was successful and retrieve the decoded payload
            if (isset($data['uplink_message']['decoded_payload']['Payload'])) {
                $decodedPayload = $data['uplink_message']['decoded_payload']['Payload'];
                echo sprintf(" \n \n \n Decoded payload: %s", $decodedPayload);

                $lastCharacter = substr($decodedPayload, -1);
                $sixthCharacter = substr($decodedPayload, 5, 1);
                $lastNumber = (int)$lastCharacter;
                $sixthNumber = (int)$sixthCharacter;
                $slot2 = Slot::where('slot_id', 1)->first();
                $slot5 = Slot::where('slot_id', 4)->first();
                
DB::beginTransaction();
try {
$slot2->slot_status = $sixthNumber;
$slot2->save();
$slot5->slot_status = $lastNumber;
$slot5->save();
DB::commit();
} catch (\Exception $e) {
DB::rollBack();
echo "Failed to update slot status: " . $e->getMessage();
}

                echo sprintf("\n something %d ",$lastNumber);
            } else 
                echo "No decoded payload found.";
        }, 0
    );


            // Run loop in a non-blocking way
         
            $mqtt->loop(true);
        } 
    }
}
