<?php

namespace App\EntityCreator;

interface EntityCreatorInterface
{
    /**
     * @param $basedOnObject
     */
    public function createBasedOn($basedOnObject): void;
}
