<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class EleveController extends AbstractController
{

    private $twig;
    
        public function __construct(Environment $twig)
        {
            $this->twig = $twig;
        }

    #[Route('/eleve', name: 'app_eleve')]
    public function index(Request $request, UserRepository $UserRepository, Environment $twig): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $UserRepository->getUserPaginator($offset);

        return new Response($this->twig->render('eleve/eleve.html.twig', [
            'eleves' => $paginator,
            'previous' => $offset - UserRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + UserRepository::PAGINATOR_PER_PAGE),
        ]));
    }
}

  
