<?php

/**
 * @author Waseem Usman <waseemsunktk@gmail.com>
 *
 * Parser class which implements toArray method of JsonResource and create response object, on the basis of structure specified
 * by developer
 **/


include_once 'JsonResource.php';
class RiskIndividualResource extends JsonResource{

    public static function toArray($data){
        return json_encode([
            'title' => 'Risk-Individual' 
            , 'json' => [
                'Result' => $data->Result,
                'Request' => [
                    'RequestID' => $data->Request->RequestID,
                    'UniqueID' => $data->Request->UniqueID,
                    'Status' => $data->Request->Status,
                    'Services' => static::services($data->Request->Services)
                ]
            ]]);
    }

    /**
     * method to handle arrays, right now we have only one array named services, in case of other arrays we have to implement
     * other different method 
    */

    private static function services($services){
        $services_data = [];
        if(count($services) > 0){
            foreach($services as $service){

                /**
                 * This section computes IN00 keys, becoz those keys were in specified pattern
                 */
                $in_codes = [];
                $index = 1;
                $key = 'IN00'.$index;
                while(isset($service->$key)){
                    array_push($in_codes,[
                        $key => $service->$key
                    ]);
                    $index++;
                    $key = $index < 10 ? 'IN00'.$index : 'IN0'.$index;
                }

                /**
                 * This section merge both sections of api response
                 */
                array_push($services_data , array_merge([
                    'Name' => $service->Name,
                    'ServiceID' =>  $service->ServiceID,
                    'Status' =>  $service->Status,
                    'DateTime' => $service->DateTime,
                    'Result' => $service->Result,
                    'Score' => $service->Score,
                    'ReasonCodes' =>[]
                ],$in_codes));
            }
        }

        return $services_data;
    }
}




?>