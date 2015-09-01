<?php

use yii\db\Schema;
use yii\db\Migration;

class m150901_100352_fastBuyOrder extends Migration
{
    public function up()
    {
        $this->addColumn('order', 'isFastBuy', Schema::TYPE_BOOLEAN . ' NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('order', 'isFastBuy');
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
