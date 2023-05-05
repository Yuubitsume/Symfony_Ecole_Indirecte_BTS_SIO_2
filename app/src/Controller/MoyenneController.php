<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Matiere;
use App\Entity\User;
use App\Entity\NoteControle;
use App\Entity\Classes;
use App\Form\NoteFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\UserRepository;
use Twig\Environment;

class MoyenneController extends AbstractController
{
    private $twig;
    private $entityManager;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

    #[Route('/moyenne', name: 'app_moyenne')]
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $userRepository->getUserPaginator($offset);

        $users = $userRepository->createQueryBuilder('user')
            ->leftJoin('user.classe', 'classe')
            ->orderBy('classe.id', 'ASC')
            ->getQuery()
            ->getResult();

        // Initialisation du tableau des moyennes
        $moyennes = array();

        // Pour chaque élève dans la liste
        foreach ($users as $user) {
            // Récupération des notes de l'élève
            $notes = $this->entityManager->getRepository(NoteControle::class)->createQueryBuilder('note')
                ->where('note.user = :user')
                ->setParameter('user', $user)
                ->getQuery()
                ->getResult();

            // Calcul de la moyenne de l'élève
            $totalNotes = 0;
            $nbNotes = count($notes);
            foreach ($notes as $note) {
                $totalNotes += $note->getNote();
            }
            $moyenne = ($nbNotes > 0) ? ($totalNotes / $nbNotes) : "No Rated";

            // Stockage de la moyenne dans le tableau
            $moyennes[$user->getId()] = $moyenne;
        }

        return new Response($this->twig->render('moyenne/moyenne.html.twig', [
            'users' => $users,
            'moyennes' => $moyennes,
            'eleves' => $paginator,
            'previous' => $offset - UserRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + UserRepository::PAGINATOR_PER_PAGE),
        ]));
    }
}



