<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use PHPUnit\Framework\TestCase;

final class SpecialDealTest extends KernelTestCase
{
    public function testA(): void
    {
        static::bootKernel();
        $dealRules = new \DealRules();

        $total = $dealRules->checkA(3, 0, 10);
        $this->assertSame(10, $total);

        $total = $dealRules->checkA(5, 0, 10);
        $this->assertSame(10, $total);

        $total = $dealRules->checkA(5, 1, 10);
        $this->assertSame(5, $total);
    }

    public function testB(): void
    {
        static::bootKernel();
        $dealRules = new \DealRules();

        $total = $dealRules->checkB([
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

        $total = $dealRules->checkB([
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
        $dealRules = new \DealRules();

        $voucherCode = $dealRules->checkC(1);
        $this->assertSame('OneHoodie', $voucherCode);

        $voucherCode = $dealRules->checkC(0);
        $this->assertSame('', $voucherCode);
    }

    public function testD(): void
    {
        static::bootKernel();
        $dealRules = new \DealRules();

        $total = $dealRules->checkD('asd', 100);
        $this->assertSame(100, $total);

        $total = $dealRules->checkD('foo', 40);
        $this->assertSame(40, $total);

        $total = $dealRules->checkD('Welcome1337', 100);
        $this->assertSame(0, $total);
    }

    public function testE(): void
    {
        static::bootKernel();
        $dealRules = new \DealRules();

        $total = $dealRules->checkE([
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

        $total = $dealRules->checkE([
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

        $total = $dealRules->checkE([
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