<?php

declare(strict_types=1);

namespace api\controllers\admin\genre\update;

use api\controllers\admin\BaseController;
use domain\exception\GenreNotFoundException;
use domain\scenario\genre\update\Scenario;
use InvalidArgumentException;
use Throwable;
use Yii;

class GenreUpdateController extends BaseController
{
    private Scenario $scenario;

    public function __construct($id, $module, Scenario $scenario, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->scenario = $scenario;
    }

    public function actionIndex($id)
    {
        $title = Yii::$app->request->getBodyParam('title');

        try {
            $this->scenario->execute((int)$id, $title);
        } catch (InvalidArgumentException $exception) {
            Yii::$app->response->setStatusCode(400);

            return ['error' => $exception->getMessage()];
        } catch (GenreNotFoundException $exception) {
            Yii::$app->response->setStatusCode(404);

            return ['error' => $exception->getMessage()];
        } catch (Throwable $exception) {
            Yii::error($exception->getMessage());
            Yii::$app->response->setStatusCode(500);

            return ['error' => 'Ошибка при обновлении жанра'];
        }
    }
}
