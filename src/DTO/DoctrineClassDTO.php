<?php

namespace App\DTO;

use Doctrine\ORM\Mapping\ClassMetadata;

class DoctrineClassDTO implements EntityClassInterface
{
    private string $name;

    private string $shortName;

    private ?string $relationCount = null;

    private string $propertiesCount;

    /**
     * @param ClassMetadata $classMetadata
     *
     * @return static
     *
     * @throws \ReflectionException
     */
    public static function createFromClassMetadata(ClassMetadata $classMetadata): self
    {
        $reflectionClass = new \ReflectionClass($classMetadata->getName());

        $self = new static();
        $self
            ->setName($classMetadata->getName())
            ->setShortName($reflectionClass->getShortName())
            ->setPropertiesCount(\count($reflectionClass->getProperties()));

        return $self;
    }

    /**
     * @return string|null
     */
    public function getRelationCount(): ?string
    {
        return $this->relationCount;
    }

    /**
     * @param string|null $relationCount
     * @return DoctrineClassDTO
     */
    public function setRelationCount(?string $relationCount): DoctrineClassDTO
    {
        $this->relationCount = $relationCount;
        return $this;
    }

    /**
     * @param string $name
     * @return DoctrineClassDTO
     */
    public function setName(string $name): DoctrineClassDTO
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $shortName
     * @return DoctrineClassDTO
     */
    public function setShortName(string $shortName): DoctrineClassDTO
    {
        $this->shortName = $shortName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPropertiesCount(): string
    {
        return $this->propertiesCount;
    }

    /**
     * @param string $propertiesCount
     * @return DoctrineClassDTO
     */
    public function setPropertiesCount(string $propertiesCount): DoctrineClassDTO
    {
        $this->propertiesCount = $propertiesCount;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return $this->name;
    }
}
