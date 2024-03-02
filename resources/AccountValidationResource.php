<?php

/**
 * @author Waseem Usman <waseemsunktk@gmail.com>
 *
 * Parser class which implements toArray method of JsonResource and create response object, on the basis of structure specified
 * by developer
 **/

include_once 'JsonResource.php';
class AccountValidationResource extends JsonResource{

    public static function toArray($data){
        return json_encode([
            'title' => 'account-validation' 
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
                array_push($services_data , [
                    'Name' => $service->Name,
                    'ServiceID' =>  $service->ServiceID,
                    'Status' =>  $service->Status,
                    'DateTime' => $service->DateTime,
                    'Result' => $service->Result,
                    'ResultCode' => $service->ResultCode,
                    'Message' => $service->Message
                ]);
            }
        }

        return $services_data;
    }
}




?>