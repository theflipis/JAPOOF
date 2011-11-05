<?php

namespace lib\Reflection;
use \ReflectionClass as RfC;
use \ReflectionProperty as RfP;


class Reflector
{
    public static function serializeObject($object, $dataAdapter)
    {
        /*$objectJSON = array();
        $aData = self::makeExposableObject($object);
        for($i=0;$i<count($aData);$i++)
        {
            $propertyValue = $aData[$i]["PROPERTY"]->getValue($object);
            $objectJSON[$aData[$i]["NAME"]] = $propertyValue;
        }
        return json_encode($objectJSON, JSON_FORCE_OBJECT);
        */       
        return json_encode($object, JSON_FORCE_OBJECT);
    }    

    public static function unserializeObject($object, $jsonData)
    {
        $object = json_decode($jsonData);
        /*
         $jsonObj = json_decode($jsonData);           
         $aData = self::makeExposableObject($object);    
            
        for($i=0;$i<count($aData);$i++)
        {                
            if(is_object($jsonObj->$aData[$i]["NAME"]))
            {                    
                $newValue = (array)$jsonObj->$aData[$i]["NAME"];
                $aData[$i]["PROPERTY"]->setValue($object, $newValue);
            }
            else
            {
                //echo $value;
                $aData[$i]["PROPERTY"]->setValue($object, $jsonObj->$aData[$i]["NAME"]);
            }
        }*/
    }   
    
    private static function makeExposableObject($object)
    {
        $aReturn = array();
        $cReflector = new RfC($object);
        $props = $cReflector->getProperties(RfP::IS_PUBLIC | RfP::IS_PROTECTED | RfP::IS_PRIVATE);
        for($i=0;$i<count($props);$i++)
        {
            if($props[$i]->isProtected())
            {
                $props[$i]->setAccessible(true);
            }
            if($props[$i]->isPrivate())
            {
                $props[$i]->setAccessible(true);
            }
            $aReturn[$i]["NAME"] = $props[$i]->getName();
            $aReturn[$i]["VALUE"] = $props[$i]->getValue($object);
            $aReturn[$i]["PROPERTY"] = $props[$i];
        }        
        return $aReturn;
    }
}