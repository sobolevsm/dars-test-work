<?php

declare(strict_types=1);

namespace api\controllers\admin\genre\create;

use api\controllers\admin\BaseController;
use domain\scenario\genre\create\Scenario;
use InvalidArgumentException;
use Throwable;
use Yii;

class GenreCreateController extends BaseController
{
    private Scenario $scenario;

    public function __construct($id, $module, Scenario $scenario, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->scenario = $scenario;
    }

    public function actionIndex()
    {
        $request = Yii::$app->getRequest();

        $title = $request->getBodyParam('title');

        try {
            Yii::$app->response->setStatusCode(201);

            return $this->scenario->execute($title);
        } catch (InvalidArgumentException $exception) {
            Yii::$app->response->setStatusCode(400);

            return ['error' => $exception->getMessage()];
        } catch (Throwable $exception) {
            Yii::error($exception->getMessage());
            Yii::$app->response->setStatusCode(500);

            return ['error' => 'Ошибка при сохранении жанра'];
        }
    }
}
