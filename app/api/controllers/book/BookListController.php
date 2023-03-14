<?php

declare(strict_types=1);

namespace api\controllers\book;

use domain\scenario\book\read\listView\Scenario;
use domain\scenario\book\read\listView\Filters;
use domain\scenario\book\read\listView\Pager;
use domain\exception\ValidationException;
use yii\rest\Controller;
use Exception;
use Yii;

class BookListController extends Controller
{
    private Scenario $scenario;

    public function __construct($id, $module, Scenario $scenario, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->scenario = $scenario;
    }

    public function actionIndex()
    {
        $request = Yii::$app->request;

        $filters = new Filters();
        $pager = new Pager();

        $filters->load($request->getBodyParam('filters'), '');
        $pager->load($request->getBodyParam('pager'), '');

        try {
            $books = $this->scenario->execute($filters, $pager);

            return new Response($books);
        } catch (ValidationException $exception) {
            Yii::$app->response->setStatusCode(400);

            return ['error' => $exception->getMessage()];
        } catch (Exception $exception) {
            Yii::error($exception->getMessage());
            Yii::$app->response->setStatusCode(500);

            return ['error' => 'Ошибка при получении списка книг'];
        }
    }
}
