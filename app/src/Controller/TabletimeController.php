<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TabletimeController extends AbstractController
{
    #[Route('/tabletime', name: 'app_tabletime')]
    public function index(): Response
    {
        return $this->render('tabletime/tabletime.html.twig', [
            'controller_name' => 'TabletimeController',
        ]);
    }
}
