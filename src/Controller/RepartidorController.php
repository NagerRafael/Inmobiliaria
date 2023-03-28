<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RepartidorController extends AbstractController
{
    #[Route('/repartidor', name: 'app_repartidor')]
    public function index(): Response
    {
        return $this->render('repartidor/index.html.twig', [
            'controller_name' => 'RepartidorController',
        ]);
    }
}
