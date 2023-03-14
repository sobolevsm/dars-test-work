<?php

declare(strict_types=1);

namespace api\controllers\admin\book\delete;

use domain\exception\BookNotFoundException;
use domain\scenario\book\delete\Scenario;
use api\controllers\admin\BaseController;
use Exception;
use Yii;

class BookDeleteController extends BaseController
{
    private Scenario $scenario;

    public function __construct($id, $module, Scenario $scenario, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->scenario = $scenario;
    }

    public function actionIndex($id)
    {
        try {
            $this->scenario->execute((int)$id);
            Yii::$app->response->setStatusCode(204);
        } catch (BookNotFoundException $exception) {
            Yii::$app->response->setStatusCode(404);

            return ['error' => $exception->getMessage()];
        } catch (Exception $exception) {
            Yii::error($exception->getMessage());
            Yii::$app->response->setStatusCode(500);

            return ['error' => 'Ошибка при удалении книги'];
        }
    }
}
