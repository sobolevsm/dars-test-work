<?php

declare(strict_types=1);

namespace api\controllers\admin\author\update;

use domain\exception\AuthorNotFoundException;
use domain\scenario\author\update\Scenario;
use api\controllers\admin\BaseController;
use InvalidArgumentException;
use Throwable;
use Yii;

class AuthorUpdateController extends BaseController
{
    private Scenario $scenario;

    public function __construct($id, $module, Scenario $scenario, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->scenario = $scenario;
    }

    public function actionIndex($id)
    {
        $name = Yii::$app->request->getBodyParam('name');
        $country = Yii::$app->request->getBodyParam('country');

        try {
            $this->scenario->execute((int)$id, $name, $country);
        } catch (InvalidArgumentException $exception) {
            Yii::$app->response->setStatusCode(400);

            return ['error' => $exception->getMessage()];
        } catch (AuthorNotFoundException $exception) {
            Yii::$app->response->setStatusCode(404);

            return ['error' => $exception->getMessage()];
        } catch (Throwable $exception) {
            Yii::error($exception->getMessage());
            Yii::$app->response->setStatusCode(500);

            return ['error' => 'Ошибка при обновлении автора'];
        }
    }
}
