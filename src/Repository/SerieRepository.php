<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }

    public function filter($search)
    {
        $query = $this
            ->createQueryBuilder('s')
            ->addSelect('s');
        $query
            ->orderBy('s.popularity', 'DESC');
        if ($search->getName()) {
            $query
                ->andWhere('s.name LIKE :name')
                ->setParameter('name', '%' . $search->getName() . '%');
        }
        if ($search->getPopularity()) {
            $query
                ->orderBy('s.popularity', 'DESC');
        }
        if ($search->isVote()) {
            $query
                ->orderBy('s.vote', 'DESC');
        }
        if ($search->getGenres()) {
            $query
                ->andWhere('s.genres LIKE :genre')
                ->setParameter('genre', '%' . $search->getGenres() . '%');
        }
        if ($search->getLastAirDate()) {
            $query
                ->orderBy('s.lastAirDate', 'DESC');
        }
        return $query->getQuery()->getResult();
    }
}
