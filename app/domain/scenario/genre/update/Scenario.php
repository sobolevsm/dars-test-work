<?php

declare(strict_types=1);

namespace domain\scenario\genre\update;

use domain\repository\GenreInterface as GenreRepositoryInterface;
use domain\exception\GenreNotFoundException;
use InvalidArgumentException;

class Scenario
{
    private GenreRepositoryInterface $genreRepository;

    public function __construct(GenreRepositoryInterface $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    /**
     * @throws GenreNotFoundException
     */
    public function execute(int $id, ?string $title): void
    {
        if (!$title) {
            throw new InvalidArgumentException('Не указан title для обновления жанра');
        }

        $genre = $this->genreRepository->find($id);

        if (!$genre) {
            throw new GenreNotFoundException($id);
        }

        $genre->setTitle($title);

        $this->genreRepository->update($genre);
    }
}
