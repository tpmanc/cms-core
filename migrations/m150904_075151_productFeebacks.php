<?php

use yii\db\Schema;
use yii\db\Migration;

class m150904_075151_productFeebacks extends Migration
{
    public function safeUp()
    {
        $this->createTable('productFeedback', [
            'id' => Schema::TYPE_PK,
            'productId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'email' => Schema::TYPE_STRING . '(255) NOT NULL',
            'advantages' => Schema::TYPE_TEXT . ' NOT NULL',
            'disadvantages' => Schema::TYPE_TEXT . ' NOT NULL',
            'comment' => Schema::TYPE_TEXT . ' NOT NULL',
            'date' => Schema::TYPE_INTEGER . ' NOT NULL',
            'isDisabled' => Schema::TYPE_BOOLEAN . ' NOT NULL',
        ]);

        $this->addForeignKey(
            'FK_productFeedbak_product', 'productFeedback', 'productId', 'product', 'id', 'CASCADE', 'CASCADE'
        );

        $this->dropColumn('product', 'discount');
        $this->addColumn('product', 'discountPrice', Schema::TYPE_INTEGER . ' NOT NULL');

    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_productFeedbak_product', 'productFeedback');
        $this->dropTable('productFeedback');

        $this->dropColumn('product', 'discountPrice');
        $this->addColumn('product', 'discount', Schema::TYPE_INTEGER . ' NOT NULL');
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
