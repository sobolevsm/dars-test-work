<?php

declare(strict_types=1);

namespace api\controllers\admin\genre\read;

use api\controllers\admin\BaseController;
use infrastructure\entity\activeRecord\Genre;

class GenreViewController extends BaseController
{
    public function actionIndex($id)
    {
        return Genre::findOne((int)$id);
    }
}
