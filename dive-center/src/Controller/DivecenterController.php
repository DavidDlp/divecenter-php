<?php

namespace App\Controller;

use App\Entity\Divecenter;
use App\Form\DivecenterType;
use App\Repository\DivecenterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/divecenters')]
class DivecenterController extends AbstractController
{
    #[Route('/', name: 'divecenter_index', methods: ['GET'])]
    public function index(DivecenterRepository $divecenterRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('divecenter/index.html.twig', [
            'divecenters' => $divecenterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'divecenter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $divecenter = new Divecenter();
        $form = $this->createForm(DivecenterType::class, $divecenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($divecenter);
            $entityManager->flush();

            return $this->redirectToRoute('divecenter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('divecenter/new.html.twig', [
            'divecenter' => $divecenter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'divecenter_show', methods: ['GET'])]
    public function show(Divecenter $divecenter): Response
    {
        return $this->render('divecenter/show.html.twig', [
            'divecenter' => $divecenter,
        ]);
    }

    #[Route('/{id}/edit', name: 'divecenter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Divecenter $divecenter, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DivecenterType::class, $divecenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('divecenter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('divecenter/edit.html.twig', [
            'divecenter' => $divecenter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'divecenter_delete', methods: ['POST'])]
    public function delete(Request $request, Divecenter $divecenter, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$divecenter->getId(), $request->request->get('_token'))) {
            $entityManager->remove($divecenter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('divecenter_index', [], Response::HTTP_SEE_OTHER);
    }
}
