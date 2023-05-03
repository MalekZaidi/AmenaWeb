<?php

namespace App\Controller;

use App\Repository\CompetitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatcompetitionController extends AbstractController
{
    #[Route('/statcompetition', name: 'app_statcompetition')]
    public function index(CompetitionRepository $competitionRepository): Response
    {
        $stats = $competitionRepository->createQueryBuilder('c')
            ->select('c.title, COUNT(u.id) as nbParticipants')
            ->leftJoin('c.userPart', 'u')
            ->groupBy('c.id')
            ->getQuery()
            ->getResult();

        // renvoyer les données sous forme JSON
        return $this->json($stats);
    }
}
