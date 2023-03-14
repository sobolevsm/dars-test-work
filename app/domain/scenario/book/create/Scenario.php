<?php

declare(strict_types=1);

namespace domain\scenario\book\create;

use domain\repository\AuthorInterface as AuthorInterfaceRepository;
use domain\repository\BookInterface as BookInterfaceRepository;
use domain\repository\GenreInterface as GenreInterfaceRepository;
use domain\exception\GenresNotFoundException;
use domain\exception\AuthorNotFoundException;
use domain\exception\ValidationException;
use domain\entity\Genre;

class Scenario
{
    private AuthorInterfaceRepository $authorRepository;
    private GenreInterfaceRepository $genreRepository;
    private BookInterfaceRepository $bookRepository;

    public function __construct(
        AuthorInterfaceRepository $authorRepository,
        GenreInterfaceRepository $genreRepository,
        BookInterfaceRepository $bookRepository
    ) {
        $this->authorRepository = $authorRepository;
        $this->genreRepository = $genreRepository;
        $this->bookRepository = $bookRepository;
    }

    /**
     * @throws ValidationException
     * @throws AuthorNotFoundException
     * @throws GenresNotFoundException
     */
    public function execute(Dto $dto): int
    {
        $this->checkDtoValidation($dto);
        $this->checkAuthorExistance($dto->authorId);
        $this->checkGenresExistance($dto->genresId);

        return $this->bookRepository->create($dto);
    }

    /**
     * @throws ValidationException
     */
    private function checkDtoValidation(Dto $dto): void
    {
        if (!$dto->validate()) {
            throw new ValidationException($dto);
        }
    }

    /**
     * @throws AuthorNotFoundException
     */
    private function checkAuthorExistance(int $authorId): void
    {
        if (!$this->authorRepository->find($authorId)) {
            throw new AuthorNotFoundException($authorId);
        }
    }

    /**
     * @throws GenresNotFoundException
     */
    private function checkGenresExistance(array $genresId): void
    {
        $existingGenres = $this->getExistingGenres($genresId);

        $existingGenresIds = array_map(
            static fn (Genre $genre) => $genre->getId(),
            $existingGenres
        );

        if ($notExistingIds = array_diff($genresId, $existingGenresIds)) {
            $notExistingIdsString = implode(',', $notExistingIds);

            throw new GenresNotFoundException($notExistingIdsString);
        }
    }

    private function getExistingGenres(array $genresId): ?array
    {
        return $this->genreRepository->findByIds($genresId);
    }
}
