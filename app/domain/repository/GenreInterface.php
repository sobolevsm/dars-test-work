<?php

declare(strict_types=1);

namespace domain\repository;

use domain\entity\Genre;

interface GenreInterface
{
    public function create(string $title): int;
    public function find(int $id): ?Genre;

    /**
     * @return Genre[]|null
     */
    public function findByIds(array $ids): ?array;
    public function delete(int $id): void;
    public function update(Genre $genre): void;
}
