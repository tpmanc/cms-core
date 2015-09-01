<?php

namespace tpmanc\cmscore\models;

class Basket
{
    private static $cookieName = 'basket';

    private static $fastBuyCookieName = 'basket';

    /**
     * Order basket
     * @return array Order basket array
     */
    public static function order()
    {
        $basket = isset($_COOKIE[self::$cookieName]) ? $_COOKIE[self::$cookieName] : '{}' ;
        $basket = json_decode($basket, true);
        return $basket;
    }

    /**
     * Fast order basket
     * @return array Fast order basket array
     */
    public static function fast()
    {
        $basket = isset($_COOKIE[self::$fastBuyCookieName]) ? $_COOKIE[self::$fastBuyCookieName] : '{}' ;
        $basket = json_decode($basket, true);
        return $basket;
    }

    /**
     * Get products amount and summary price
     * @return array Products amount and summary price
     */
    public static function info()
    {
        $basket = self::order();
        $count = 0;
        $price = 0;
        foreach ($basket as $elem) {
            if (isset($elem['amount']) && isset($elem['price'])) {
                $count += $elem['amount'];
                $price += $elem['amount'] * $elem['price'];
            }
        }

        return [
            'count' => $count,
            'price' => $price,
        ];
    }
}
