<?php
namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    /**
     * @param int $idMembre
     * @return Commande[]
     */
    public function findByMembre(int $idMembre): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.idMembre = :id')
            ->setParameter('id', $idMembre)
            ->getQuery()
            ->getResult();
    }
}
