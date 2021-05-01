<?php

namespace App\Controller;

use App\Entity\Electric;
use App\Form\ElectricType;
use App\Repository\ElectricRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/electric')]
class ElectricController extends AbstractController
{
    #[Route('/', name: 'electric_index', methods: ['GET'])]
    public function index(ElectricRepository $electricRepository): Response
    {
        return $this->redirectToRoute('velos');
    }

    #[Route('/new', name: 'electric_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $electric = new Electric();
        $electric->setUser($this->getUser());

        $form = $this->createForm(ElectricType::class, $electric);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($electric);
            $entityManager->flush();

            return $this->redirectToRoute('velos');
        }

        return $this->render('electric/new.html.twig', [
            'electric' => $electric,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'electric_show', methods: ['GET'])]
    public function show(Electric $electric): Response
    {
        return $this->render('electric/show.html.twig', [
            'electric' => $electric,
        ]);
    }

    #[Route('/{id}/edit', name: 'electric_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Electric $electric): Response
    {
        $form = $this->createForm(ElectricType::class, $electric);
        $form->handleRequest($request);
        $electric->setUser($this->getUser());


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('velos');
        }

        return $this->render('electric/edit.html.twig', [
            'electric' => $electric,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'electric_delete', methods: ['POST'])]
    public function delete(Request $request, Electric $electric): Response
    {
        if ($this->isCsrfTokenValid('delete' . $electric->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($electric);
            $entityManager->flush();
        }

        return $this->redirectToRoute('velos');
    }
}