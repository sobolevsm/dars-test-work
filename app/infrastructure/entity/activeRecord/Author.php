<?php

declare(strict_types=1);

namespace infrastructure\entity\activeRecord;

use yii\db\ActiveRecord;

class Author extends ActiveRecord
{
    public static function tableName()
    {
        return 'authors';
    }

    public function getBooks()
    {
        return $this->hasMany(Book::class, ['author_id' => 'id']);
    }

    public function rules()
    {
        return [
            [['name', 'country'], 'required'],
            [['name', 'country'], 'string', 'max' => 255],
        ];
    }
}
