<?php

namespace sollent\DoctrineSmartBundle\Repository;

use sollent\DoctrineSmartBundle\DTO\EntityClassInterface;

interface EntityClassRepositoryInterface
{
    /**
     * @return EntityClassInterface[]
     */
    public function findAll(): array;
}
