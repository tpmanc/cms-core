<?php

namespace tpmanc\cmscore;

class CoreModule extends \yii\base\Module
{
    public $controllerNamespace = 'tpmanc\cmscore\controllers';

    public $defaultRoute = 'dashboard/index';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
