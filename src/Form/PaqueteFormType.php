<?php

namespace App\Form;

use App\Entity\Paquete;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaqueteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('peso')
            ->add('destino')
            ->add('emisor')
            ->add('receptor')
            ->add('tipo')
            ->add('condicion')
            ->add('estado')
            ->add('idRuta')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paquete::class,
        ]);
    }
}
