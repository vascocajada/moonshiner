<?php

class DealRules
{
    public static function checkA($cartsCount, $orderCount, $total)
    {
        if ($cartsCount > 4 && $orderCount > 0) {
            $total = max(0, $total -5);
        }

        return $total;
    }

    public static function checkB($carts, $total)
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

    public static function checkC($orderCount)
    {
        if ($orderCount > 0) {
            return 'OneHoodie';
        }
        return '';
    }

    public static function checkD($voucherCode, $total)
    {
        if ($voucherCode == 'Welcome1337') { $total = 0; }
        return $total;
    }

    public static function checkE($carts, $total)
    {
        foreach($carts as $cart) {
            if ($cart['product_id'] == 1) {
                $total = $total - $cart['product_price'];
                return $total;
            }
            if ($cart['product_id'] == 2) {
                $total = $total - $cart['product_price'];
                return $total;
            }
        }

        return $total;
    }
}