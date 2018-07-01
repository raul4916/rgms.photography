<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 4/21/16
 * Time: 1:51 PM
 */

namespace AppBundle\lib;

use AppBundle\Entity\Channels;
use AppBundle\Entity\Locations;
use AppBundle\Tools\Tools;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\Query\QueryException;

class LocationsLib{

    static function createLocation(Registry $db,$country,$state,$city){
        if(($location = self::getLocations($db,$country.$state.$city))!=null){
            return $location;
        }
        $location = new Locations($country,$state,$city);
        $man = $db->getManager();
        $man->persist($location);
        $man->flush();
        return $location;
    }

    static function getLocations($db, $loc)
    {
        $id = Tools::str_to_int($loc);
        $location = $db->getRepository('AppBundle:Locations')->findById($id);
        if(array_key_exists(0,$location))
            return $location[0];
        return null;
    }

}