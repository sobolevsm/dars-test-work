<?php

declare(strict_types=1);

namespace domain\entity;

use DateTimeImmutable;

class Book
{
    private ?int $id;
    private string $title;

    /**
     * @var Genre[]
     */
    private array $genres;

    private Author $author;
    private DateTimeImmutable $publicationDate;

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param Genre[] $genres
     */
    public function setGenres(array $genres): self
    {
        $this->genres = $genres;

        return $this;
    }

    /**
     * @return Genre[]
     */
    public function getGenres(): array
    {
        return $this->genres;
    }

    public function setAuthor(Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setPublicationDate(DateTimeImmutable $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getPublicationDate(): DateTimeImmutable
    {
        return $this->publicationDate;
    }
}
