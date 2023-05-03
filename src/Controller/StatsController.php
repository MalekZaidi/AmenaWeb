<?php

namespace App\Controller;
use App\Entity\Colis;
use App\Repository\ColisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\Query\ResultSetMapping;

class StatsController extends AbstractController
{
    #[Route('/stats', name: 'app_stats_index')]
    public function index(ColisRepository $colisRepository,EntityManagerInterface $entityManager): Response
    {
        $count_colis = $this->getDoctrine()
        ->getRepository(Colis::class)
        ->createQueryBuilder('c')
        ->select('COUNT(c.id)')
        ->getQuery()
        ->getSingleScalarResult();

        $poidsMoyen = $colisRepository->createQueryBuilder('c')
        ->select('AVG(c.poids)')
        ->getQuery()
        ->getSingleScalarResult();

        $totalColis = $colisRepository->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->getQuery()
            ->getSingleScalarResult();

            $sql = 'SELECT COUNT(c.id) as nbColis, DATE_FORMAT(c.dateexpedition, "%Y-%m") as mois
            FROM colis c
            GROUP BY mois';
    $rsm = new ResultSetMapping();
    $query = $entityManager->createNativeQuery($sql, $rsm);
    $results = $query->getArrayResult();
    
    $data1 = array();
    $labels = array();
    
    foreach($results as $result) {
        $data1[] = $result['nbColis'];
        $labels[] = $result['mois'];
    }
    
    $livres = $colisRepository->countByStatut('livré');
    $attentes = $colisRepository->countByStatut('en attente');
    $colis = $this->getDoctrine()->getRepository(Colis::class)->findAll();
    
    $data = [
        'labels' => ['Livré', 'En attente','Total'],
        'datasets' => [
            [
                'label' => 'Nombre de colis',
                'backgroundColor' => ['#36a2eb', '#ffcd56', '#546e7a'],
                'data' => [$livres, $attentes,$totalColis],
            ],
        ],
    ];
    
    return $this->render('stats/index.html.twig', [
        'data' => $data,
        'count_colis' => $count_colis,
        'poidsMoyen' => $poidsMoyen,
        'labels' => $labels,
        'data1' => $data1,
        'colis'=>$colis
    ]); 
    }
}