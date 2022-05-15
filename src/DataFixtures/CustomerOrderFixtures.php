<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\CustomerOrder;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CustomerOrderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $repository = $manager->getRepository(Customer::class);
        $customers = $repository->findAll();
    
        $orderDate = new DateTime('now');
        foreach ($customers as $customer) {
            $entity = new CustomerOrder();
            $entity->setCustomer($customer);
            $entity->setOrderDate($orderDate);
            $manager->persist($entity);
        }
    
        $manager->flush();
    }
}
