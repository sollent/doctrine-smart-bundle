<?php

namespace App\EntityCreator;

use App\DTO\Entity\EntityDTO;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Parameter;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Symfony\Component\Filesystem\Filesystem;

class DoctrineEntityCreator implements EntityCreatorInterface
{
    /**
     * {@inheritDoc}
     *
     * @throws \Exception
     */
    public function createBasedOn($basedOnObject): void
    {
        if ($basedOnObject instanceof EntityDTO) {
            $this->createWithEntityDTO($basedOnObject);

            return;
        }

        throw new \Exception(
            \sprintf(
                'There are not class for handling entity creation. May be you need to use %s as based on object',
                EntityDTO::class
            )
        );
    }

    /**
     * @param EntityDTO $entityDTO
     */
    private function createWithEntityDTO(EntityDTO $entityDTO): void
    {
        $rootNamespace = new PhpNamespace('App\\Entity');
        $rootNamespace
            ->addUse('Doctrine\ORM\Mapping', 'ORM');

        $entityClass = new ClassType($entityDTO->name);
        $entityClass->addComment('@ORM\Entity');
        $this->generateDoctrineDefaultId($entityClass);

        foreach ($entityDTO->properties as $propertyDTO) {
            // build property
            if ($propertyDTO->defaultValue) {
                $property = $entityClass->addProperty($propertyDTO->name, $propertyDTO->defaultValue);
            } elseif ($propertyDTO->nullable) {
                $property = $entityClass->addProperty($propertyDTO->name, null);
            } else {
                $property = $entityClass->addProperty($propertyDTO->name);
            }
            $property
                ->setPrivate()
                ->setNullable($propertyDTO->nullable)
                ->addComment(
                    \sprintf(
                        '@ORM\Column(type="%s", nullable=%s)',
                        $propertyDTO->type, $propertyDTO->nullable ? 'true' : 'false'
                    )
                );
            // build getter
            $entityClass->addMethod(\sprintf('get%s', \ucfirst($propertyDTO->name)))
                ->setPublic()
                ->setBody(\sprintf('return $this->%s;', $propertyDTO->name));
            // build setter
            $entityClass->addMethod(\sprintf('set%s', \ucfirst($propertyDTO->name)))
                ->setPublic()
                ->setReturnType('self')
                ->setParameters([new Parameter($propertyDTO->name)])
                ->addBody(\sprintf('$this->%s = $%s;', $propertyDTO->name, $propertyDTO->name))
                ->addBody('return $this;');
        }

        $rootNamespace->add($entityClass);

        $filesystem = new Filesystem();
        $pathArr = \explode('/', \getcwd());
        \array_pop($pathArr);
        $pathArr = \implode('/', $pathArr);
        $phpFile = new PhpFile();
        $phpFile
            ->setStrictTypes()
            ->addNamespace($rootNamespace);

        $filesystem->dumpFile(\sprintf($pathArr . '/src/Entity/%s.php', $entityClass->getName()), (string) $phpFile);
    }

    /**
     * @param ClassType $entityClass
     */
    private function generateDoctrineDefaultId(ClassType &$entityClass): void
    {
        $entityClass->addProperty('id')
            ->setPrivate()
            ->setType('int')
            ->addComment('@ORM\Id')
            ->addComment('@ORM\GeneratedValue(strategy="AUTO")')
            ->addComment('@ORM\Column(type="integer", unique=true)');

        $entityClass->addMethod('getId')
            ->setPublic()
            ->setReturnType('int')
            ->setBody('return $this->id;');
        $entityClass->addMethod('setId')
            ->setPublic()
            ->setParameters([new Parameter('id')])
            ->setReturnType('self')
            ->addBody('$this->id = $id;')
            ->addBody('return $this;');
    }
}
