<?php

declare(strict_types=1);

namespace domain\scenario\author\update;

use domain\repository\AuthorInterface as AuthorRepositoryInterface;
use domain\exception\AuthorNotFoundException;
use InvalidArgumentException;

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
    public function execute(int $id, ?string $name, ?string $country): void
    {
        $author = $this->authorRepository->find($id);

        if (!$author) {
            throw new AuthorNotFoundException($id);
        }

        if (!$name && !$country) {
            throw new InvalidArgumentException(
                'Должен быть указан по крайней мере один параметр для обновления автора'
            );
        }

        if ($name) {
            $author->setName($name);
        }

        if ($country) {
            $author->setCountry($country);
        }

        $this->authorRepository->update($author);
    }
}
