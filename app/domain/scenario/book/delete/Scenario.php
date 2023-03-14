<?php

declare(strict_types=1);

namespace domain\scenario\book\delete;

use domain\repository\BookInterface as BookRepositoryInterface;
use domain\exception\BookNotFoundException;

class Scenario
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @throws BookNotFoundException
     */
    public function execute(int $bookId): void
    {
        $book = $this->bookRepository->find($bookId);

        if (!$book) {
            throw new BookNotFoundException($bookId);
        }

        $this->bookRepository->delete($bookId);
    }
}
