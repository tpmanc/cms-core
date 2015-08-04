<?php

use yii\db\Schema;
use yii\db\Migration;

class m150804_091113_settings extends Migration
{
    public function safeUp()
    {
        $this->createTable('setting', [
            'id' => Schema::TYPE_PK,
            'key' => Schema::TYPE_STRING . '(255) NOT NULL',
            'group' => Schema::TYPE_STRING . '(255) NOT NULL',
            'value' => Schema::TYPE_TEXT . ' NOT NULL',
        ]);

        $this->insert('setting', [
            'key' => 'shopTitle',
            'group' => 'Main',
            'value' => 'Yii 2 CMS',
        ]);

        $this->insert('setting', [
            'key' => 'seoText',
            'group' => 'Main Page',
            'value' => '',
        ]);
        $this->insert('setting', [
            'key' => 'seoTitle',
            'group' => 'Main Page',
            'value' => '',
        ]);
        $this->insert('setting', [
            'key' => 'seoDescription',
            'group' => 'Main Page',
            'value' => '',
        ]);
        $this->insert('setting', [
            'key' => 'seoKeywords',
            'group' => 'Main Page',
            'value' => '',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('setting');
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
