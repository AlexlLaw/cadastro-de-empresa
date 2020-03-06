<?php

namespace App\Service;

use App\Entity\Socio;
use App\Repository\SocioRepository;
use App\Repository\EmpresaRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SocioService
 * @package App\Service
 */
class SocioService extends AbstractController
{
    /**
     * @var SocioRepository
     */
    private $repository;

    /**
     * @var EmpresaRepository
     */
    private $empresaRepository;

    /**
     * SocioService constructor.
     * @param SocioRepository $repository
     * @param EmpresaRepository $empresaRepository
     */
    public function __construct(
        SocioRepository $repository,
        EmpresaRepository $empresaRepository
    ) {
        $this->repository = $repository;
        $this->empresaRepository = $empresaRepository;
    }

    /**
     * @param Request $request
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function insertSocio(Request $request): void
    {
        $data = json_decode($request->getContent(), false);
        $empresa = $this->empresaRepository->find($data->empresa_id);

        $socio = new Socio();
        $socio->setNome($data->nome);
        $socio->setCpf($data->cpf);
        $socio->setTelefone($data->telefone);
        $socio->setEndereco($data->endereco);
        $socio->setCargo($data->cargo);
        $socio->setEmpresaID($empresa);

        $this->repository->insertSocio($socio);
    }

    /**
     * @return array
     */
    public function seach(): array
    {
        return $this->repository->seachAll();
    }

    /**
     * @param int $socioId
     * @return Socio|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function seachSocio(int $socioId): ? Socio
    { 
        return $this->repository->seachSocio($socioId);
    }

    /**
     * @param int $socioId
     * @param Request $request
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function updateSocio(int $socioId, Request $request)
    {
        $data = json_decode($request->getContent());
        $empresa = $this->repository->seachSocio($socioId);

        if (isset($data->nome)) {
            $empresa->setNome($data->nome);
        }

        if (isset($data->cpf)) {
            $empresa->setCpf($data->cpf);
        }

        if (isset($data->telefone)) {
            $empresa->setTelefone($data->telefone);
        }

        if (isset($data->endereco)) {
            $empresa->setEndereco($data->endereco);
        }

        if (isset($data->cargo)) {
            $empresa->setCargo($data->cargo);
        }
        
        if (isset($data->empresaId)) {
            $empresa->setEmpresaID($data->empresa_id_id);
        }

        $this->repository->updateSocio($socioId);
    }

    /**
     * @param int $socioId
     * @throws ORMException
     * @throws OptimisticLockException
     */
     public function deleteSocio(int $socioId): void
     {
        $socio = $this->repository->find($socioId);
        $this->repository->deleteSocio($socio);
     }
}

