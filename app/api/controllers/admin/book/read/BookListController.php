<?php

declare(strict_types=1);

namespace api\controllers\admin\book\read;

use api\controllers\admin\BaseController;
use infrastructure\entity\activeRecord\Book;

class BookListController extends BaseController
{
    public function actionIndex()
    {
        return array_map(
            static function (Book $book) {
                return new ViewResponse($book);
            },
            Book::find()->all()
        );
    }
}
