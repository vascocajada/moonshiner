<?php

use Symfony\Component\Yaml\Yaml;

class DealRules
{
    private $rules = [];

    public function __construct()
    {
        $this->rules = Yaml::parseFile(__DIR__.'/../../config/rules.yaml');
    }

    public function checkA($cartsCount, $orderCount, $total)
    {
        if ($cartsCount > $this->rules['ruleA']['cartsCount'] && $orderCount > $this->rules['ruleA']['orderCount']) {
            $total = max(0, $total -5);
        }

        return $total;
    }

    public function checkB($carts, $total)
    {
        $productIdsFound = [];
        foreach($carts as $key => $cart) {
            foreach($carts as $key2 => $cart2) {
                if ($key == $key2) { continue; }
                if ($cart['product_id'] == $cart2['product_id'] && !in_array($cart['product_id'], $productIdsFound)) {
                    $productIdsFound[] = $cart2['product_id'];
                    $total = $total - $cart2['product_price'];
                }
            }
        }

        return $total;
    }

    public function checkC($orderCount)
    {
        if ($orderCount > $this->rules['ruleC']['orderCount']) {
            return $this->rules['ruleC']['voucherCode'];
        }
        return '';
    }

    public function checkD($voucherCode, $total)
    {
        if ($voucherCode == $this->rules['ruleD']['voucherCode']) { $total = 0; }
        return $total;
    }

    public function checkE($carts, $total)
    {
        foreach($carts as $cart) {
            if ($cart['product_id'] == $this->rules['ruleE']['productA']) {
                $total = $total - $cart['product_price'];
                return max(0, $total);
            }
            if ($cart['product_id'] == $this->rules['ruleE']['productB']) {
                $total = $total - $cart['product_price'];
                return max(0, $total);
            }
        }

        return $total;
    }
}