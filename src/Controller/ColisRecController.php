<?php

namespace App\Controller;

use App\Repository\AnnoncesRepository;
use App\Repository\ColisRecRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ColisRec ;
class ColisRecController extends AbstractController
{
    #[Route('/colis/rec/{id}', name: 'app_colis_rec')]
    public function index($id,AnnoncesRepository $annonceRepository,ColisRecRepository $colisRecRepository): Response
    {
       
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();


$queryBuilder = $annonceRepository->createQueryBuilder('u')
->where('u.id = :id')
->setParameter('id', $id);

$annonce = $queryBuilder->getQuery()->getResult();

$colis =  $annonce[0]->getIdColis() ;

$colisrec = new ColisRec() ;
$colisrec->setIdC($colis);
$colisrec->setIdU($user);

$colisRecRepository->save($colisrec, true);
$annonceRepository->remove($annonce[0],true);
        return $this->render('annonces/indexfront.html.twig', [
            'controller_name' => 'ColisRecController',
        ]);
    }
}
