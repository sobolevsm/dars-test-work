<?php

declare(strict_types=1);

namespace api\behaviors;

use infrastructure\entity\activeRecord\AccessToken;
use yii\web\UnauthorizedHttpException;
use yii\base\ActionFilter;
use Yii;

class AccessTokenAuthBehavior extends ActionFilter
{
    /**
     * @throws UnauthorizedHttpException
     */
    public function beforeAction($action)
    {
        $accessToken = Yii::$app->request->getHeaders()->get('X-Access-Token');

        if (!$accessToken) {
            throw new UnauthorizedHttpException('Не передан токен авторизации');
        }

        $isValidAccessToken = AccessToken::find()->where(['token' => $accessToken])->exists();

        /*
         * Для упрощения работы с авторизацией, считаем что если переданный токен есть в таблице,
         * то совершающий запрос является админом.
         */
        if (!$isValidAccessToken) {
            throw new UnauthorizedHttpException('Недостаточно прав для выполнения действия');
        }

        return true;
    }
}
