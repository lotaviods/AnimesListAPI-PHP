<?php

namespace App\Controller;

use App\Entity\Animes;
use Doctrine\ORM\EntityManager;
use App\Repository\AnimesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnimesController extends AbstractController
{
    private $client;
    private $entityManager;
    private $animesRepository;

    public function __construct(EntityManagerInterface $entityManager, AnimesRepository $animesRepository, HttpClientInterface $client)
    {
        $this->client = $client;
        $this->entityManager = $entityManager;
        $this->animesRepository = $animesRepository;
    }
    public function GetAll(): Response
    {
        $repository = $this->animesRepository->findAll();

        return new JsonResponse($repository, 200);
    }
    public function Store(Request $request): Response
    {
        $dadosJson = json_decode($request->getContent());
        $anime = new Animes;
        
        $anime->setNome($dadosJson->nome);
        $anime->setDescricao($dadosJson->descricao);

        $this->entityManager->persist($anime);
        $this->entityManager->flush();

        return new JsonResponse([
            'Created: ' => $anime,
        ], 201);
    }
    public function Delete($id): Response
    {
        
        $anime = $this->animesRepository->find($id);
        if (is_null($anime)){
            return new JsonResponse('', Response::HTTP_BAD_REQUEST);
        }
        $this->entityManager->remove($anime);
        $this->entityManager->flush();

        return new JsonResponse('', Response::HTTP_ACCEPTED);
    }

    // public function getApi(){ MÉTODO PARA DAR GET NA API USANDO SYMFONY
    //     $response = $this->client->request(
    //         'GET',
    //         'http://localhost:3000/api'
    //     ); 
    //     $json = json_decode($response->getContent());
    //         return new JsonResponse($json);
    // }
}
