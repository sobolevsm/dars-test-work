<?php

declare(strict_types=1);

namespace domain\repository;

use domain\scenario\book\read\listView\Filters;
use domain\scenario\book\read\listView\Pager;
use domain\scenario\book\create\Dto;
use domain\entity\Book;

interface BookInterface
{
    public function create(Dto $dto): int;
    public function find(int $id): ?Book;
    public function delete(int $id): void;
    public function update(Book $book): void;

    /**
     * @param Filters $filters
     * @param Pager $pager
     * @return Book[]|null
     */
    public function batchGetByFilters(Filters $filters, Pager $pager): array;
}
