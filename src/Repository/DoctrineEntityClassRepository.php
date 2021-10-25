<?php

namespace App\Repository;

use App\DTO\DoctrineClassDTO;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class DoctrineEntityClassRepository implements EntityClassRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return DoctrineClassDTO[]
     *
     * @throws \ReflectionException
     */
    public function findAll(): array
    {
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();

        return \array_map(function (ClassMetadata $classMetadata) {
            return DoctrineClassDTO::createFromClassMetadata($classMetadata);
        }, $metadata);
    }
}
