<?php

declare(strict_types=1);

namespace domain\scenario\book\update;

use yii\base\Model;

class Dto extends Model
{
    public $title;
    public $genresId;
    public $authorId;
    public $publishedDate;

    public function rules()
    {
        return [
            [['title', 'genresId', 'authorId', 'publishedDate'], 'default', 'value' => null],
            [['title'], 'string', 'max' => 255],
            [['genresId'], 'each', 'rule' => ['integer']],
            [['authorId'], 'integer'],
            [['publishedDate'], 'date', 'format' => 'yyyy-MM-dd'],
        ];
    }
}
