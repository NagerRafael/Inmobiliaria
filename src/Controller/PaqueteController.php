<?php

namespace App\Controller;

use App\Entity\Paquete;
use App\Form\PaqueteType;
use App\Repository\PaqueteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/paquete')]
class PaqueteController extends AbstractController
{
    #[Route('/', name: 'app_paquete_index', methods: ['GET'])]
    public function index(PaqueteRepository $paqueteRepository): Response
    {
        return $this->render('paquete/index.html.twig', [
            'paquetes' => $paqueteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_paquete_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PaqueteRepository $paqueteRepository): Response
    {
        $paquete = new Paquete();
        $form = $this->createForm(PaqueteType::class, $paquete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paqueteRepository->save($paquete, true);

            return $this->redirectToRoute('app_paquete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('paquete/new.html.twig', [
            'paquete' => $paquete,
            'form' => $form,
        ]);
    }

    #[Route('/{idPaquete}', name: 'app_paquete_show', methods: ['GET'])]
    public function show(Paquete $paquete): Response
    {
        return $this->render('paquete/show.html.twig', [
            'paquete' => $paquete,
        ]);
    }

    #[Route('/{idPaquete}/edit', name: 'app_paquete_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Paquete $paquete, PaqueteRepository $paqueteRepository): Response
    {
        $form = $this->createForm(PaqueteType::class, $paquete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paqueteRepository->save($paquete, true);

            return $this->redirectToRoute('app_paquete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('paquete/edit.html.twig', [
            'paquete' => $paquete,
            'form' => $form,
        ]);
    }

    #[Route('/{idPaquete}', name: 'app_paquete_delete', methods: ['POST'])]
    public function delete(Request $request, Paquete $paquete, PaqueteRepository $paqueteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paquete->getIdPaquete(), $request->request->get('_token'))) {
            $paqueteRepository->remove($paquete, true);
        }

        return $this->redirectToRoute('app_paquete_index', [], Response::HTTP_SEE_OTHER);
    }
}
