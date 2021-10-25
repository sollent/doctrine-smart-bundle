<?php

namespace App\DTO;

interface EntityClassInterface
{
    /**
     * @return string
     */
    public function getShortName(): string;

    /**
     * Entity namespace (FQCN)
     *
     * @return string
     */
    public function getName(): string;
}
