<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Entity\User;
use App\Entity\NoteControle;
use App\Form\NoteFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class NoteController extends AbstractController
{
        #[Route('/note', name: 'app_note')]

        public function note(Request $request, EntityManagerInterface $entityManager): response
        {
        $note = new NoteControle();
        $form = $this->createForm(NoteFormType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                
            $entityManager->persist($note);
            $entityManager->flush();
           
        };

        return $this->render('note/note.html.twig', [
            'NoteForm' =>  $form->createView(),
        ]);
    }
}

