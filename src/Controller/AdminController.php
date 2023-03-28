<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\UsuarioRepository;
use App\Entity\Usuario;
use App\Form\ResgistrationEmployeeFormType;
use App\Security\AppCustomAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Repository\PaqueteRepository;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    #[Route('/empleados', name: 'app_admin_empleados', methods:['GET'])]
    public function empleados(UsuarioRepository $usuarioRepository): Response
    {
        return $this->render('admin/empleados.html.twig', [
            'usuarios' => $usuarioRepository -> findAll(),
        ]);
    }

    #[Route('/entregas', name: 'app_admin_entregas', methods: ['GET'])]
    public function entregas(PaqueteRepository $paqueteRepository): Response
    {
        return $this->render('admin/entregas.html.twig', [
            'paquetes' => $paqueteRepository->findAll(),
        ]);
    }



    #[Route('/registerEmployee', name: 'app_admin_registerEmployee')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppCustomAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $empleado = new Usuario();
        $form = $this->createForm(ResgistrationEmployeeFormType::class, $empleado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $empleado->setTipo("Empleado");
            $empleado->setEstado("A");
            // encode the plain password
            $empleado->setPassword(
                $userPasswordHasher->hashPassword(
                    $empleado,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($empleado);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $empleado,
                $authenticator,
                $request
            );
        }

        return $this->render('admin/registerEmployee.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
