<?php

declare(strict_types=1);

namespace domain\scenario\book\read\listView;

use domain\repository\BookInterface as BookRepositoryInterface;
use domain\exception\ValidationException;
use domain\entity\Book;

class Scenario
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @return Book[]
     * @throws ValidationException
     */
    public function execute(Filters $filters, Pager $pager): array
    {
        $this->validateFilters($filters);
        $this->validatePager($pager);

        return $this->bookRepository->batchGetByFilters($filters, $pager);
    }

    /**
     * @throws ValidationException
     */
    private function validateFilters(Filters $filters): void
    {
        if (!$filters->validate()) {
            throw new ValidationException($filters);
        }
    }

    /**
     * @throws ValidationException
     */
    private function validatePager(Pager $pager): void
    {
        if (!$pager->validate()) {
            throw new ValidationException($pager);
        }
    }
}
