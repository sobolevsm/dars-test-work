<?php

declare(strict_types=1);

namespace api\controllers\admin\author\delete;

use api\controllers\admin\BaseController;
use domain\exception\AuthorNotFoundException;
use domain\scenario\author\delete\Scenario;
use Throwable;
use Yii;

class AuthorDeleteController extends BaseController
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
        } catch (AuthorNotFoundException $exception) {
            Yii::$app->response->setStatusCode(404);

            return ['error' => $exception->getMessage()];
        } catch (Throwable $exception) {
            Yii::error($exception->getMessage());
            Yii::$app->response->setStatusCode(500);

            return ['error' => 'Ошибка при удалении автора'];
        }
    }
}
