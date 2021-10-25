<?php

namespace App\DTO\Entity;

class EntityPropertyDTO
{
    public string $name;

    public string $type;

    public bool $nullable = false;

    public ?string $defaultValue = null;

    public bool $relation = false;

    public string $relationType;

    public string $targetEntityNamespace;
}
