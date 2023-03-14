<?php

declare(strict_types=1);

namespace infrastructure\repository\genre;

use infrastructure\entity\activeRecord\Genre as ActiveRecordGenre;
use domain\entity\Genre as GenreDomainEntity;

class EntityConverter
{
    public function toDomain(ActiveRecordGenre $genre): GenreDomainEntity
    {
        return new GenreDomainEntity(
            $genre->id,
            $genre->title
        );
    }
}
