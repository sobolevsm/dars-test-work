<?php

declare(strict_types=1);

namespace api\controllers\admin;

use api\behaviors\AccessTokenAuthBehavior;
use yii\rest\Controller;

class BaseController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => AccessTokenAuthBehavior::class
            ],
        ];
    }
}
