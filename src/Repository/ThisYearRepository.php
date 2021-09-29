<?php

namespace App\Repository;

use App\Entity\ThisYear;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ThisYear|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThisYear|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThisYear[]    findAll()
 * @method ThisYear[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThisYearRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThisYear::class);
    }

    // /**
    //  * @return ThisYear[] Returns an array of ThisYear objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
    public function findEvents(string $month, int $day): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT e
            FROM App\Entity\ThisYear e
            WHERE e.month = :month AND e.day = :day ORDER BY e.hour DESC'
            
        )->setParameter('month', $month)
         ->setParameter('day', $day);

        
        return $query->getResult();
    }
    
    public function countEvents(string $month, int $day): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT Count(e)
            FROM App\Entity\ThisYear e
            WHERE e.month = :month AND e.day = :day'
            
        )->setParameter('month', $month)
         ->setParameter('day', $day);

        
        return $query->getResult();
    }
    public function deleteEvents(string $month, int $day, string $event): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT e
            FROM App\Entity\ThisYear e
            WHERE e.month = :month AND e.day = :day AND e.event = :event'
            
        )->setParameter('month', $month)
         ->setParameter('day', $day)
         ->setParameter('event', $event);
        
        return $query->getResult();
    }
}
