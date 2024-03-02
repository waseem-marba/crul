<?php

/**
 * @author Waseem Usman <waseemsunktk@gmail.com>
 *
 * Class to handle only curl get requests, Token is optional for protected apis. If token is passed to constructor then it will be integrated
 * as Bearer token other wise request will send with out token
 **/

class Http{

    private $httpClient;
    private $options = [];
    private $data = [];
    private $token = '';

    /**
     *  Constructor to initialize curl handler, with optional token parameter,
     * if token is passed then it will be added to options array property 
    */
    public function __construct($token = ''){

        $this->httpClient = curl_init();
        $this->setOption(CURLOPT_RETURNTRANSFER,true);
        if(!empty($token)){
            $authorization = "Authorization: Bearer $token";
            $this->setOption(CURLOPT_HTTPHEADER,array('Content-Type: application/json' , $authorization ));
        }

    }

    /**
     *  method to add single option for curl 
    */

    public function setOption($option , $value){
        if(!empty($option))
            $this->options[$option] = $value;
    }

    /**
     * Method to add options array 
    */
    public function setOptions($options){
        if(count($options) > 0 && array_keys($options) !== range(0, count($options) - 1))
            foreach($options as $option => $value)
                $this->options[$option] = $value;
    }

    /**
     * method which will bind options array property to curl handler before calling api, and will return
     * error and response result 
    */
    public function exec(){
        curl_setopt_array($this->httpClient,$this->options);
        $result = curl_exec($this->httpClient);
        $error = curl_error($this->httpClient);
        return [
            'error' => $error,
            'response' => $result
        ];
    }

    /**
     *  method to handle only get requests
     */
    public function get($url){
        $this->setOption(CURLOPT_URL , $url);
        return $this->exec();
    }



    /**
     * method to release resources after completing curl lifecycle 
    */
    public function __destruct(){
        curl_close($this->httpClient);
    }
}


?>