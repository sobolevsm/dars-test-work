<?php

declare(strict_types=1);

namespace api\controllers\admin\genre\delete;

use domain\exception\GenreNotFoundException;
use domain\scenario\genre\delete\Scenario;
use api\controllers\admin\BaseController;
use Exception;
use Yii;

class GenreDeleteController extends BaseController
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
        } catch (GenreNotFoundException $exception) {
            Yii::$app->response->setStatusCode(404);

            return ['error' => $exception->getMessage()];
        } catch (Exception $exception) {
            Yii::error($exception->getMessage());
            Yii::$app->response->setStatusCode(500);

            return ['error' => 'Ошибка при удалении жанра'];
        }
    }
}
