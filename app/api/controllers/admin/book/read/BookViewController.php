<?php

declare(strict_types=1);

namespace api\controllers\admin\book\read;

use api\controllers\admin\BaseController;
use infrastructure\entity\activeRecord\Book;

class BookViewController extends BaseController
{
    public function actionIndex($id)
    {
        $book = Book::findOne((int)$id);

        return $book ? new ViewResponse($book) : null;
    }
}
