<?php

namespace sollent\DoctrineSmartBundle\Form;

use sollent\DoctrineSmartBundle\DTO\Entity\EntityPropertyDTO;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntityPropertyForm extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Property name',
                'required' => true
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Property type',
                'choice_loader' => new CallbackChoiceLoader(function () {
                    $reflectionClass = new \ReflectionClass(Types::class);
                    return $reflectionClass->getConstants();
                })
            ])
            ->add('nullable', CheckboxType::class, [
                'label' => 'Is it nullable?',
                'required' => false
            ]);
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EntityPropertyDTO::class
        ]);
    }
}
