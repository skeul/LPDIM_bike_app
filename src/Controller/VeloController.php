<?php

namespace App\Controller;

use App\Entity\Electric;
use App\Repository\ElectricRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VeloController extends AbstractController
{
    /**
     *
     * @param EntityManagerInterface $entityManager
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/velo', name: 'velo')]
    public function index(): Response
    {
        // $electric = new Electric();

        // $electric->setAutonomie(45.3);
        // $electric->setMarque("Lapierre");
        // $electric->setModele("Zesty");
        // $electric->setPoids(14.2);
        // $electric->setPuissance(40);

        // $this->entityManager->persist($electric);
        // $this->entityManager->flush();

        $em = $this->entityManager->getRepository(Electric::class);
        dd($em->findAll());
        die();
        return $this->render('velo/index.html.twig', [
            'controller_name' => 'VeloController',
        ]);
    }
}