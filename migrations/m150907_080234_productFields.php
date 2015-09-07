<?php

use yii\db\Schema;
use yii\db\Migration;

class m150907_080234_productFields extends Migration
{
    public function safeUp()
    {
        $this->addColumn('product', 'isNew', Schema::TYPE_BOOLEAN . ' NOT NULL');
        $this->addColumn('product', 'isBest', Schema::TYPE_BOOLEAN . ' NOT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('product', 'isNew');
        $this->dropColumn('product', 'isBest');
    }
}
