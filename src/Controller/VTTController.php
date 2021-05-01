<?php

namespace App\Controller;

use App\Entity\VTT;
use App\Form\VTTType;
use App\Repository\VTTRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/vtt')]
class VTTController extends AbstractController
{
    #[Route('/', name: 'vtt_index', methods: ['GET'])]
    public function index(VTTRepository $vTTRepository): Response
    {
        return $this->redirectToRoute('velos');
    }

    #[Route('/new', name: 'vtt_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $vTT = new VTT();
        $vTT->setUser($this->getUser());
        $form = $this->createForm(VTTType::class, $vTT);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vTT);
            $entityManager->flush();

            return $this->redirectToRoute('velos');
        }

        return $this->render('vtt/new.html.twig', [
            'vtt' => $vTT,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'vtt_show', methods: ['GET'])]
    public function show(VTT $vTT): Response
    {
        return $this->render('vtt/show.html.twig', [
            'vtt' => $vTT,
        ]);
    }

    #[Route('/{id}/edit', name: 'vtt_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VTT $vTT): Response
    {
        $form = $this->createForm(VTTType::class, $vTT);
        $form->handleRequest($request);
        $vTT->setUser($this->getUser());


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('velos');
        }

        return $this->render('vtt/edit.html.twig', [
            'vtt' => $vTT,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'vtt_delete', methods: ['POST'])]
    public function delete(Request $request, VTT $vTT): Response
    {
        if ($this->isCsrfTokenValid('delete' . $vTT->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vTT);
            $entityManager->flush();
        }

        return $this->redirectToRoute('velos');
    }
}