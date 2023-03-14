<?php

declare(strict_types=1);

namespace domain\exception;

use Exception;

class GenreNotFoundException extends Exception
{
    public function __construct(int $genreId)
    {
        parent::__construct("Жанр с идентификатором $genreId не найден.");
    }
}
