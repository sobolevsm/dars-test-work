<?php

declare(strict_types=1);

namespace api\controllers\admin\genre\read;

use api\controllers\admin\BaseController;
use infrastructure\entity\activeRecord\Genre;

class GenreListController extends BaseController
{
    public function actionIndex()
    {
        return Genre::find()->all();
    }
}
