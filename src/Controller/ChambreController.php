<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Form\ChambreType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\File\UploadedFile;


class ChambreController extends AbstractController
{

    /**
     * Permet de créer une chambre
     * @Route("/hotel/chambre/creation", name="chambre_create")
     */

    public function create(Request $request, ManagerRegistry $manager)
    {
        $cha = new Chambre();
        $form = $this->createForm(ChambreType::class, $cha);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // $file = $cha->getPhotochambre();
            // $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            // $file->move($this->getParameter('upload_directory'), $fileName);
            // $cha->getPhotochambre($fileName);

            // $cchambr = $cha->getComoditeChambre();
            // $cha->getComoditeChambre($cchambr);

            $em = $manager->getManager();
            $em->persist($cha);
            $em->flush();

            $this->addFlash(
                'success',
                "La chambre <strong>N.{$cha->getNumeroChambre()}</strong> a bien été enregistrée !"
            );
        }
        return $this->render('chambre/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/hotel/{slug}/{id}", name="chambre_details")
     * 
     * @return Response
     */
    public function show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Chambre::class);
        $cha = $repo->find($id);

        return $this->render('chambre/show.html.twig', [
            'cha' => $cha
        ]);
    }
}
