<?php

namespace tpmanc\cmscore\components;

/**
 * Working with site url
 */
class Chpu
{
    /**
     * Creat chpu from input text
     * @param string $str Input text
     */
    public static function create($str)
    {
        $chpu = $str;
        $chpu = str_replace("'", '', $chpu);
        $chpu = str_replace(" ", '-', $chpu);
        $chpu = str_replace(".", '', $chpu);
        $chpu = str_replace("+", '', $chpu);
        $chpu = strtolower($chpu);
        return $chpu;
    }
}
