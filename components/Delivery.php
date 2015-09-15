<?php

namespace tpmanc\cmscore\components;

/**
 * Working delivery
 */
class Delivery
{
    /**
     * Get delivery price
     * @param integer $productPrice Prodcuct price
     * @return integer Delivery price
     */
    public static function price($productPrice)
    {
        if ($productPrice < 3000) {
            return 300;
        } else {
            return 0;
        }
    }
}
