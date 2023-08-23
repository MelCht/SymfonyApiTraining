<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    private UserService $userService;
    private SerializerInterface $serializer; // Declare the SerializerInterface

    public function __construct(UserService $userService, SerializerInterface $serializer)
    {
        $this->userService = $userService;
        $this->serializer = $serializer; // Inject the SerializerInterface
    }

    #[Route('/api/users', name: 'app_user', methods: ['GET'])]
    public function index(UserRepository $userRepository): JsonResponse
    {
        $userData = $userRepository->findAll();

        // Serialize the data to JSON
        $jsonData = $this->serializer->serialize($userData, 'json', ['groups' => ['user:read', 'possession:item:get']]);


        return new JsonResponse($jsonData, 200, [], true);
    }


    #[Route('/api/delete/{id}', name:'app_user_delete', methods: ['DELETE'])]
    public function delete(UserRepository $userRepository, $id): JsonResponse
    {
        $user = $userRepository->find($id);

        if ($user) {
            $userRepository->delete($user);
        }

        return new JsonResponse(['message' => 'Utilisateur supprimé']);
    }

    #[Route('/api/user/{id}', name:'app_user_show', methods: ['GET'])]
    public function showPossession(UserRepository $userRepository, $id): JsonResponse
    {
        $user = $userRepository->find($id);

        if ($user) {
            // Serialize the user data and its related possessions to JSON
            $jsonData = $this->serializer->serialize($user, 'json', ['groups' => ['user:read', 'possessions']]);

            return new JsonResponse($jsonData, 200, [], true);
        }
        return new JsonResponse(['message' => 'Utilisateur non trouvé'], 404);
    }

    #[Route('/api/add/user', name: 'app_add_user', methods: ['POST'])]
    public function addUser(Request $request, UserRepository $userRepository): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);

        $user = new User();
        $user->setNom($requestData['nom']);
        $user->setPrenom($requestData['prenom']);
        $user->setEmail($requestData['email']);
        $user->setAdresse($requestData['adresse']);
        $user->setTel($requestData['tel']);

        $userRepository->save;

        return new JsonResponse(['message' => 'Utilisateur ajouté avec succès'], 201);
    }
}
