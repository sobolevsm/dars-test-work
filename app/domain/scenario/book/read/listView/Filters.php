<?php

declare(strict_types=1);

namespace domain\scenario\book\read\listView;

use yii\base\Model;

class Filters extends Model
{
    public $genresId;
    public $authorName;
    public $authorCountry;
    public $publicationDate;

    public function rules()
    {
        return [
            [['genresId'], 'each', 'rule' => ['integer']],
            [['authorName', 'authorCountry'], 'string'],
            [['publicationDate'], 'date', 'format' => 'yyyy-MM-dd'],
        ];
    }
}
