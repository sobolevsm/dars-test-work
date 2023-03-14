<?php

declare(strict_types=1);

namespace api\controllers\admin\author\read;

use infrastructure\entity\activeRecord\Author;
use api\controllers\admin\BaseController;

class AuthorViewController extends BaseController
{
    public function actionIndex($id)
    {
        return Author::findOne((int)$id);
    }
}
