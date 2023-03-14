<?php

declare(strict_types=1);

namespace domain\scenario\genre\delete;

use domain\repository\GenreInterface as GenreRepositoryInterface;
use domain\exception\GenreNotFoundException;

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
    public function execute(int $genreId): void
    {
        $genre = $this->genreRepository->find($genreId);

        if (!$genre) {
            throw new GenreNotFoundException($genreId);
        }

        $this->genreRepository->delete($genreId);
    }
}
