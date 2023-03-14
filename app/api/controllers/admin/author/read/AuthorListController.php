<?php

declare(strict_types=1);

namespace api\controllers\admin\author\read;

use infrastructure\entity\activeRecord\Author;
use api\controllers\admin\BaseController;

class AuthorListController extends BaseController
{
    public function actionIndex()
    {
        return Author::find()->all();
    }
}
