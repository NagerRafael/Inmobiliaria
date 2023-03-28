<?php

namespace App\Form;

use App\Entity\Peticion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Edificio;
use App\Repository\EdificioRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class PeticionType extends AbstractType
{

    private $edificioRepository;
    private $tokenStorage;

    public function __construct(EdificioRepository $edificioRepository, TokenStorageInterface $tokenStorage)
    {
        $this->edificioRepository = $edificioRepository;
        $this->tokenStorage = $tokenStorage;
    }


    private function getEdificiosIdChoices()
    {
        $edificios = $this->edificioRepository->findAll();

        $choices = [];

        foreach ($edificios as $edificio) {
            $choices[$edificio->getIdEdificio()] = $edificio->getDescripcion();
        }

        return $choices;
    }

    private function getEdificioChoices()
    {
        $edificios = $this->edificioRepository->findAll();

        $choices = [];

        foreach ($edificios as $edificio) {
            $choices[$edificio->getDescripcion()] = $edificio->getIdEdificio();
        }

        return $choices;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->tokenStorage->getToken()->getUser();

        $builder
            ->add('idUsuario', TextType::class, [
                'data' => $user->getNombre().' '.$user->getApellido(),
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('idEdificio', ChoiceType::class, [
                'choices' => $this->getEdificioChoices(),
                'placeholder' => 'Seleccionar un edificio',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            /*->add('condicion', TextType::class, [
                'label' => 'Tipo',
                'required' => false,
                'constraints' => [
                    new Length(['max' => 255]),
                ],
            ])*/
        ;
        $builder->get('idEdificio')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $edificioId = $event->getData();
                $edificio = $this->edificioRepository->find($edificioId);
                if ($edificio) {
                    $condicion = $edificio->getCondicion();
                    $form->getParent()->get('condicion')->setData($condicion);
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Peticion::class,
        ]);
    }
}
