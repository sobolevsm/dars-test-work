<?php

declare(strict_types=1);

namespace domain\exception;

use Exception;

class AuthorNotFoundException extends Exception
{
    public function __construct(int $authorId)
    {
        parent::__construct("Автор с идентификатором $authorId не найден.");
    }
}
