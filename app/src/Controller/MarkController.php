<?php

namespace App\Controller;

use App\Entity\NoteControle;
use App\Repository\NoteControleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class MarkController extends AbstractController
{
    #[Route('/mark', name: 'app_mark')]
    public function index(Environment $twig, NoteControleRepository $notecontrolerepository): Response
    {
        return new Response($twig->render('mark/mark.html.twig', [
            'note_controles' => $notecontrolerepository->findAll(),
        ]));
    }
}
