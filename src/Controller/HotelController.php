<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\Chambre;
use App\Form\HotelType;
use App\Repository\HotelRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HotelController extends AbstractController
{
    /**
     * Permet de créer un hotel
     * 
     *@Route("/hotel/creation", name="hotel_creation")
    */

    public function create(Request $request, ManagerRegistry $manager)
    {
        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);  
        
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $manager->getManager();
            $em->persist($hotel);
            $em->flush();

            $this->addFlash(
                'success',
                "L'hotel <strong>{$hotel->getNom()}</strong> a bien été enregistrée !"
            );
            
            return $this->redirectToRoute('hotel_show', [
                'slug' => $hotel->getSlug()
            ]);

        }


        return $this->render('hotel/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * Permet d'afficher un Hotel et ses offres
     * @Route("/hotel/{slug}" , name="hotel_show")
     * 
     * @return Response
     */
    public function show(Hotel $hotels)
    {
        // Permet de recuperer l'hotel qui correspond au slug  
        // $hotels = $repo->findOneBySlug($slug); // on peut soit utiliser cette methode pour recuperer les 
        // hotels soit utiliser la methode de ParamConverter comme sait fait
        // $chambre = $repo->findAll($chambre);

        return $this->render('hotel/show.html.twig', [
            'hotel' => $hotels,
            // 'chambre' => $chambre,
            
        ]);
    }

}
