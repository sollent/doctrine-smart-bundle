<?php

namespace sollent\DoctrineSmartBundle\EntityCreator;

interface EntityCreatorInterface
{
    /**
     * @param $basedOnObject
     */
    public function createBasedOn($basedOnObject): void;
}
