<?php

namespace App\Controller;

use App\Service\EmpresaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Empresa;

use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/empresa", name="empresa_")
 * Class EmpresaController
 * @package App\Controller
 */
class EmpresaController extends AbstractController
{
    /**
     * @var EmpresaService
     */
    private $service;

    /**
     * EmpresaController constructor.
     * @param EmpresaService $empresaService
     */
    public function __construct(
        EmpresaService $empresaService
    ) {
        $this->service = $empresaService;
    }

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index()
    {
        $empresas = $this->service->listar();

        return new JsonResponse($empresas);
    }

    /**
     * @Route("/{empresaId}", name="listar", methods={"GET"})
     * @param int $empresaId
     * @return JsonResponse
     */
    public function listar(int $empresaId): JsonResponse
    {
        $empresa = $this->service->buscarEmpresa($empresaId);

        return new JsonResponse($empresa);
    }

    /**
     * @Route("/inserir", name="inserir", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function inserir(Request $request): JsonResponse
    {
        $this->service->inserirEmpresa($request);

        return $this->json(['data'=>'Empresa cadastrada com sucesso']);
    }

    /**
     * @Route("/atualizar/{empresaId}", name="update", methods={"PUT", "PATCH"})
     * @param int $empresaId
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(int $empresaId, Request $request): JsonResponse
    {
        $this->service->update($empresaId, $request);

        return $this->json(['data'=>'Dados atualizados com sucesso']);
    }

    /**
     * @Route("/delete/{empresaId}", name="deletar", methods={"DELETE"})
     * @param int $empresaId
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(int $empresaId): JsonResponse
    {
        $this->service->deleteEmpresa($empresaId);

        return $this->json(['data'=>'Deletado com sucesso']);
    }

    /**
     * @Route("/socios/{empresaId}/", methods={"GET"})
     * @return JsonResponse
     */
    public function buscarSocios(int $empresaId): JsonResponse
    {
        $socios = $this->service->findSocios($empresaId);

        return new JsonResponse($socios);
    }
}
