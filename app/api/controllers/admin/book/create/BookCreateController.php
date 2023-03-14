<?php

declare(strict_types=1);

namespace api\controllers\admin\book\create;

use domain\exception\AuthorNotFoundException;
use domain\exception\GenresNotFoundException;
use domain\exception\ValidationException;
use domain\scenario\book\create\Scenario;
use domain\scenario\book\create\Dto;
use api\controllers\admin\BaseController;
use Throwable;
use Yii;

class BookCreateController extends BaseController
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
            return $this->scenario->execute($dto);
        } catch (ValidationException $exception) {
            Yii::$app->response->setStatusCode(400);

            return ['error' => $exception->getMessage()];
        } catch (AuthorNotFoundException | GenresNotFoundException $exception) {
            Yii::$app->response->setStatusCode(404);

            return ['error' => $exception->getMessage()];
        } catch (Throwable $exception) {
            Yii::error($exception->getMessage());
            Yii::$app->response->setStatusCode(500);

            return ['error' => 'Ошибка при сохранении книги'];
        }
    }
}
