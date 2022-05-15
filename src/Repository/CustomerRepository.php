<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Customer>
 *
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    public function add(Customer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Customer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
    /**
     * 顧客ごとの、あるprice以上のアイテムの合計priceを返します
     * @param $specifiedPrice
     * @return array
     */
   public function totallingThePriceOrMore($specifiedPrice): array
   {
       $query = $this->createQueryBuilder('c')
           ->select('c.name as customer_name')
           ->addSelect('co.order_date')
           ->addSelect('oi.name as item_name')
           ->addSelect('SUM(oi.price) as item_price')
           ->addSelect('SUM(oi.amount) as item_amount')
           ->innerJoin('c.customerOrders', 'co')
           ->innerJoin('co.orderItems', 'oi')
           ->andWhere('oi.price >= :specifiedPrice')
           ->setParameter('specifiedPrice', $specifiedPrice)
           ->groupBy('c.name')
           ->addGroupBy('co.order_date')
           ->addGroupBy('oi.name')
           ->orderBy('c.id', 'ASC')
           ->getQuery();
       
       return $query->getResult();
   }

//    public function findOneBySomeField($value): ?Customer
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
