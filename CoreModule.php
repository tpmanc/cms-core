<?php

namespace tpmanc\cmscore;

use Yii;

class CoreModule extends \yii\base\Module
{
    public $controllerNamespace = 'tpmanc\cmscore\controllers';

    public $defaultRoute = 'dashboard/index';

    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    private function registerTranslations()
    {
        Yii::$app->i18n->translations['core*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/tpmanc/cms-core/messages',
            'fileMap' => [
                'core' => 'core.php',
                'core/staticPage' => 'coreStaticPage.php',
                'core/category' => 'coreCategory.php',
                'core/deliveryType' => 'coreDeliveryType.php',
                'core/paymentType' => 'corePaymentType.php',
                'core/product' => 'coreProduct.php',
                'core/menu' => 'coreMenu.php',
                'core/user' => 'coreUser.php',
                'core/productRests' => 'coreProductRests.php',
                'core/order' => 'coreOrder.php',
                'core/orderProducts' => 'coreOrderProducts.php',
                'core/supplier' => 'coreSupplier.php',
                'core/error' => 'error.php',
            ],
        ];
    }
}
