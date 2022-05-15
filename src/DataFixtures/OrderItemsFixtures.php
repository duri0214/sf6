<?php

namespace App\DataFixtures;

use App\Entity\CustomerOrder;
use App\Entity\OrderItems;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OrderItemsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $itemList = ['バナナ', 'りんご', 'メロン', 'レタス', 'キャベツ', 'にんじん'];
        
        $repository = $manager->getRepository(CustomerOrder::class);
        $orders = $repository->findAll();
    
        foreach ($orders as $order) {
            $entity = new OrderItems();
            $entity->setCustomerOrder($order);
            $entity->setName($faker->randomElement($itemList));
            $entity->setPrice($faker->numberBetween(min: 1000, max: 3000));
            $entity->setAmount($faker->numberBetween(min: 1, max: 10));
            $manager->persist($entity);
        }
        foreach ($orders as $order) {
            $entity = new OrderItems();
            $entity->setCustomerOrder($order);
            $entity->setName($faker->randomElement($itemList));
            $entity->setPrice($faker->numberBetween(min: 1000, max: 3000));
            $entity->setAmount($faker->numberBetween(min: 1, max: 10));
            $manager->persist($entity);
        }
    
        $manager->flush();
    }
}
