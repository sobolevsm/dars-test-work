<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%access_token}}`.
 */
class m230312_223946_create_access_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%access_token}}', [
            'id' => $this->primaryKey(),
            'token' => $this->string()->notNull()->unique()
        ]);

        $this->insert('{{%access_token}}', [
            'token' => 'eaf7b226-28d6-4080-95c6-16ab3358b530',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%access_token}}');
    }
}
