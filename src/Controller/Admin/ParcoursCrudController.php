<?php

namespace App\Controller\Admin;

use App\Entity\Parcours;
use App\Form\ParcoursType;
use App\Repository\ParcoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/parcours')]
class ParcoursCrudController extends AbstractController
{
    #[Route('/', name: 'parcours_crud_index', methods: ['GET'])]
    public function index(ParcoursRepository $parcoursRepository): Response
    {
        return $this->render('admin/parcours_crud/index.html.twig', [
            'parcours' => $parcoursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'parcours_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $parcour = new Parcours();
        $form = $this->createForm(ParcoursType::class, $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parcour);
            $entityManager->flush();

            return $this->redirectToRoute('parcours_crud_index');
        }

        return $this->render('admin/parcours_crud/new.html.twig', [
            'parcour' => $parcour,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'parcours_crud_show', methods: ['GET'])]
    public function show(Parcours $parcour): Response
    {
        return $this->render('admin/parcours_crud/show.html.twig', [
            'parcour' => $parcour,
        ]);
    }

    #[Route('/{id}/edit', name: 'parcours_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Parcours $parcour): Response
    {
        $form = $this->createForm(ParcoursType::class, $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parcours_crud_index');
        }

        return $this->render('admin/parcours_crud/edit.html.twig', [
            'parcour' => $parcour,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'parcours_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Parcours $parcour): Response
    {
        if ($this->isCsrfTokenValid('delete' . $parcour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parcour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parcours_crud_index');
    }
}