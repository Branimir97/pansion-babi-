<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends AbstractController
{
//    /**
//     * @Route({
//     *     "hr": "/galerija",
//     *     "en": "/gallery",
//     *     "it": "/galleria",
//     *     "de": "/galerie"
//     * }, name="gallery")
//     */
    #[Route("/gallery", name: "gallery")]
    public function index(): Response
    {
        return $this->render('gallery/index.html.twig');
    }
}
