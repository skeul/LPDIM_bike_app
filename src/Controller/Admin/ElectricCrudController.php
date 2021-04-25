<?php

namespace App\Controller\Admin;

use App\Entity\Electric;
use App\Form\Admin\ElectricAdminType;
use App\Repository\ElectricRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/electric')]
class ElectricCrudController extends AbstractController
{
    #[Route('/', name: 'electric_crud_index', methods: ['GET'])]
    public function index(ElectricRepository $electricRepository): Response
    {
        return $this->redirectToRoute('velo_crud_index');
    }

    #[Route('/new', name: 'electric_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $electric = new Electric();
        $form = $this->createForm(ElectricAdminType::class, $electric);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $electric->setUser($this->getUser());
            $entityManager->persist($electric);
            $entityManager->flush();

            return $this->redirectToRoute('velo_crud_index');
        }

        return $this->render('admin/electric_crud/new.html.twig', [
            'electric' => $electric,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'electric_crud_show', methods: ['GET'])]
    public function show(Electric $electric): Response
    {
        return $this->render('admin/electric_crud/show.html.twig', [
            'electric' => $electric,
        ]);
    }

    #[Route('/{id}/edit', name: 'electric_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Electric $electric): Response
    {
        $form = $this->createForm(ElectricAdminType::class, $electric);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('velo_crud_index');
        }

        return $this->render('admin/electric_crud/edit.html.twig', [
            'electric' => $electric,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'electric_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Electric $electric): Response
    {
        if ($this->isCsrfTokenValid('delete' . $electric->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($electric);
            $entityManager->flush();
        }

        return $this->redirectToRoute('velo_crud_index');
    }
}