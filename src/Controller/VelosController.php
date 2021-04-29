<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\VTT;
use App\Form\VTTType;
use App\Repository\VTTRepository;

use App\Entity\Electric;
use App\Form\ElectricType;
use App\Repository\ElectricRepository;

class VelosController extends AbstractController
{
    #[Route('/velos', name: 'velos')]
    public function index(VTTRepository $vTTRepository,ElectricRepository $electricRepository): Response
    {
        return $this->render('velos/index.html.twig', [
            'controller_name' => 'VelosController',
            'vtts' => $vTTRepository->findAll(),
            'electrics' => $electricRepository->findAll(),
        ]);
    }

}
