<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, [
                'required'=>true,
                'attr' => [
                    'placeholder' => 'Votre Nom',
                ],
                'constraints'=> [
                    new NotBlank([
                        'message'=>'Ce champ ne doit pas être vide',
                    ]),
                ]
            ])
            ->add('email',EmailType::class, [
                'required'=>true,
                'attr' => [
                    'placeholder' => 'Votre Email',
                ],
                'constraints'=> [
                    new NotBlank([
                        'message'=>'Ce champ ne doit pas être vide',
                    ]),
                    new Email([
                        'message'=>'L\'email n\'est pas valide'
                    ]),
                ]
            ])
            ->add('object', TextType::class, [
                'required'=>true,
                'attr' => [
                    'placeholder' => 'Sujet de votre message',
                ],
                'constraints'=> [
                    new NotBlank([
                        'message'=>'Ce champ ne doit pas être vide',
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 50,
                        'minMessage' => 'L\'objet du message doit contenir au moins 5 caractères',
                        'maxMessage' => 'L\'objet du message ne doit pas contenir plus de 50 caractères',
                    ]),
                ]
            ])
            ->add('message', TextareaType::class, [
                'required'=>true,
                'attr' => [
                    'placeholder' => 'Votre message',
                ],
                'constraints'=> [
                    new NotBlank([
                        'message'=>'Ce champ ne doit pas être vide',
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 1000,
                        'minMessage' => 'Le contenu du message doit contenir au moins 5 caractères',
                        'maxMessage' => 'L\'objet du message ne doit pas contenir plus de 1000 caractères',
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
