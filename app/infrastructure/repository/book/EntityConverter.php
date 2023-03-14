<?php

declare(strict_types=1);

namespace infrastructure\repository\book;

use infrastructure\repository\author\EntityConverter as AuthorEntityConverter;
use infrastructure\repository\genre\EntityConverter as GenreEntityConverter;
use infrastructure\entity\activeRecord\Genre as GenreActiveRecord;
use infrastructure\entity\activeRecord\Book as BookActiveRecord;
use domain\entity\Book as BookEntity;
use DateTimeImmutable;

class EntityConverter
{
    private AuthorEntityConverter $authorConverter;
    private GenreEntityConverter $genreConverter;

    public function __construct(GenreEntityConverter $genreConverter, AuthorEntityConverter $authorConverter)
    {
        $this->genreConverter = $genreConverter;
        $this->authorConverter = $authorConverter;
    }

    public function toDomain(BookActiveRecord $book): BookEntity
    {
        $genresEntity = array_map(
            fn (GenreActiveRecord $genre) => $this->genreConverter->toDomain($genre),
            $book->genres
        );

        $entity = new BookEntity();

        $entity->setId($book->id)
               ->setTitle($book->title)
               ->setGenres($genresEntity)
               ->setAuthor($this->authorConverter->toDomain($book->author))
               ->setPublicationDate(new DateTimeImmutable($book->publication_date));

        return $entity;
    }
}
