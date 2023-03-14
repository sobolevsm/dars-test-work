<?php

declare(strict_types=1);

namespace api\controllers\book;

use domain\entity\Genre;
use domain\entity\Book;
use JsonSerializable;

class Response implements JsonSerializable
{
    private array $books;

    private const PUBLICATION_DATE_FORMAT = 'Y-m-d';

    public function __construct(array $books)
    {
        $this->books = $books;
    }

    public function jsonSerialize()
    {
        return array_map(
            function (Book $book) {
                return [
                    'title' => $book->getTitle(),
                    'author' => $book->getAuthor()->getName(),
                    'genres' => $this->extractGenresId($book->getGenres()),
                    'publicationDate' => $book->getPublicationDate()->format(self::PUBLICATION_DATE_FORMAT),
                ];
            },
            $this->books
        );
    }

    private function extractGenresId(array $genres): array
    {
        return array_map(
            static fn (Genre $genre) => $genre->getId(),
            $genres
        );
    }
}
