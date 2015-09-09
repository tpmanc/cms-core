<?php

use yii\db\Schema;
use yii\db\Migration;

class m150909_063017_brandCheckbox extends Migration
{
    public function safeUp()
    {
        $this->addColumn('category', 'isBrand', Schema::TYPE_BOOLEAN . ' NOT NULL');
        $this->addColumn('category', 'isVisibleInBreadcrumbs', Schema::TYPE_BOOLEAN . ' NOT NULL');
        $this->addColumn('category', 'isVisibleInMenu', Schema::TYPE_BOOLEAN . ' NOT NULL');
        $this->dropColumn('category', 'position');
    }

    public function safeDown()
    {
        $this->dropColumn('category', 'isBrand');
        $this->dropColumn('category', 'isVisibleInBreadcrumbs');
        $this->dropColumn('category', 'isVisibleInMenu');
        $this->addColumn('category', 'position', Schema::TYPE_INTEGER . ' NOT NULL');
    }
}
