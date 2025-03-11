<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Release;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReleaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('releasedAt', null, [
                'widget' => 'single_text'
            ])
            ->add('title')
            ->add('thumbnailUrl')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Album' => Release::TYPE_ALBUM,
                    'Single' => Release::TYPE_SINGLE,
                    'EP' => Release::TYPE_EP,
                ],
            ])
            ->add('artist', EntityType::class, [
                'class' => Artist::class,
'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Release::class,
        ]);
    }
}
