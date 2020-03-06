<?php

namespace App\Service;

use App\Entity\Empresa;
use App\Repository\EmpresaRepository;
use App\Repository\SocioRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EmpresaService
 * @package App\Service
 */
class EmpresaService extends AbstractController
{
    /**
     * @var EmpresaRepository
     */
    private $repository;

    /**
     * @var SocioRepository
     */
    private $socioRepository;

    /**
     * EmpresaService constructor.
     * @param EmpresaRepository $empresaRepository
     * @param SocioRepository $socioRepository
     */
    public function __construct(
        EmpresaRepository $empresaRepository,
        SocioRepository $socioRepository
    ) {
        $this->repository = $empresaRepository;
        $this->socioRepository = $socioRepository;
    }

    /**
     * @param Request $request
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function inserirEmpresa(Request $request): void
    {
        $data = json_decode($request->getContent(), false);

        $empresa = new Empresa();
        $empresa->setNomeDaEmpresa($data->nomeDaEmpresa)?? null;
        $empresa->setCnpj($data->cnpj);
        $empresa->setTelefone($data->telefone ?? null);
        $empresa->setEndereco($data->endereco ?? "");

        $this->repository->inserirEmpresa($empresa);
    }

    /**
     * @return array
     */
    public function listar(): array
    {
        return $this->repository->buscarTodos();
    }

    /**
     * @param int $empresaId
     * @return Empresa|null
     */
    public function buscarEmpresa(int $empresaId): ?Empresa
    {
        return $this->repository->buscarEmpresa($empresaId);
    }

    /**
     * @param int $empresaId
     * @param Request $request
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(int $empresaId, Request $request)
    {
        $data = json_decode($request->getContent());
        $empresa = $this->repository->buscarEmpresa($empresaId);

        if (isset($data->nomeDaEmpresa)) {
            $empresa->setNomeDaEmpresa($data->nomeDaEmpresa);
        }

        if (isset($data->cnpj)) {
            $empresa->setCnpj($data->cnpj);
        }

        if (isset($data->telefone)) {
            $empresa->setTelefone($data->telefone);
        }

        if (isset($data->endereco)) {
            $empresa->setEndereco($data->endereco);
        }

        $this->repository->update($empresa);    
    }

    /**
     * @param int $empresaId
     * @throws ORMException
     * @throws OptimisticLockException
     */
     public function deleteEmpresa(int $empresaId): void
     {
        $empresa = $this->repository->find($empresaId);
        $this->repository->deleteEmpresa($empresa);
     }

    /**
     * @param int $empresaId
     * @return mixed
     */
     public function findSocios(int $empresaId)
     {
        return $this->socioRepository->findSocios($empresaId);
     }
}
