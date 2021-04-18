<?php

namespace App\Controller;

use App\Entity\Velo;
use App\Form\VeloType;
use App\Repository\VeloRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/velo')]
class VeloController extends AbstractController
{
    #[Route('/', name: 'velo_index', methods: ['GET'])]
    public function index(VeloRepository $veloRepository): Response
    {
        return $this->render('velo/index.html.twig', [
            'velos' => $veloRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'velo_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $velo = new Velo();
        $form = $this->createForm(VeloType::class, $velo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($velo);
            $entityManager->flush();

            return $this->redirectToRoute('velo_index');
        }

        return $this->render('velo/new.html.twig', [
            'velo' => $velo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'velo_show', methods: ['GET'])]
    public function show(Velo $velo): Response
    {
        return $this->render('velo/show.html.twig', [
            'velo' => $velo,
        ]);
    }

    #[Route('/{id}/edit', name: 'velo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Velo $velo): Response
    {
        $form = $this->createForm(VeloType::class, $velo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('velo_index');
        }

        return $this->render('velo/edit.html.twig', [
            'velo' => $velo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'velo_delete', methods: ['POST'])]
    public function delete(Request $request, Velo $velo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$velo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($velo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('velo_index');
    }
}
