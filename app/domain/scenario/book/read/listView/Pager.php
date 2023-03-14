<?php

declare(strict_types=1);

namespace domain\scenario\book\read\listView;

use yii\base\Model;

class Pager extends Model
{
    public $page;
    public $limit;

    public function rules()
    {
        return [
            [['page', 'limit'], 'required'],
            [['page', 'limit'], 'integer']
        ];
    }
}
