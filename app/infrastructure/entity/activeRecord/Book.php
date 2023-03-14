<?php

declare(strict_types=1);

namespace infrastructure\entity\activeRecord;

use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    public static function tableName()
    {
        return 'books';
    }

    public function getGenres()
    {
        return $this->hasMany(Genre::class, ['id' => 'genre_id'])
            ->viaTable('{{%books_genres}}', ['book_id' => 'id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    public function rules()
    {
        return [
            [['title', 'author_id', 'publication_date'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
            [['publication_date'], 'date', 'format' => 'yyyy-MM-dd'],
        ];
    }
}
