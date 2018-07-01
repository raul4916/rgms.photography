<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 4/21/16
 * Time: 1:50 PM
 */

namespace AppBundle\lib;

use AppBundle\Entity\Categories;
use Doctrine\Bundle\DoctrineBundle\Registry;

class CategoriesLib{
    static function createCategory(Registry $db,$name,$description = null){
        if(($category = self::getCategory($db,$name))!=null){
            return $category;
        }
        $category = new Categories($name,$description);
        $man = $db->getManager();
        $man->persist($category);
        $man->flush();
        return $category;
    }
    static function createCategories(Registry $db,$names,$descriptions = null){
        $cats = [];
        $i = 0;
        if(isset($descriptions)) {
            foreach ($names as $name) {
                $i++;
                $cats[] = self::createCategory($db, $name, $descriptions[$i]);
            }
        }
        else{
            foreach ($names as $name) {
                $cats[] = self::createCategory($db, $name);
            }
        }
        return $cats;

    }
    static function getCategory(Registry $db,$name){
        $category = $db->getRepository('AppBundle:Categories')->findByName($name);
        if(array_key_exists($category,0))
            return $category[0];
        return null;
    }
    static function getCategories($db,$names){
        $cats = [];
        foreach ($names as $name) {
            $cats[] = self::getCategory($db, $name);
        }
        return $cats;
    }

}