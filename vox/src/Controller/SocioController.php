<?php

namespace App\Controller;

use App\Service\SocioService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\{Request};

/**
 * @Route("/socio", name="socio")
 * @package App\Controller
 */
class SocioController extends AbstractController
{
    /**
     * @var SocioService
     */
    private $service;

    /**
     * SocioController constructor.
     * @param SocioService $SocioService
     */
    public function __construct(SocioService $SocioService)
    {
        $this->service = $SocioService;
    }

    /**
     * @Route("/", name="socio_index", methods={"GET"})
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $socios = $this->service->seach();

        return new JsonResponse($socios);
    }

     /**
     * @Route("/inserir", name="inserir", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function insert(Request $request): JsonResponse
    {
        $this->service->insertSocio($request);
        
        return $this->json(['data'=>'Socio cadastrada com sucesso']);
    }

    /**
     * @param int $socioId
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     * @Route("/{socioId}", name="listar", methods={"GET"})
     */
    public function seach(int $socioId): JsonResponse
    {
        $socio = $this->service->seachSocio($socioId);

        return new JsonResponse($socio);
    }

    /**
     * @param int $socioId
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     * @Route("/atualizar/{socioId}", name="update", methods={"PUT", "PATCH"})
     */
    public function update(int $socioId, Request $request): JsonResponse
    {
       $this->service->updateSocio($socioId, $request);

       return $this->json(['data'=>'Dados atualizados com sucesso']);
    }

    /**
     * @param int $socioId
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     * @Route("/delete/{socioId}", name="deletar", methods={"DELETE"})
     */
    public function delete(int $socioId): JsonResponse
    {
        $this->service->deleteSocio($socioId);

        return $this->json(['data'=>'Deletado com sucesso']);
    }
}
