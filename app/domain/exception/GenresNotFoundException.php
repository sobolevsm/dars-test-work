<?php

declare(strict_types=1);

namespace domain\exception;

use Exception;

class GenresNotFoundException extends Exception
{
    public function __construct(string $genresId)
    {
        parent::__construct("Не были найдены жанры со следующими id: $genresId");
    }
}
