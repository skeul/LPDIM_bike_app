<?php

namespace App\Controller;

use App\Entity\Sommet;
use App\Form\SommetType;
use App\Repository\SommetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sommet')]
class SommetController extends AbstractController
{
    #[Route('/', name: 'sommet_index', methods: ['GET'])]
    public function index(SommetRepository $sommetRepository): Response
    {
        return $this->render('sommet/index.html.twig', [
            'sommets' => $sommetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'sommet_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $sommet = new Sommet();
        $form = $this->createForm(SommetType::class, $sommet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sommet);
            $entityManager->flush();

            return $this->redirectToRoute('sommet_index');
        }

        return $this->render('sommet/new.html.twig', [
            'sommet' => $sommet,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'sommet_show', methods: ['GET'])]
    public function show(Sommet $sommet): Response
    {
        return $this->render('sommet/show.html.twig', [
            'sommet' => $sommet,
        ]);
    }

    #[Route('/{id}/edit', name: 'sommet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sommet $sommet): Response
    {
        $form = $this->createForm(SommetType::class, $sommet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sommet_index');
        }

        return $this->render('sommet/edit.html.twig', [
            'sommet' => $sommet,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'sommet_delete', methods: ['POST'])]
    public function delete(Request $request, Sommet $sommet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sommet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sommet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sommet_index');
    }
}
