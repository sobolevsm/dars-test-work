<?php

declare(strict_types=1);

namespace domain\repository;

use domain\scenario\author\create\Dto;
use domain\entity\Author;

interface AuthorInterface
{
    public function create(Dto $dto): int;
    public function find(int $id): ?Author;
    public function delete(int $id): void;
    public function update(Author $author);
}
