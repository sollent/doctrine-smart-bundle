<?php

namespace App\Repository;

use App\DTO\EntityClassInterface;

interface EntityClassRepositoryInterface
{
    /**
     * @return EntityClassInterface[]
     */
    public function findAll(): array;
}
