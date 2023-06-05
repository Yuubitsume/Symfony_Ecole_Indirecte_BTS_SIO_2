<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Matiere;
use App\Entity\User;
use App\Entity\Classes;
use App\Entity\NoteControle;
use App\Form\NoteFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\NoteControleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Twig\Environment;

class MoyenneController extends AbstractController
{
    private $twig;
    private $noteControleRepository;
    private $entityManager;

    public function __construct(Environment $twig, NoteControleRepository $noteControleRepository, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->noteControleRepository = $noteControleRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/avgClasse/{ClasseName}', name: 'app_moyenne')]
    public function index(Request $request): Response
    {
        // Récupération de l'ID de la classe depuis la requête HTTP
        $classeName = $request->attributes->get('classeName');

        // Récupération de toutes les notes des contrôles pour la classe donnée
        $notes = $this->noteControleRepository->findAll();

        // Initialisation d'un tableau pour stocker le total des notes et les coefficients par matière
        $totalNotesByMatiere = [];
        $coefficientsByMatiere = [];

        // Parcours de toutes les notes et stockage des totaux et des coefficients par matière
        foreach ($notes as $note) {
            // Vérification que la note appartient à la classe donnée
            if ($note->getUser()->getClasse()->getClasseName() == ucfirst($classeName)) {

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
        }

        // Initialisation d'un tableau pour stocker les moyennes par matière
        $moyennesByMatiere = [];

        // Parcours de tous les totaux de notes par matière et calcul de la moyenne
        foreach ($totalNotesByMatiere as $matiereId => $totalNotes) {
            // Récupération de la matière correspondant à l'ID donné
            $matiereId = intval($matiereId);
            $matiere = $this->entityManager->getRepository(Matiere::class)->find($matiereId);           

            // Récupération du coefficient correspondant à la matière
            $coefficients = $coefficientsByMatiere[$matiereId];

            // Calcul de la moyenne de la matière
            $moyenne = ($coefficients > 0) ? ($totalNotes / $coefficients) : "Not Rated";

            // Ajout de la moyenne dans le tableau avec la matière comme clé
            $moyennesByMatiere[$matiere->getId()] = [
                'libelle' => $matiere->getLibelle(),
                'moyenne' => $moyenne,
                var_dump($moyenne)
            ];
        }

    return new Response($this->twig->render('moyenne/moyenne.html.twig', [
        'moyennes' => $moyennesByMatiere,
        'classes' => $classeName,
        //'classes' => $paginator,
        //'previous' => $offset - UserRepository::PAGINATOR_PER_PAGE,
       // 'next' => min(count($paginator), $offset + UserRepository::PAGINATOR_PER_PAGE),
    ]));
    }
}