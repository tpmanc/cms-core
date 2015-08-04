<?php

use yii\db\Schema;
use yii\db\Migration;

class m150724_083434_menuTable extends Migration
{
    public function safeUp()
    {
        $this->createTable('menu', [
            'id' => Schema::TYPE_PK,
            'tree' => Schema::TYPE_INTEGER,
            'lft' => Schema::TYPE_INTEGER . ' NOT NULL',
            'rgt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'depth' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'link'=> Schema::TYPE_STRING . '(255) NOT NULL',
            'isCategory'=> Schema::TYPE_BOOLEAN . ' NOT NULL',
            'categoryId'=> Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->insert('menu', [
            'lft' => '1',
            'rgt' => '2',
            'depth' => '0',
            'name' => 'Menu Root',
            'link'=> '',
            'isCategory'=> 0,
            'categoryId'=> 0,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('menu');
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
