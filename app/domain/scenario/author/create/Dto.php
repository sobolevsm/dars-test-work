<?php

declare(strict_types=1);

namespace domain\scenario\author\create;

use yii\base\Model;

class Dto extends Model
{
    public $name;
    public $country;

    public function rules()
    {
        return [
            [['name', 'country'], 'required'],
            [['name', 'country'], 'string'],
        ];
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }
}
