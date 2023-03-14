<?php

declare(strict_types=1);

namespace infrastructure\repository\genre;

use infrastructure\entity\activeRecord\Genre as GenreActiveRecord;
use domain\entity\Genre as GenreEntity;
use domain\repository\GenreInterface;

class Genre implements GenreInterface
{
    private EntityConverter $entityConverter;

    public function __construct(EntityConverter $entityConverter)
    {
        $this->entityConverter = $entityConverter;
    }

    public function create(string $title): int
    {
        $genre = new GenreActiveRecord();
        $genre->title = $title;
        $genre->save();

        return $genre->id;
    }

    public function find(int $id): ?GenreEntity
    {
        $genre = GenreActiveRecord::findOne($id);

        return $genre ? $this->entityConverter->toDomain($genre) : null;
    }

    public function findByIds(array $ids): ?array
    {
        return array_map(
            fn (GenreActiveRecord $genre) => $this->entityConverter->toDomain($genre),
            GenreActiveRecord::findAll(['id' => $ids])
        );
    }

    public function delete(int $id): void
    {
        GenreActiveRecord::findOne($id)->delete();
    }

    public function update(GenreEntity $genre): void
    {
        $activeRecordGenre = GenreActiveRecord::findOne($genre->getId());
        $activeRecordGenre->title = $genre->getTitle();
        $activeRecordGenre->save();
    }
}
