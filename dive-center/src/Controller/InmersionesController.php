<?php

namespace App\Controller;

use App\Entity\Inmersiones;
use App\Form\InmersionesType;
use App\Repository\InmersionesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inmersiones')]
class InmersionesController extends AbstractController
{
    #[Route('/', name: 'inmersiones_index', methods: ['GET'])]
    public function index(InmersionesRepository $inmersionesRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('inmersiones/index.html.twig', [
            'inmersiones' => $inmersionesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'inmersiones_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $inmersione = new Inmersiones();
        $form = $this->createForm(InmersionesType::class, $inmersione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($inmersione);
            $entityManager->flush();

            return $this->redirectToRoute('inmersiones_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inmersiones/new.html.twig', [
            'inmersione' => $inmersione,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'inmersiones_show', methods: ['GET'])]
    public function show(Inmersiones $inmersione): Response
    {
        return $this->render('inmersiones/show.html.twig', [
            'inmersione' => $inmersione,
        ]);
    }

    #[Route('/{id}/edit', name: 'inmersiones_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Inmersiones $inmersione, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InmersionesType::class, $inmersione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('inmersiones_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inmersiones/edit.html.twig', [
            'inmersione' => $inmersione,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'inmersiones_delete', methods: ['POST'])]
    public function delete(Request $request, Inmersiones $inmersione, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inmersione->getId(), $request->request->get('_token'))) {
            $entityManager->remove($inmersione);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inmersiones_index', [], Response::HTTP_SEE_OTHER);
    }
}
