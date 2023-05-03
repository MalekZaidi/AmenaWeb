<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Colis;

class MapController extends AbstractController
{
    #[Route('/map', name: 'app_map')]
    public function index(): Response
    {
        // Récupération de tous les colis depuis la base de données
        $colisRepository = $this->getDoctrine()->getRepository(Colis::class);
        $colis = $colisRepository->findAll();

        return $this->render('map/index.html.twig', [
            'controller_name' => 'MapController',
            'colis' => $colis, // Passage des colis au Twig
        ]);
    }
}

