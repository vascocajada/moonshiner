<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use PHPUnit\Framework\TestCase;

final class SpecialDealTest extends KernelTestCase
{
    public function testA(): void
    {
        static::bootKernel();

        $total = \DealRules::checkA(3, 0, 10);
        $this->assertSame(10, $total);

        $total = \DealRules::checkA(5, 0, 10);
        $this->assertSame(10, $total);

        $total = \DealRules::checkA(5, 1, 10);
        $this->assertSame(5, $total);
    }

    public function testB(): void
    {
        static::bootKernel();

        $total = \DealRules::checkB([
            [
                'product_id' => 1,
                'product_price' => 10
            ],
            [
                'product_id' => 2,
                'product_price' => 20
            ],
            [
                'product_id' => 3,
                'product_price' => 30
            ],
        ], 60);
        $this->assertSame(60, $total);

        $total = \DealRules::checkB([
            [
                'product_id' => 1,
                'product_price' => 10
            ],
            [
                'product_id' => 1,
                'product_price' => 10
            ],
            [
                'product_id' => 3,
                'product_price' => 30
            ],
        ], 50);
        $this->assertSame(40, $total);
    }

    public function testC(): void
    {
        static::bootKernel();

        $voucherCode = \DealRules::checkC(1);
        $this->assertSame('OneHoodie', $voucherCode);

        $voucherCode = \DealRules::checkC(0);
        $this->assertSame('', $voucherCode);
    }

    public function testD(): void
    {
        static::bootKernel();

        $total = \DealRules::checkD('asd', 100);
        $this->assertSame(100, $total);

        $total = \DealRules::checkD('foo', 40);
        $this->assertSame(40, $total);

        $total = \DealRules::checkD('Welcome1337', 100);
        $this->assertSame(0, $total);
    }

    public function testE(): void
    {
        static::bootKernel();

        $total = \DealRules::checkE([
            [
                'product_id' => 1,
                'product_price' => 10
            ],
            [
                'product_id' => 3,
                'product_price' => 30
            ],
            [
                'product_id' => 1,
                'product_price' => 10
            ],
        ], 50);
        $this->assertSame(40, $total);

        $total = \DealRules::checkE([
            [
                'product_id' => 3,
                'product_price' => 30
            ],
            [
                'product_id' => 4,
                'product_price' => 10
            ],
            [
                'product_id' => 3,
                'product_price' => 30
            ],
        ], 70);
        $this->assertSame(70, $total);

        $total = \DealRules::checkE([
            [
                'product_id' => 1,
                'product_price' => 10
            ],
            [
                'product_id' => 2,
                'product_price' => 10
            ],
            [
                'product_id' => 3,
                'product_price' => 30
            ],
        ], 50);
        $this->assertSame(40, $total);
    }
}