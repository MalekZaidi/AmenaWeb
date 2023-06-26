<?php

namespace App\Controller;

use App\Entity\Colis;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

#[Route('/Json')]

class SerializerController extends AbstractController
{
    #[Route('/allColis', name: 'app_colis_json_all')]
    public function allColis(NormalizerInterface $normalizer): JsonResponse
    {
        $colis = $this->getDoctrine()->getRepository(Colis::class)->findAll();
        
        $jsonContent = $normalizer->normalize($colis, null, ['groups' => 'colis']);
    
        return new JsonResponse($jsonContent);
    }
    #[Route('/allColis/{id}', name: 'app_colis_json')]
    public function ColisID($id, NormalizerInterface $normalizer): JsonResponse
    {
        $colis = $this->getDoctrine()->getRepository(Colis::class)->find($id);
        
        $jsonContent = $normalizer->normalize($colis, null, ['groups' => 'colis']);
    
        return new JsonResponse($jsonContent);
    }
    #[Route('/new', name: 'app_json_new')]
    public function add(Request $request, EntityManagerInterface $entityManager, NormalizerInterface $normalizer): Response
    {
        $coli = new Colis();
        $user = $entityManager->getRepository(User::class)->find(161);
        $coli->setIdu($user);
        $coli->setNomExpediteur($request->get("NomExpediteur"));
        $coli->setAdresseExpediteur($request->get("AdresseExpediteur"));
        $coli->setNomDestinataire($request->get("NomDestinataire"));
        $coli->setAdresseDestinataire($request->get("AdresseDestinataire"));
        $coli->setPoids($request->get("poids"));
        $coli->setStatut("en attente");
        $today = new \DateTime();
        $coli->setDateExpedition($today);
        $entityManager->persist($coli);
        $entityManager->flush();
    
        $jsonContent = $normalizer->normalize($coli, null, ['groups' => 'colis']);
        return new Response(json_encode($jsonContent));
    }

#[Route('/{id}/edit', name:'app_json_edit')]
public function updateJson(Request $req,$id,NormalizerInterface $Normalizer)
{   
    $entityManager=$this->getDoctrine()->getManager();
    $coli=$entityManager->getRepository(Colis::class)->find($id);
    $user = $entityManager->getRepository(User::class)->find(161);
    $coli->setIdu($user);
    $coli->setNomExpediteur($req->get("NomExpediteur"));
    $coli->setAdresseExpediteur($req->get("AdresseExpediteur"));
    $coli->setNomDestinataire($req->get("NomDestinataire"));
    $coli->setAdresseDestinataire($req->get("AdresseDestinataire"));
    $coli->setPoids($req->get("poids"));
    $coli->setStatut("en attente");
    $today = new \DateTime();
    $coli->setDateExpedition($today);
    $entityManager->persist($coli);
    $entityManager->flush();
    $jsonContent = $Normalizer->normalize($coli, 'json', ['groups' => 'colis']);
        return new Response(json_encode($jsonContent));




}



#[Route('/delete/{id}', name: 'app_json_delete')]
public function delete(Request $request, Colis $colis,$id): JsonResponse
{   
    $colis= $this->getDoctrine()->getRepository(Colis::class)->find($id);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($colis);
    $entityManager->flush();

    return new JsonResponse([
        'message' => 'Le colis a été supprimé avec succès.'
    ]);
}
}
