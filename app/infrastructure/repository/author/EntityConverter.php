<?php

declare(strict_types=1);

namespace infrastructure\repository\author;

use infrastructure\entity\activeRecord\Author as ActiveRecordAuthor;
use domain\entity\Author as DomainAuthor;

class EntityConverter
{
    public function toDomain(ActiveRecordAuthor $author): DomainAuthor
    {
        return new DomainAuthor(
            $author->id,
            $author->name,
            $author->country
        );
    }
}
