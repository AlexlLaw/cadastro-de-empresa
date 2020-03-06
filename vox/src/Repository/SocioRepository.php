<?php

namespace App\Repository;

use App\Entity\Socio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * @method Socio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Socio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Socio[]    findAll()
 * @method Socio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocioRepository extends ServiceEntityRepository
{
    /**
     * SocioRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Socio::class);
    }

    /**
     * @param Socio $socio
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function insertSocio(Socio $socio)
    {
        $this->getEntityManager()->persist($socio);
        $this->getEntityManager()->flush();
    }
    /**
     * @return array
     */
    public function seachAll(): array
    {
        return $this->findAll();
        
    }

    /**
     * @param int $socioId
     * @return Socio|null
     */
    public function seachSocio(int $socioId): ?Socio
    {
        return $this->find($socioId);
    }

    /**
     * @param Socio $socio
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function updateSocio(Socio $socio)
    {
        $this->getEntityManager()->persist($socio);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Socio $socio
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function deleteSocio(Socio $socio)
    {
        $this->getEntityManager()->remove($socio);
        $this->getEntityManager()->flush();
    }

    /**
     * @param $empresaId
     * @return mixed
     */
    public function findSocios($empresaId)
    {
        $socios = $this->createQueryBuilder('socios')
            ->where('socios.empresaId = :val')
            ->setParameter('val', $empresaId)
            ->getQuery()
            ->getResult();

        return $socios;
    }
}
