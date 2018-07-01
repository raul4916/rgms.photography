<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 12/27/16
 * Time: 11:28 AM
 */

namespace AppBundle\lib;

require_once "define.php";

use AppBundle\Entity\Picture;
use Doctrine\Bundle\DoctrineBundle\Registry;

class PictureLib
{
    static function addPicture(Registry $db,$dir,$imgName,$category,$client = NONE,$highlight = false){
        $man = $db->getManager();
        $img = new \Imagick($dir."original/".$imgName);
        $scaleFullRes = .4;
        $scale = 800;
        $imgLength = $img->getImageWidth();
        $imgHeight = $img->getImageHeight();
        $img->setInterlaceScheme(\Imagick::INTERLACE_PLANE);
        switch ($img->getImageOrientation()) {
            case \Imagick::ORIENTATION_TOPLEFT:
                $img->resizeImage(( $imgLength * $scaleFullRes),($imgHeight * $scaleFullRes),\Imagick::FILTER_CATROM,1);
                $img->writeImage($dir . 'full-res/'. $imgName);
                $img->resizeImage(((800*$imgLength)/$imgHeight),800,\Imagick::FILTER_CATROM,1);

                break;
            case \Imagick::ORIENTATION_TOPRIGHT:
                $img->flopImage();
                $img->resizeImage(( $imgLength * $scaleFullRes),($imgHeight * $scaleFullRes),\Imagick::FILTER_CATROM,1);

                $img->writeImage($dir . 'full-res/'. $imgName);
                $img->resizeImage(((800*$imgLength)/$imgHeight),800,\Imagick::FILTER_CATROM,1);

                break;
            case \Imagick::ORIENTATION_BOTTOMRIGHT:
                $img->rotateImage("#000", 180);
                $img->resizeImage(( $imgLength * $scaleFullRes),($imgHeight * $scaleFullRes),\Imagick::FILTER_CATROM,1);
                $img->writeImage($dir . 'full-res/'. $imgName);
                $img->resizeImage(((800*$imgLength)/$imgHeight),800,\Imagick::FILTER_CATROM,1);

                break;
            case \Imagick::ORIENTATION_BOTTOMLEFT:
                $img->flopImage();
                $img->rotateImage("#000", 180);
                $img->resizeImage(( $imgLength * $scaleFullRes),($imgHeight * $scaleFullRes),\Imagick::FILTER_CATROM,1);
                $img->writeImage($dir . 'full-res/'. $imgName);
                $img->resizeImage(((800*$imgLength)/$imgHeight),800,\Imagick::FILTER_CATROM,1);

                break;
            case \Imagick::ORIENTATION_LEFTTOP:
                $img->flopImage();
                $img->rotateImage("#000", -90);
                $img->resizeImage(( $imgLength * $scaleFullRes),($imgHeight * $scaleFullRes),\Imagick::FILTER_CATROM,1);
                $img->writeImage($dir . 'full-res/'. $imgName);
                $img->resizeImage(( $imgHeight* $scale),($imgLength * $scale),\Imagick::FILTER_CATROM,1);


                break;
            case \Imagick::ORIENTATION_RIGHTTOP:
                $img->rotateImage("#000", 90);
                $img->resizeImage(( $imgLength * $scaleFullRes),($imgHeight * $scaleFullRes),\Imagick::FILTER_CATROM,1);
                $img->writeImage($dir . 'full-res/'. $imgName);
                $img->resizeImage(( $imgHeight* $scale),($imgLength * $scale),\Imagick::FILTER_CATROM,1);

                break;
            case \Imagick::ORIENTATION_RIGHTBOTTOM:
                $img->flopImage();
                $img->rotateImage("#000", 90);
                $img->resizeImage(( $imgLength * $scaleFullRes),($imgHeight * $scaleFullRes),\Imagick::FILTER_CATROM,1);
                $img->writeImage($dir . 'full-res/'. $imgName);
                $img->resizeImage(( $imgHeight* $scale),($imgLength * $scale),\Imagick::FILTER_CATROM,1);

                break;
            case \Imagick::ORIENTATION_LEFTBOTTOM:
                $img->rotateImage("#000", -90);
                $img->resizeImage(( $imgLength * $scaleFullRes),($imgHeight * $scaleFullRes),\Imagick::FILTER_CATROM,1);
                $img->writeImage($dir . 'full-res/'. $imgName);
                $img->resizeImage(( $imgHeight* $scale),($imgLength * $scale),\Imagick::FILTER_CATROM,1);

                break;
            default: // Invalid orientation
                $img->resizeImage(( $imgLength * $scaleFullRes),($imgHeight * $scaleFullRes),\Imagick::FILTER_CATROM,1);
                $img->writeImage($dir . 'full-res/'. $imgName);
                $img->resizeImage(((800*$imgLength)/$imgHeight),800,\Imagick::FILTER_CATROM,1);
                break;
        }

        $img->writeImage($dir . 'display/' . $imgName);
        $picture = new Picture($dir,$imgName,date('Y-m-d H:i:s'),$category,$client,$highlight);
        $man->persist($picture);
        $man->flush();
    }

