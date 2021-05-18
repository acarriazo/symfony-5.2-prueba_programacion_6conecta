<?php

namespace App\Form;

use App\Entity\Conciertos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConciertosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id_promotor')
            ->add('id_recinto')
            ->add('nombre')
            ->add('numero_espectadores')
            ->add('fecha')
            ->add('rentabilidad')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Conciertos::class,
        ]);
    }
}
