<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Validation;
use App\Form\ValidationType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/validation')]
class ValidationController extends AbstractController
{
    #[Route('/', name: 'app_validation_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $validations = $entityManager
            ->getRepository(Validation::class)
            ->findAll();

        return $this->render('validation/index.html.twig', [
            'validations' => $validations,
        ]);
    }

    #[Route('/new', name: 'app_validation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $validation = new Validation();
        $user = $entityManager->getRepository(User::class)->find(161);
        $validation->setIdu($user);
        $form = $this->createForm(ValidationType::class, $validation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('imagea')->getData();


            if ($image) {
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                dump($image);

                $validation->setImagea('http://localhost/img/' . $fichier);
            }
            $image = $form->get('imageb')->getData();


            if ($image) {
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                dump($image);

                $validation->setImageb('http://localhost/img/' . $fichier);
            }
            $entityManager->persist($validation);
            $entityManager->flush();

            return $this->redirectToRoute('app_validation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('validation/new.html.twig', [
            'validation' => $validation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_validation_show', methods: ['GET'])]
    public function show(Validation $validation): Response
    {
        return $this->render('validation/show.html.twig', [
            'validation' => $validation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_validation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Validation $validation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ValidationType::class, $validation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_validation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('validation/edit.html.twig', [
            'validation' => $validation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_validation_delete', methods: ['POST'])]
    public function delete(Request $request, Validation $validation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $validation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($validation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_validation_index', [], Response::HTTP_SEE_OTHER);
    }
}
