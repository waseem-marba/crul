<?php

/**
 * @author Waseem Usman <waseemsunktk@gmail.com>
 *
 * Abstract class to parse response of apis, class contains toArray method, which will be implemented
 * by different parser classes and will implement parse logic there
 **/

abstract class JsonResource{

    abstract protected static function toArray($data);

    public static function jsonResponse($data) {
        return static::toArray(json_decode($data));
    }

}


?>