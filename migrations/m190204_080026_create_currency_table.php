<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency}}`.
 */
class m190204_080026_create_currency_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'rate' => $this->float(4),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%currency}}');
    }
}
