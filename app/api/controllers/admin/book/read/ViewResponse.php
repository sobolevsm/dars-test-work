<?php

declare(strict_types=1);

namespace api\controllers\admin\book\read;

use infrastructure\entity\activeRecord\Book;
use infrastructure\entity\activeRecord\Genre;
use JsonSerializable;

class ViewResponse implements JsonSerializable
{
    private Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->book->id ,
            'title' => $this->book->title,
            'author_id' => $this->book->author_id,
            'publication_date' => $this->book->publication_date,
            'genresId' => $this->extractGenresId($this->book->genres)
        ];
    }

    /**
     * @param Genre[] $genres
     * @return array
     */
    private function extractGenresId(array $genres): array
    {
        return array_map(
            static function (Genre $genre) {
                return $genre->id;
            },
            $genres
        );
    }
}
