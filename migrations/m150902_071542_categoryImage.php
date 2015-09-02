<?php

use yii\db\Schema;
use yii\db\Migration;

class m150902_071542_categoryImage extends Migration
{
    public function safeUp()
    {
        $this->createTable('categoryImage', [
            'id' => Schema::TYPE_PK,
            'itemId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
        ]);

        $this->addForeignKey(
            'FK_categoryImage_category', 'categoryImage', 'itemId', 'category', 'id', 'CASCADE', 'CASCADE'
        );

        $this->createTable('categoryImageSize', [
            'id' => Schema::TYPE_PK,
            'imageId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'path' => Schema::TYPE_STRING . '(255) NOT NULL',
            'size' => Schema::TYPE_STRING . '(255) NOT NULL',
        ]);

        $this->addForeignKey(
            'FK_categoryImageSize_categoryImage', 'categoryImageSize', 'imageId', 'categoryImage', 'id', 'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_categoryImage_category', 'categoryImage');
        $this->dropForeignKey('FK_categoryImageSize_categoryImage', 'categoryImageSize');

        $this->dropTable('categoryImage');
        $this->dropTable('categoryImageSize');
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
