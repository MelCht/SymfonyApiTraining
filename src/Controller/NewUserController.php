<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\NewUserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewUserController extends AbstractController
{
    #[Route('/new/user', name: 'app_new_user')]
    public function addUser(UserRepository $userRepository, Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(NewUserType::class, $user);

        // Traitement du formulaire soumis
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user);

            return $this->redirectToRoute('app_user');
        }

            // Rendu du template avec le formulaire
            return $this->render('new_user/add_user.html.twig', [
                'form' => $form->createView(),
            ]);
        }
}
