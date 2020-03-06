<?php

namespace App\Repository;

use App\Entity\Empresa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use phpDocumentor\Reflection\Types\Collection;

/**
 * @method Empresa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Empresa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Empresa[]    findAll()
 * @method Empresa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmpresaRepository extends ServiceEntityRepository
{
    /**
     * EmpresaRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Empresa::class);
    }

    /**
     * @param Empresa $projeto
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function inserirEmpresa(Empresa $projeto)
    {
        $this->getEntityManager()->persist($projeto);
        $this->getEntityManager()->flush();
    }

    /**
     * @return array
     */
    public function buscarTodos(): array
    {
        return $this->findAll();
    }

    /**
     * @param Empresa $empresa
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Empresa $empresa)
    {
        $this->getEntityManager()->persist($empresa);
        $this->getEntityManager()->flush();
    }

    /**
     * @param int $empresaId
     * @return Empresa|null
     */
    public function buscarEmpresa(int $empresaId): ?Empresa
    {
        return $this->find($empresaId);
    }

    /**
     * @param Empresa $empresa
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function deleteEmpresa(Empresa $empresa)
    {
       
        $this->getEntityManager()->remove($empresa);
        $this->getEntityManager()->flush();
    }
}
