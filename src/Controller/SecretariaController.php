<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/secretaria'), IsGranted('ROLE_SECRETARIA')]
class SecretariaController extends AbstractController
{

    #[Route('/', name: 'app_secretaria')]
    public function index(): Response
    {
        return $this->render('secretaria/index.html.twig', [
            'controller_name' => 'SecretariaController',
        ]);
    }
}
