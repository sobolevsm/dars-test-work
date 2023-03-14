<?php

declare(strict_types=1);

namespace api\controllers\admin\book\update;

use domain\exception\GenresNotFoundException;
use domain\exception\AuthorNotFoundException;
use domain\exception\BookNotFoundException;
use domain\exception\ValidationException;
use domain\scenario\book\update\Scenario;
use domain\scenario\book\update\Dto;
use api\controllers\admin\BaseController;
use InvalidArgumentException;
use Throwable;
use Yii;

class BookUpdateController extends BaseController
{
    private Scenario $scenario;

    public function __construct($id, $module, Scenario $scenario, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->scenario = $scenario;
    }

    public function actionIndex($id)
    {
        $request = Yii::$app->getRequest();

        $dto = new Dto();
        $dto->load($request->getBodyParams(), '');

        try {
            $this->scenario->execute((int)$id, $dto);
        } catch (ValidationException | InvalidArgumentException $exception) {
            Yii::$app->response->setStatusCode(400);

            return ['error' => $exception->getMessage()];
        } catch (BookNotFoundException | AuthorNotFoundException | GenresNotFoundException $exception) {
            Yii::$app->response->setStatusCode(404);

            return ['error' => $exception->getMessage()];
        } catch (Throwable $exception) {
            Yii::error($exception->getMessage());
            Yii::$app->response->setStatusCode(500);

            return ['error' => 'Произошла ошибка при обновлении книги'];
        }
    }
}
