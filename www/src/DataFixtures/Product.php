<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Product as ProductEntity;

class Product extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product = new ProductEntity();
        $product->setName('Hoodie1');
        $product->setPrice(10);
        $manager->persist($product);

        $product = new ProductEntity();
        $product->setName('Hoodie2');
        $product->setPrice(20);
        $manager->persist($product);

        $product = new ProductEntity();
        $product->setName('Hoodie3');
        $product->setPrice(30);
        $manager->persist($product);

        $product = new ProductEntity();
        $product->setName('Hoodie4');
        $product->setPrice(40);
        $manager->persist($product);

        $manager->flush();
    }
}
