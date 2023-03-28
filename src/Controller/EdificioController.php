<?php

namespace App\Controller;

use App\Entity\Edificio;
use App\Form\EdificioType;
use App\Repository\EdificioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/edificio')]
class EdificioController extends AbstractController
{
    #[Route('/', name: 'app_edificio_index', methods: ['GET'])]
    public function index(EdificioRepository $edificioRepository): Response
    {
        return $this->render('edificio/index.html.twig', [
            'edificios' => $edificioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_edificio_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EdificioRepository $edificioRepository): Response
    {
        $edificio = new Edificio();
        $form = $this->createForm(EdificioType::class, $edificio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $edificioRepository->save($edificio, true);

            return $this->redirectToRoute('app_edificio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('edificio/new.html.twig', [
            'edificio' => $edificio,
            'form' => $form,
        ]);
    }

    #[Route('/{idEdificio}', name: 'app_edificio_show', methods: ['GET'])]
    public function show(Edificio $edificio): Response
    {
        return $this->render('edificio/show.html.twig', [
            'edificio' => $edificio,
        ]);
    }

    #[Route('/{idEdificio}/edit', name: 'app_edificio_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Edificio $edificio, EdificioRepository $edificioRepository): Response
    {
        $form = $this->createForm(EdificioType::class, $edificio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $edificioRepository->save($edificio, true);

            return $this->redirectToRoute('app_edificio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('edificio/edit.html.twig', [
            'edificio' => $edificio,
            'form' => $form,
        ]);
    }

    #[Route('/{idEdificio}', name: 'app_edificio_delete', methods: ['POST'])]
    public function delete(Request $request, Edificio $edificio, EdificioRepository $edificioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$edificio->getIdEdificio(), $request->request->get('_token'))) {
            $edificioRepository->remove($edificio, true);
        }

        return $this->redirectToRoute('app_edificio_index', [], Response::HTTP_SEE_OTHER);
    }
}
