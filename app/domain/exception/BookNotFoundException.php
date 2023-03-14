<?php

declare(strict_types=1);

namespace domain\exception;

use Exception;

class BookNotFoundException extends Exception
{
    public function __construct(int $bookId)
    {
        parent::__construct("Книга с id $bookId не найдена");
    }
}
