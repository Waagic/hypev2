<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 *
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function getImages(): array
    {
        return $this->createQueryBuilder('m')
            ->select('m.picture')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function getDone(): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.done = 1')
            ->getQuery()
            ->getResult();
    }

    public function getNotDone(): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.done = 0')
            ->getQuery()
            ->getResult();
    }

    public function getByMonth(): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.month IS NOT NULL')
            ->getQuery()
            ->getResult();
    }
}
