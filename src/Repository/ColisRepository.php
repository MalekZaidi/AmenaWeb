<?php

namespace App\Repository;

use App\Entity\Colis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Colis>
 *
 * @method Colis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Colis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Colis[]    findAll()
 * @method Colis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Colis::class);
    }

    public function save(Colis $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Colis $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function countMonth(string $month): int
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->where('MONTH(c.datelivraison) = :month')
            ->setParameter('month', $month)
            ->getQuery()
            ->getSingleScalarResult();
    }
    public function findShipmentsWithDates(): array
{
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery(
        'SELECT c.id, c.dateExpedition
        FROM App\Entity\Colis c'
    );
    return $query->getResult();
}public function findBySearchQuerya($nsc){
    return $this->createQueryBuilder('colis')
    ->where('colis.nomExpediteur LIKE :email')
    ->setParameter('email', '%'.$nsc.'%')
    ->getQuery()
    ->getResult();
    }
}

//    /**
//     * @return Colis[] Returns an array of Colis objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Colis
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

