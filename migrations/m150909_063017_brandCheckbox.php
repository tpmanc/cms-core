<?php

use yii\db\Schema;
use yii\db\Migration;

class m150909_063017_brandCheckbox extends Migration
{
    public function safeUp()
    {
        $this->addColumn('category', 'isBrand', Schema::TYPE_BOOLEAN . ' NOT NULL');
        $this->addColumn('menu', 'isDisabledInBreadcrumbs', Schema::TYPE_BOOLEAN . ' NOT NULL');
        $this->dropColumn('category', 'position');
    }

    public function safeDown()
    {
        $this->dropColumn('category', 'isBrand');
        $this->dropColumn('menu', 'isDisabledInBreadcrumbs');
        $this->addColumn('category', 'position', Schema::TYPE_INTEGER . ' NOT NULL');
    }
}
