<?php

namespace RocketStartup\Components\Support;
use Exception;

class Facade
{   
    public static $instance = [];
 
    private function __construct()
    {
        
    }
 
    public static function getInstance($object=null,$parms=null)
    {   
        if(is_string($object)){
            return self::returnInstance($object);
        }

        
        $object['key']      =  $object[0];
        $object['class']    =  (isset($object[1])?$object[1]:$object[0]);

        
        if(isset($object) && is_array($object) && class_exists($object['class'])){
            if (!isset(self::$instance[$object['key']])) {
                self::$instance[$object['key']] = new $object['class']($parms);
            }
            return self::returnInstance($object['key']);
        }
        throw new \Exception('Facade Instance <b>'.$object['class'].'</b> not found.');
    }

    private static function returnInstance($stringKey=null){

            if (isset(self::$instance[$stringKey])) {
                return self::$instance[$stringKey];
            }else{
                throw new \Exception('Facade returnInstance <b>'.$stringKey.'</b> not found.');
            }
    }
}
