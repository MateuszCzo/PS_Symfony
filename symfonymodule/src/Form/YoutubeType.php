<?php

namespace SymfonyModule\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use SymfonyModule\Entity\YoutubeComment;

class YoutubeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productId', NumberType::class, [
                'attr' => [
                    'placeholder' => 'The product id'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter product id',
                    ]),
                    new Type([
                        'type' => 'int'
                    ])
                ],
            ])
            ->add('customerName', TextType::class, [
                'attr' => [
                    'placeholder' => 'The customer name'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter customer name',
                    ]),
                    new Type([
                        'type' => 'string'
                    ]),
                    new Length([
                        'max' => 64,
                        'maxMessage' => "Customer name cannot be longer than {{ limit }} characters"
                    ])
                ],
            ])
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'The title'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Type([
                        'type' => 'string'
                    ]),
                    new Length([
                        'max' => 64,
                        'maxMessage' => "Title cannot be longer than {{ limit }} characters"
                    ])
                ],
            ])
            ->add('content', TextType::class, [
                'attr' => [
                    'placeholder' => 'The content'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Type([
                        'type' => 'string'
                    ]),
                ],
            ])
            ->add('grade', NumberType::class, [
                'attr' => [
                    'placeholder' => 'The grade'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Type([
                        'type' => 'int'
                    ]),
                ],
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => YoutubeComment::class,
        ]);
    }
}
