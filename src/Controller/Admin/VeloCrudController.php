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
}