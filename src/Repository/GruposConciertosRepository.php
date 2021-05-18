<?php

namespace App\Repository;

use App\Entity\GruposConciertos;
use App\Entity\Grupos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GruposConciertos|null find($id, $lockMode = null, $lockVersion = null)
 * @method GruposConciertos|null findOneBy(array $criteria, array $orderBy = null)
 * @method GruposConciertos[]    findAll()
 * @method GruposConciertos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GruposConciertosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GruposConciertos::class);
    }

    
}
