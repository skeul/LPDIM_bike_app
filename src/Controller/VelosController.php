<?php

namespace App\Controller;

use App\Entity\VTT;
use App\Form\VTTType;
use App\Entity\Electric;
use App\Form\ElectricType;

use App\Repository\VTTRepository;
use App\Repository\VeloRepository;
use App\Repository\ElectricRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VelosController extends AbstractController
{
    #[Route('/velos', name: 'velos')]
    public function index(VeloRepository $veloRepository, VTTRepository $vTTRepository, ElectricRepository $electricRepository): Response
    {
        return $this->render('velos/index.html.twig', [
            'controller_name' => 'VelosController',
            //'vtts' => $vTTRepository->findAll(),
            //'electrics' => $electricRepository->findAll(),
            'velos' => $veloRepository->findAll(),
        ]);
    }
}