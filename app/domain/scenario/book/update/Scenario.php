<?php

declare(strict_types=1);

namespace domain\scenario\book\update;

use domain\repository\AuthorInterface as AuthorRepositoryInterface;
use domain\repository\GenreInterface as GenreRepositoryInterface;
use domain\repository\BookInterface as BookRepositoryInterface;
use domain\exception\GenresNotFoundException;
use domain\exception\AuthorNotFoundException;
use domain\exception\BookNotFoundException;
use domain\exception\ValidationException;
use domain\entity\Book;
use domain\entity\Genre;
use InvalidArgumentException;
use DateTimeImmutable;

class Scenario
{
    private AuthorRepositoryInterface $authorRepository;
    private GenreRepositoryInterface $genreRepository;
    private BookRepositoryInterface $bookRepository;

    public function __construct(
        AuthorRepositoryInterface $authorRepository,
        GenreRepositoryInterface $genreRepository,
        BookRepositoryInterface $bookRepository
    ) {
        $this->authorRepository = $authorRepository;
        $this->genreRepository = $genreRepository;
        $this->bookRepository = $bookRepository;
    }

    /**
     * @throws GenresNotFoundException
     * @throws AuthorNotFoundException
     * @throws BookNotFoundException
     * @throws ValidationException
     */
    public function execute(int $id, Dto $dto): void
    {
        $this->checkDtoValidation($dto);
        $this->checkUpdateParamsExistance($dto);

        $book = $this->bookRepository->find($id);

        if (!$book) {
            throw new BookNotFoundException($id);
        }

        $this->updateEntity($book, $dto);
        $this->bookRepository->update($book);
    }

    private function checkDtoValidation(Dto $dto): void
    {
        if (!$dto->validate()) {
            throw new ValidationException($dto);
        }
    }

    private function checkUpdateParamsExistance(Dto $dto): void
    {
        if (!$dto->title && !$dto->genresId && !$dto->authorId && !$dto->publishedDate) {
            throw new InvalidArgumentException(
                'Должен быть указан по крайней мере один параметр для обновления книги'
            );
        }
    }

    private function updateEntity(Book $book, Dto $dto): void
    {
        if ($title = $dto->title ?? null) {
            $book->setTitle($title);
        }

        if ($genresId = $dto->genresId) {
            $this->updateGenres($book, $genresId);
        }

        if ($authorId = $dto->authorId) {
            $this->updateAuthor($book, $authorId);
        }

        if ($publishedDate = $dto->publishedDate) {
            $book->setPublicationDate(new DateTimeImmutable($publishedDate));
        }
    }

    private function updateGenres(Book $book, array $genreIds): void
    {
        $existingGenres = $this->genreRepository->findByIds($genreIds);
        $existingGenreIds = $this->getExistingGenreIds($existingGenres);

        $this->checkExistanceOfGenreIds($genreIds, $existingGenreIds);

        $book->setGenres($existingGenres);
    }

    private function getExistingGenreIds(array $existingGenres): array
    {
        return array_map(
            static fn (Genre $genre) => $genre->getId(),
            $existingGenres
        );
    }

    private function checkExistanceOfGenreIds(array $newGenreIds, array $existingGenreIds): void
    {
        if ($notExistingIds = array_diff($newGenreIds, $existingGenreIds)) {
            $notExistingIdsString = implode(',', $notExistingIds);

            throw new GenresNotFoundException($notExistingIdsString);
        }
    }

    private function updateAuthor(Book $book, int $authorId): void
    {
        $author = $this->authorRepository->find($authorId);

        if (!$author) {
            throw new AuthorNotFoundException($authorId);
        }

        $book->setAuthor($author);
    }
}
