<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AsesorController extends AbstractController
{
    #[Route('/asesor', name: 'app_asesor')]
    public function index(): Response
    {
        return $this->render('asesor/index.html.twig', [
            'controller_name' => 'AsesorController',
        ]);
    }
}
