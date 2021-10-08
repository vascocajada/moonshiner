<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use App\Entity\Member;
use App\Entity\OrderPaid;
use App\Entity\Cart;
use App\Entity\Product;

final class SpecialDealTest extends KernelTestCase
{

    public function testCaseA(): void
    {
        static::bootKernel();
        $entityManager = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $doctrine = static::$kernel->getContainer()->get('doctrine');

        $productRepository = $doctrine->getRepository(Product::class);

        $member = new Member();
        $member->setName('Mr. Test');

        $entityManager->persist($member);
        $entityManager->flush();

        # repeating customer
        $orderPaid = new OrderPaid();
        $orderPaid->setIdMember($member->getId());
        $orderPaid->setTotal(10);
        $entityManager->persist($orderPaid);

        # ordering more than 4pcs of different hoodies
        for ($i = 1; $i < 5; $i++) {
            $cart = new Cart();
            $cart->setProduct($productRepository->find($i));
            $cart->setMember($member);
            $entityManager->persist($cart);

        }
        $entityManager->flush();

        $carts = $member->getCarts();
        $total = \DealRules::check($doctrine, $member->getId());

        $this->assertSame(95, $total);
    }
}