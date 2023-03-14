<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books_genres}}`.
 */
class m230305_175040_create_books_genres_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books_genres}}', [
            'book_id' => $this->integer()->notNull(),
            'genre_id' => $this->integer()->notNull(),
            'PRIMARY KEY(book_id, genre_id)',
        ]);

        $this->addForeignKey(
            '{{%fk_books_genres_books}}',
            '{{%books_genres}}',
            'book_id',
            '{{%books}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%fk_books_genres_genres}}',
            '{{%books_genres}}',
            'genre_id',
            '{{%genres}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk_books_genres_books}}', '{{%books_genres}}');
        $this->dropForeignKey('{{%fk_books_genres_genres}}', '{{%books_genres}}');
        $this->dropTable('{{%books_genres}}');
    }
}
