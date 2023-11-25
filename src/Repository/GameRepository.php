<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 *
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function getImages(): array
    {
        return $this->createQueryBuilder('g')
            ->select('g.image')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function getDone(): array
    {
        return $this->createQueryBuilder('g')
            ->where('g.done = 1')
            ->getQuery()
            ->getResult();
    }

    public function getNotDone(): array
    {
        return $this->createQueryBuilder('g')
            ->where('g.done = 0')
            ->getQuery()
            ->getResult();
    }

    public function getByMonth(): array
    {
        return $this->createQueryBuilder('g')
            ->where('g.month IS NOT NULL')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Game[] Returns an array of Game objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Game
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
