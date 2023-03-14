<?php

declare(strict_types=1);

namespace domain\scenario\author\create;

use domain\repository\AuthorInterface as AuthorRepositoryInterface;
use domain\exception\ValidationException;

class Scenario
{
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @throws ValidationException
     */
    public function execute(Dto $dto): int
    {
        if (!$dto->validate()) {
            throw new ValidationException($dto);
        }

        return $this->authorRepository->create($dto);
    }
}
