<?php

namespace sollent\DoctrineSmartBundle\DTO\Entity;

class EntityDTO
{
    public string $name;

    /**
     * @var EntityPropertyDTO[]
     */
    public array $properties;
}
