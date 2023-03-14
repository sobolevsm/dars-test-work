<?php

declare(strict_types=1);

namespace domain\exception;

use yii\base\Model;
use Exception;

class ValidationException extends Exception
{
    public function __construct(Model $model)
    {
        parent::__construct(current($model->firstErrors));
    }
}
