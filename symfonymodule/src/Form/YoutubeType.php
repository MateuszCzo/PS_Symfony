<?php

namespace SymfonyModule\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class YoutubeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', HiddenType::class, [
                'attr' => [
                    'placeholder' => 'The id_product_comment'
                ]
            ])
            ->add('productId', NumberType::class, [
                'attr' => [
                    'placeholder' => 'The product id'
                ]
            ])
            ->add('customerName', TextType::class, [
                'attr' => [
                    'placeholder' => 'The customer name'
                ]
            ])
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'The title'
                ]
            ])
            ->add('content', TextType::class, [
                'attr' => [
                    'placeholder' => 'The content'
                ]
            ])
            ->add('grade', NumberType::class, [
                'attr' => [
                    'placeholder' => 'The grade'
                ]
            ])
            ->add('save', SubmitType::class);
    }

    /*
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => YoutubeComment::class,
        ]);
    }
    */
}