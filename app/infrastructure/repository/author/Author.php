<?php

declare(strict_types=1);

namespace infrastructure\repository\author;

use infrastructure\entity\activeRecord\Author as AuthorActiveRecord;
use domain\entity\Author as AuthorEntity;
use domain\repository\AuthorInterface;
use domain\scenario\author\create\Dto;
use RuntimeException;

class Author implements AuthorInterface
{
    private EntityConverter $entityConverter;

    public function __construct(EntityConverter $entityConverter)
    {
        $this->entityConverter = $entityConverter;
    }

    public function create(Dto $dto): int
    {
        $author = new AuthorActiveRecord();

        $author->name = $dto->getName();
        $author->country = $dto->getCountry();

        if (!$author->save()) {
            throw new RuntimeException('Ошибка при сохранении автора');
        }

        return $author->id;
    }

    public function find(int $id): ?AuthorEntity
    {
        $author = AuthorActiveRecord::findOne($id);

        return $author ? $this->entityConverter->toDomain($author) : null;
    }

    public function delete(int $id): void
    {
        AuthorActiveRecord::findOne($id)->delete();
    }

    public function update(AuthorEntity $author): void
    {
        $activeRecordAuthor = AuthorActiveRecord::findOne($author->getId());

        $activeRecordAuthor->name = $author->getName();
        $activeRecordAuthor->country = $author->getCountry();

        $activeRecordAuthor->save();
    }
}