    static function getPicture(Registry $db,$type = 'category',$filter = null){
        switch($type){
            case "category":
                $pictures = $db->getRepository('AppBundle:Picture')->findAll();
                $filterArr = explode(',',$filter);

                foreach( $pictures as $key=>$picture ){
                    $categories = explode(',',$picture->getCategory());
                    foreach( $filterArr as $filterT ){
                        if( array_search($filterT,$categories) !== false ){
                            $result[] = $pictures[$key];
                        }
                    }
                }
                break;
            case "filepath":
                $result = $db->getRepository('AppBundle:Picture')->findByFilepath($filter)[0];
                break;

            case "client":
                $result = $db->getRepository('AppBundle:Picture')->findByClient($filter);
                break;

            case "date":
                $result = $db->getRepository('AppBundle:Picture')->findByDate($filter);
                break;

            case "highlights":
                $result = $db->getRepository('AppBundle:Picture')->findByHighlight('true');
                break;

            default:
                $result = $db->getRepository('AppBundle:Picture')->findAll();
        }
        if(isset($result)){
            return self::toArray($result);
        }else{
            return [];
        }
    }

    private static function toArray($pictures){
        $result = [];

        foreach( $pictures as $picture ){
            $temp = [];
            $temp['categories'] = $picture->getCategory();
            $temp['client'] = $picture->getClient();
            $temp['dir'] = $picture->getDir();
            $temp['imageName'] = $picture->getImageName();
            $temp['date'] = $picture->getDate();
            $temp['highlight'] = $picture->getHighlight();

            $result[] = $temp;
        }

        return $result;
    }

    static function addCategory(Registry $db,$filepath,$newCategories){
        $picture = self::getPicture($db,"filepath",$filepath);
        $categories = explode($picture->getCategory(),',');
        $newCategories = explode($newCategories,',');
        foreach( $newCategories as $category ){
            if( array_search($categories,$categories) === false ){
                $categories[] = $category;
            }
        }
        $categories = implode($categories,',');
        $picture->setCategory($categories);
    }

    static function removeCategory(Registry $db,$filepath,$removeCategories){
        $picture = self::getPicture($db,"filepath",$filepath);
        $categories = explode($picture->getCategory(),',');
        $removeCategories = explode($removeCategories,',');
        foreach( $removeCategories as $category ){
            if( ($index = array_search($category,$categories)) !== false ){
                unset($categories[$index]);
            }
        }
        $categories = implode($categories,',');
        $picture->setCategory($categories);
    }
    static function getCategories($db){
        $pictures = $db->getRepository('AppBundle:Picture')->findAll();
        $categories = [];
        foreach( $pictures as $key=>$picture ) {
            $cat = $picture->getCategory();
            $arr = explode(",", $cat);
            foreach ($arr as $val) {

                $categories[$val] = true;
            }
        }

        return array_keys($categories);


    }
}