<?php

use yii\db\Schema;
use yii\db\Migration;

class m150725_175137_expandMenutable extends Migration
{
    public function up()
    {
        $this->addColumn('menu', 'link', Schema::TYPE_STRING . '(255) NOT NULL');
        $this->addColumn('menu', 'isCategory', Schema::TYPE_BOOLEAN . ' NOT NULL');
        $this->addColumn('menu', 'categoryId', Schema::TYPE_INTEGER . ' NOT NULL');

        $this->insert('menu', [
            'id' => 1,
            'tree' => NULL,
            'lft' => 1,
            'rgt' => 2,
            'depth' => 0,
            'name' => 'Menu Root',
            'link' => '',
            'isCategory' => 0,
            'categoryId' => 0,
        ]);
    }

    public function down()
    {
        $this->dropColumn('menu', 'isCategory');
        $this->dropColumn('menu', 'categoryId');
        $this->dropColumn('menu', 'link');
    }
}
