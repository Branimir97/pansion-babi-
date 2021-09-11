<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gallery/{_locale}")
 */
class GalleryController extends AbstractController
{
    /**
     * @Route(name="gallery")
     */
    public function index(): Response
    {
        return $this->render('gallery/index.html.twig');
    }
}