<?php
namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortieType;
use App\Repository\SortieRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(SortieRepository $sortieRepository): Response
    {

        $user = $this->getUser();
        $currentUserName = isset($user) ? $this->getUser()->getUsername() : "Anonyme";

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user' => $user,
            'sorties' => $sortieRepository->findAll(),
        ]);
    }
}