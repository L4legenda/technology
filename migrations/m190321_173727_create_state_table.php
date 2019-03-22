<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%state}}`.
 */
class m190321_173727_create_state_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%state}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'anons' => $this->text(),
            'text' => $this->text(),
            'status' => $this->string(),
            'date' => $this->date(),
            'author' => $this->integer()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%state}}');
    }
}
