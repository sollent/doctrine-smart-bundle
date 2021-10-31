<?php

namespace sollent\DoctrineSmartBundle\EntityCreator;

interface EntityCreatorInterface
{
    /**
     * @param $basedOnObject
     * @param string|null $namespace
     * @param string|null $externalSavePath
     */
    public function createBasedOn($basedOnObject, string $namespace = null, string $externalSavePath = null): void;
}
