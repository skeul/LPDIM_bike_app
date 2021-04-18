<?php

namespace App\Controller\Admin;

use App\Entity\Sortie;
use App\Form\Admin\SortieAdminType;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/sortie')]
class SortieCrudController extends AbstractController
{
    #[Route('/', name: 'sortie_crud_index', methods: ['GET'])]
    public function index(SortieRepository $sortieRepository): Response
    {
        return $this->render('admin/sortie_crud/index.html.twig', [
            'sorties' => $sortieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'sortie_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $sortie = new Sortie();
        $form = $this->createForm(SortieAdminType::class, $sortie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sortie);
            $entityManager->flush();

            return $this->redirectToRoute('sortie_crud_index');
        }

        return $this->render('admin/sortie_crud/new.html.twig', [
            'sortie' => $sortie,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'sortie_crud_show', methods: ['GET'])]
    public function show(Sortie $sortie): Response
    {
        return $this->render('admin/sortie_crud/show.html.twig', [
            'sortie' => $sortie,
        ]);
    }

    #[Route('/{id}/edit', name: 'sortie_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sortie $sortie): Response
    {
        $form = $this->createForm(SortieAdminType::class, $sortie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sortie_crud_index');
        }

        return $this->render('admin/sortie_crud/edit.html.twig', [
            'sortie' => $sortie,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'sortie_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Sortie $sortie): Response
    {
        if ($this->isCsrfTokenValid('delete' . $sortie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sortie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sortie_crud_index');
    }
}