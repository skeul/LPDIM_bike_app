<?php

namespace App\Controller\Admin;

use App\Entity\Velo;
use App\Repository\UserRepository;
use App\Repository\ElectricRepository;
use App\Repository\ParcoursRepository;
use App\Repository\SommetRepository;
use App\Repository\SortieRepository;
use App\Repository\VeloRepository;
use App\Repository\VTTRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    public function index(
        UserRepository $userRepository,
        ElectricRepository $elecRepository,
        ParcoursRepository $parcoursRepository,
        SommetRepository $sommetRepository,
        SortieRepository $sortieRepository,
        VTTRepository $vTTRepository,
        VeloRepository $veloRepository,
    ): Response {

        return $this->render('admin/dashboard/index.html.twig', [
            'controller_name' => 'AdminDashboardController',
            'users' => $userRepository->findAll(),
            'elecs' => $elecRepository->findAll(),
            'parcours' => $parcoursRepository->findAll(),
            'sommets' => $sommetRepository->findAll(),
            'sorties' => $sortieRepository->findAll(),
            'velo' => $veloRepository->findAll(),
            'vtts' => $vTTRepository->findAll()
        ]);
    }
}