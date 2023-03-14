<?php

declare(strict_types=1);

namespace domain\scenario\author\delete;

use domain\repository\AuthorInterface as AuthorRepositoryInterface;
use domain\exception\AuthorNotFoundException;

class Scenario
{
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @throws AuthorNotFoundException
     */
    public function execute(int $authorId): void
    {
        $author = $this->authorRepository->find($authorId);

        if (!$author) {
            throw new AuthorNotFoundException($authorId);
        }

        $this->authorRepository->delete($authorId);
    }
}
