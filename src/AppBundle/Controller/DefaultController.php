<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request){
        // replace this example code with whatever you need
        return $this->render('default/home.html.twig',[
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/gallery", name="gallery")
     */
    public function gallery(Request $request){
        // replace this example code with whatever you need
        return $this->render('default/gallery.html.twig',[
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/album/view/{category}/{filter}", name="album-view")
     */
    public function albumView(Request $request, $category=null, $filter = null){
        // replace this example code with whatever you need
        return $this->render('models/view-album.html.twig',[
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/file/upload", name="upload")
     */
    public function uploadFile(Request $request){
        // replace this example code with whatever you need
        echo UploadedFile::getMaxFilesize();
        return $this->render('admin/file-upload.html.twig',[
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(Request $request){
        return $this->render('default/about.html.twig',[
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);
    }

}
