<?php

namespace App\Form;

use App\Entity\Edificio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class EdificioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descripcion', TextType::class,[
                'label'=> 'Descripción',
                    'attr' => [
                        'placeholder' => 'Descripcion del inmueble',
                        'class' => 'form-control form-control-lg',
                        'required' => true                    
                    ]
            ])
            ->add('condicion', ChoiceType::class, [
                'label' => 'Tipo',
                'required' => true,
                'multiple' => false,
                'placeholder' => ' ',
                'choices' => [
                    'Venta' => 'VENTA',
                    'Alquiler' => 'ALQUILER',
                ],
                'attr' => [
                    'class' => 'form-control form-control-sm',
                    'required' => true                    
                ]
            ])
            ->add('costo', MoneyType::class, [
                'currency' => 'USD',
                'attr' => [
                    'placeholder' => 'exp: 100000',
                    'class' => 'form-control form-control-sm',
                    'required' => true                    
                ]
            ])
            ->add('idAsesor')
            ->add('submit', SubmitType::class,[
                'label'=>'Guardar',
                'attr'=>[
                    'class'=>'btn btn-block btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Edificio::class,
        ]);
    }
}
