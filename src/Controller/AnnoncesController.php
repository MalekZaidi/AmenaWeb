<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\AnnoncesType;
use App\Repository\AnnoncesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Colis;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;




#[Route('/annonces')]
class AnnoncesController extends AbstractController
{
    #[Route('/', name: 'app_annonces_index', methods: ['GET'])]
    public function index(AnnoncesRepository $annoncesRepository): Response
    {
        $annonces=$annoncesRepository->findAll();
        //dd('end');
        //dd($annonces);
        return $this->render('annonces/index.html.twig', [
            'annonces' => $annonces,
        ]);
    }

    #[Route('/new', name: 'app_annonces_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AnnoncesRepository $annoncesRepository, EntityManagerInterface $entityManager): Response
    {
        $annonce = new Annonces();

        
       // $colis = $entityManager->getRepository(Colis::class)->find(1);
        
       // $annonce->setIdcolis($colis);
        
        
       // $user = $entityManager->getRepository(User::class)->find(1);
        //$annonce->setIdaU($user);
        
        
        
        dump($annonce);
        //dd('end');
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $annoncesRepository->save($annonce, true);
            
            return $this->redirectToRoute('app_annonces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonces/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_annonces_show', methods: ['GET'])]
    public function show(Annonces $annonce): Response
    {
        return $this->render('annonces/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_annonces_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Annonces $annonce, AnnoncesRepository $annoncesRepository): Response
    {
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annoncesRepository->save($annonce, true);

            return $this->redirectToRoute('app_annonces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonces/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_annonces_delete', methods: ['POST'])]
    public function delete(Request $request, Annonces $annonce, AnnoncesRepository $annoncesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $annonce->getId(), $request->request->get('_token'))) {
            $annoncesRepository->remove($annonce, true);
        }

        return $this->redirectToRoute('app_annonces_index', [], Response::HTTP_SEE_OTHER);
    }
}
