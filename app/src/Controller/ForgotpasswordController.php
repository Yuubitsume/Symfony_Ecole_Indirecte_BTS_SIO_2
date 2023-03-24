<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PasswordFormType;
use App\Security\LoginAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ForgotpasswordController extends AbstractController
{
    #[Route('/forgotpassword', name: 'app_forgotpassword')]
    public function changePassword(Request $request, UserPasswordHasherInterface $userPasswordHasher, LoginAuthenticator $loginAuthenticator, EntityManagerInterface $entityManager): Response
    {
        {
            $user = $this->getUser();
            $changePasswordForm = $this->createForm(PasswordFormType::class, $user);
            $changePasswordForm->handleRequest($request);
          
            if ($changePasswordForm->isSubmitted() && $changePasswordForm->isValid()) {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $changePasswordForm->get('plainPassword')->getData()
                    )
                );
                 $entityManager->persist($user);
                 $entityManager->flush();
              }
            }

        return $this->render('forgotpassword/forgotpassword.html.twig', [
            'PasswordForm' => $changePasswordForm->createView(),
        ]);
    }
}


  