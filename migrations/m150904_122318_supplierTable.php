<?php

use yii\db\Schema;
use yii\db\Migration;

class m150904_122318_supplierTable extends Migration
{
    public function safeUp()
    {
        $this->createTable('supplier', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->createTable('productSupplier', [
            'id' => Schema::TYPE_PK,
            'productId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'supplierId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'nomenclature' => Schema::TYPE_STRING . '(255) NOT NULL',
        ]);

        $this->addForeignKey(
            'FK_productSupplier_product', 'productSupplier', 'productId', 'product', 'id', 'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'FK_productSupplier_supplire', 'productSupplier', 'supplierId', 'supplier', 'id', 'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_productSupplier_product', 'productSupplier');
        $this->dropForeignKey('FK_productSupplier_supplire', 'productSupplier');

        $this->dropTable('supplier');
        $this->dropTable('productSupplier');
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
