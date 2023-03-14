<?php

declare(strict_types=1);

namespace domain\scenario\genre\create;

use domain\repository\GenreInterface as GenreRepositoryInterface;
use InvalidArgumentException;

class Scenario
{
    private GenreRepositoryInterface $genreRepository;

    public function __construct(GenreRepositoryInterface $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function execute(?string $title): int
    {
        if (!$title) {
            throw new InvalidArgumentException('Не передан обязательный параметр title');
        }

        return $this->genreRepository->create($title);
    }
}
