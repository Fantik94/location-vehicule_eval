<?php
namespace App\Repository;

use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class VehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule::class);
    }

    public function findAvailableVehicles(\DateTime $startDate, \DateTime $endDate)
    {
        $qb = $this->createQueryBuilder('v');
    
        $qb->leftJoin('v.commandes', 'c')
           ->where($qb->expr()->orX(
               $qb->expr()->isNull('c.id_commande'),
               $qb->expr()->lt('c.date_heure_fin', ':startDate'),
               $qb->expr()->gt('c.date_heure_depart', ':endDate')
           ))
           ->setParameter('startDate', $startDate)
           ->setParameter('endDate', $endDate)
           ->groupBy('v.id_vehicule');
    
        return $qb->getQuery()->getResult();
    }
}
