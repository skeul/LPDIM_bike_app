<?php

namespace App\Controller\Admin;

use App\Entity\VTT;
use App\Entity\Velo;
use App\Form\Admin\VTTAdminType;
use App\Form\Admin\VeloAdminType;
use App\Entity\Electric;
use App\Form\Admin\ElectricAdminType;
use App\Repository\VeloRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/velo')]
class VeloCrudController extends AbstractController
{
    #[Route('/', name: 'velo_crud_index', methods: ['GET'])]
    public function index(VeloRepository $veloRepository): Response
    {
        return $this->render('admin/velo_crud/index.html.twig', [
            'velos' => $veloRepository->findAll(),
        ]);
    }

    #[Route('/new/{type}', name: 'velo_crud_new', methods: ['GET', 'POST'])]
    public function new($type, Request $request): Response
    {

        $velo = null;
        $form = null;
        switch ($type) {
            case 'vtt':
                $velo = new VTT();
                $form = $this->createForm(VTTAdminType::class, $velo);
                break;
            case 'elec':
                $velo = new Electric();
                $form = $this->createForm(ElectricAdminType::class, $velo);
                break;

            default:
                # code...
                break;
        }

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($velo);
            $entityManager->flush();

            return $this->redirectToRoute('velo_crud_index');
        }

        return $this->render('admin/velo_crud/new.html.twig', [
            'velo' => $velo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'velo_crud_show', methods: ['GET'])]
    public function show(Velo $velo): Response
    {
        return $this->render('admin/velo_crud/show.html.twig', [
            'velo' => $velo,
        ]);
    }

    #[Route('/{id}/edit', name: 'velo_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Velo $velo): Response
    {
        if ($velo instanceof VTT) {
            $velo = new VTT();
            dd($velo);
            $form = $this->createForm(VTTAdminType::class, $velo);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('velo_crud_index');
        }

        return $this->render('admin/velo_crud/edit.html.twig', [
            'velo' => $velo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'velo_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Velo $velo): Response
    {
        if ($this->isCsrfTokenValid('delete' . $velo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($velo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('velo_crud_index');
    }
}