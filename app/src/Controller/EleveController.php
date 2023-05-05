<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\NoteControle;
use App\Repository\UserRepository;
use App\Repository\NoteControleRepository;
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

    #[Route('/eleve/{id}', name: 'app_eleve')]
    public function index(Request $request, UserRepository $userRepository, Environment $twig, NoteControleRepository $noteControleRepository): Response
    {
        // Récupération de l'ID de l'élève depuis la requête HTTP
        $id = $request->attributes->get('id');

        // Récupération de toutes les notes des contrôles pour l'élève avec l'ID donné
        $notes = $noteControleRepository->findBy(['user' => $id]);

        // Initialisation de tableaux pour stocker le total des notes et les coefficients par matière
        $totalNotesByMatiere = [];
        $coefficientsByMatiere = [];

        // Parcours de toutes les notes et stockage des totaux et des coefficients par matière
        foreach ($notes as $note) {
            $matiere = $note->getMatiere();
            $noteValue = $note->getNote();
            $coefficient = $note->getCoefficient();

            // Si la matière n'existe pas encore dans les tableaux, on l'ajoute
            if (!array_key_exists($matiere->getId(), $totalNotesByMatiere)) {
                $totalNotesByMatiere[$matiere->getId()] = 0;
            }

            if (!array_key_exists($matiere->getId(), $coefficientsByMatiere)) {
                $coefficientsByMatiere[$matiere->getId()] = 0;
            }

            // Ajout des notes et des coefficients dans les tableaux
            $totalNotesByMatiere[$matiere->getId()] += $noteValue * $coefficient;
            $coefficientsByMatiere[$matiere->getId()] += $coefficient;
        }

        // Initialisation d'un tableau pour stocker les moyennes par matière
        $moyennesByMatiere = [];

        // Parcours de tous les totaux de notes par matière et calcul de la moyenne
        foreach ($totalNotesByMatiere as $matiereId => $totalNotes) {
            // Récupération de la matière correspondant à l'ID donné
           $matiere = $noteControleRepository->findOneBy(['matiere.id' => $matiereId])->getMatiere();
            //$matiere = $noteControleRepository->find($matiereId)->getMatiere();
            // Récupération du coefficient correspondant à la matière
            $coefficients = $coefficientsByMatiere[$matiereId];

            // Calcul de la moyenne de la matière
            $moyenne = ($coefficients > 0) ? ($totalNotes / $coefficients) : "Not Rated";

            // Ajout de la moyenne dans le tableau avec la matière comme clé
            $moyennesByMatiere[$matiere->getId()] = [
                'libelle' => $matiere->getLibelle(),
                'moyenne' => $moyenne,
            ];
        }

        // Récupération de l'utilisateur avec l'ID donné
        $user = $userRepository->find($id);

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        // render the student details page, passing the student object and the array of averages
        return $this->render('eleve/eleve.html.twig', [
            'eleve' => $user,
            'moyennesByMatiere' => $moyennesByMatiere,
        ]);
    }
}