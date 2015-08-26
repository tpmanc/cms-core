<?php

namespace tpmanc\cmscore\models;

class Basket
{
    private static $cookieName = 'basket';

    public static function all()
    {
        $basket = isset($_COOKIE[self::$cookieName]) ? $_COOKIE[self::$cookieName] : '{}' ;
        $basket = json_decode($basket, true);
        return $basket;
    }

    /**
     * Get products amount and summary price
     * @return array Products amount and summary price
     */
    public static function info()
    {
        $basket = self::all();
        $count = 0;
        $price = 0;
        foreach ($basket as $elem) {
            $count += $elem['amount'];
            $price += $elem['amount'] * $elem['price'];
        }

        return [
            'count' => $count,
            'price' => $price,
        ];
    }
}
