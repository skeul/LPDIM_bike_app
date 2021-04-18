<?php

namespace App\Controller\Admin;

use App\Entity\VTT;
use App\Form\Admin\VTTAdminType;
use App\Repository\VTTRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/vtt')]
class VTTCrudController extends AbstractController
{
    #[Route('/', name: 'vtt_crud_index', methods: ['GET'])]
    public function index(VTTRepository $vTTRepository): Response
    {
        return $this->render('admin/vtt_crud/index.html.twig', [
            'vtts' => $vTTRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'vtt_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $vTT = new VTT();
        $form = $this->createForm(VTTAdminType::class, $vTT);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vTT);
            $entityManager->flush();

            return $this->redirectToRoute('vtt_crud_index');
        }

        return $this->render('admin/vtt_crud/new.html.twig', [
            'vtt' => $vTT,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'vtt_crud_show', methods: ['GET'])]
    public function show(VTT $vTT): Response
    {
        return $this->render('admin/vtt_crud/show.html.twig', [
            'vtt' => $vTT,
        ]);
    }

    #[Route('/{id}/edit', name: 'vtt_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VTT $vTT): Response
    {
        $form = $this->createForm(VTTAdminType::class, $vTT);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vtt_crud_index');
        }

        return $this->render('admin/vtt_crud/edit.html.twig', [
            'vtt' => $vTT,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'vtt_crud_delete', methods: ['POST'])]
    public function delete(Request $request, VTT $vTT): Response
    {
        if ($this->isCsrfTokenValid('delete' . $vTT->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vTT);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vtt_crud_index');
    }
}