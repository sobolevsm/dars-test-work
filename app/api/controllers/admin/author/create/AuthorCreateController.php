<?php

declare(strict_types=1);

namespace api\controllers\admin\author\create;

use domain\exception\ValidationException;
use domain\scenario\author\create\Scenario;
use domain\scenario\author\create\Dto;
use api\controllers\admin\BaseController;
use Throwable;
use Yii;

class AuthorCreateController extends BaseController
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

        $dto = new Dto();
        $dto->load($request->getBodyParams(), '');

        try {
            Yii::$app->response->setStatusCode(201);

            return $this->scenario->execute($dto);
        } catch (ValidationException $exception) {
            Yii::$app->response->setStatusCode(400);

            return ['error' => $exception->getMessage()];
        } catch (Throwable $exception) {
            Yii::error($exception->getMessage());
            Yii::$app->response->setStatusCode(500);

            return ['error' => 'Ошибка при сохранении автора'];
        }
    }
}
