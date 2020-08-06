<?php

namespace App\Controller;

use App\Entity\Hotel;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        /**Methode de DEPENDANCE */
        $repo = $this->getDoctrine()->getRepository(Hotel::class);

        $hotels = $repo->findAll();

        return $this->render('home/index.html.twig', [
            'hotels' => $hotels
        ]);
    }
}
