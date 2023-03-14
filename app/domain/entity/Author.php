<?php

declare(strict_types=1);

namespace domain\entity;

class Author
{
    private int $id;
    private string $name;
    private string $country;

    public function __construct(int $id, string $name, string $country)
    {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }
}
