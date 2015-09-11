<?php

use yii\db\Schema;
use yii\db\Migration;

class m150911_122436_callback extends Migration
{
    public function up()
    {
        $this->createTable('callback', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'phone' => Schema::TYPE_STRING . '(255) NOT NULL',
            'date' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status'=> Schema::TYPE_INTEGER . '(1) NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('callback');
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
