<?php

namespace AppBundle\Controller;

use AppBundle\lib\PictureLib;
use Monolog\ErrorHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class PictureController extends Controller
{
	/**
	 * @Route("/upload/image", name="uploadImage")
	 * @Method({"POST"})
	 */
	public function uploadPictures(Request $request){
		if( $request->getMethod() != 'POST' ){
			return new Response("Invalid request method",Response::HTTP_BAD_REQUEST);
		}
		$db = $this->getDoctrine();
		$uploadPath = 'uploads/img/';
		$params = $request->request->all();
		$files = $request->files->get("files");

		if( empty($files) ){
			return new Response("Files Empty",Response::HTTP_BAD_REQUEST);
		}

		foreach( $files as $file ){
			if( !preg_match('/[JPG|PNG|jpg|png]/',$file->getClientOriginalExtension()) ){
				return new Response("Invalid request {$file->getClientOriginalExtension()}",Response::HTTP_BAD_REQUEST);
			}

			$newName = $file->getClientOriginalName() . time() . '.' . $file->getClientOriginalExtension();

			$file->move($uploadPath . 'original/',$newName);
			if( !isset($params['client']) ){
				PictureLib::addPicture($db,$uploadPath, $newName,$params['filter'],NONE,$params['highlight']);
			} else{
				PictureLib::addPicture($db,$uploadPath, $newName,$params['filter'],$params['client'],$params['highlight']);
			}
		}

		return new Response("Success",Response::HTTP_OK);
	}

	/**
	 * @Route("/get/images", name="getImages")
	 */
	public function getPictures(Request $request){

		$type = $request->request->get('type');
		$filter = $request->request->get('filter');
		$pictures = PictureLib::getPicture($this->getDoctrine(),$type,$filter);
		$pictures = json_encode($pictures);
		return new Response($pictures,Response::HTTP_OK);
	}


    /**
     * @Route("/get/categories", name="getCategories")
     */
    public function getCategories(Request $request){
        $categories = PictureLib::getCategories($this->getDoctrine());
        $categories = json_encode($categories);
        return new Response($categories,Response::HTTP_OK);
    }
}