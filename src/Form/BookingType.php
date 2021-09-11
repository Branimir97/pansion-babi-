<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'e.g. Ivan'
                ],
                'label' => 'form.name_label',
                'translation_domain' => 'booking'
            ])
            ->add('surname', TextType::class, [
                'attr' => [
                    'placeholder' => 'e.g. Ivić'
                ],
                'label' => 'form.surname_label',
                'translation_domain' => 'booking'
            ])
            ->add('phoneNumber', TelType::class, [
                'attr' => [
                    'placeholder' => 'e.g. +385 99 123 4567'
                ],
                'label' => 'form.phoneNumber_label',
                'translation_domain' => 'booking'
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'e.g. example@domain.com'
                ],
                'label' => 'form.email_label',
                'translation_domain' => 'booking'
            ])
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'form.startDate_label',
                'translation_domain' => 'booking'
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'form.endDate_label',
                'translation_domain' => 'booking'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
