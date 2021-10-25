<?php

namespace App\Form;

use App\DTO\Entity\EntityDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntityForm extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Entity name',
                'required' => true
            ])
            ->add('properties', CollectionType::class, [
                'label' => false,
                'entry_type' => EntityPropertyForm::class,
                'allow_add' => true,
            ])
            ->add('button', SubmitType::class, [
                'label' => 'Save entity',
                'attr' => [
                    'class' => 'btn btn-primary btn-lg',
                    'style' => 'width: 100%'
                ]
            ]);
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EntityDTO::class
        ]);
    }
}
